<?php

namespace App\Services;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use App\Models\Producto;
use App\Models\ProductoSucursal;
use App\Models\Sucursal;
use App\Models\TmpVentas;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaService
{
    public function __construct(DetalleVentaService $detalleVentaService)
    {
        $this->detalleVentaService = $detalleVentaService;
    }

    public function CrearVenta(array $data)
    {
        return DB::transaction(function () use ($data) {

            $sucursal_id = session('sucursal_id');

            if (! $sucursal_id) {
                throw new \Exception('No hay sucursal activa');
            }

            $tmpVentas = TmpVentas::where('session_id', session()->getId())->get();

            if ($tmpVentas->isEmpty()) {
                throw new \Exception('No hay productos en el carrito de ventas.');
            }

            // 🔒 BLOQUEAR la sucursal para evitar duplicados
            $sucursal = Sucursal::where('id', $sucursal_id)->lockForUpdate()->first();

            // Generar número de venta
            $nuevoNumero = $sucursal->numero_venta_actual + 1;

            // Guardar el nuevo número en la sucursal
            $sucursal->numero_venta_actual = $nuevoNumero;
            $sucursal->save();

            // Formato opcional tipo factura: 0001-00000001
            $numeroVentaFormateado = str_pad($sucursal_id, 4, '0', STR_PAD_LEFT).'-'.
                                    str_pad($nuevoNumero, 8, '0', STR_PAD_LEFT);

            $caja = Caja::where('sucursal_id', $sucursal_id)
                ->first();

            if (! $caja) {
                throw new \Exception('No hay una caja abierta en esta sucursal');
            }

            // calcular total
            $total = 0;

            foreach ($tmpVentas as $tmp) {
                $producto = Producto::find($tmp->producto_id);
                $total += $producto->precio * $tmp->cantidad;
            }

            // crear venta
            $venta = Venta::create([
                'numero_venta' => $numeroVentaFormateado, // 🔥 automático
                'fecha_venta' => $data['fecha_venta'],
                'total_venta' => $total,
                'cliente_id' => $data['cliente_id'],
                'sucursal_id' => $sucursal_id,
                'empresa_id' => Auth::user()->empresa_id,
                'user_id' => Auth::id(),
            ]);

            // crear detalles + actualizar stock
            foreach ($tmpVentas as $tmp) {

                $this->detalleVentaService->CrearDetalleVenta([
                    'venta_id' => $venta->id,
                    'producto_id' => $tmp->producto_id,
                    'cantidad' => $tmp->cantidad,
                    'sucursal_id' => $sucursal_id,
                ]);

                $tmp->delete();
            }

            // Registrar movimiento de caja
            MovimientoCaja::create([
                'tipo' => 'ingreso',
                'tipo_operacion' => 'venta',
                'monto' => $total,
                'descripcion' => 'Venta #'.$venta->numero_venta,
                'sucursal_id' => $sucursal_id,
                'empresa_id' => Auth::user()->empresa_id,
                'caja_id' => $caja->id,
                'venta_id' => $venta->id,
            ]);

            return $venta;
        });
    }

    public function mostrarVenta(Venta $venta)
    {
        return $venta->load([
            'cliente',
            'sucursal',
            'empresa',
            'detalles.producto',
        ]);

    }

    public function ActualizarVenta(Venta $venta, array $data): Venta
    {
        $update = [
            'numero_venta' => $data['numero_venta'] ?? $venta->numero_venta,
            'fecha_venta' => $data['fecha_venta'] ?? $venta->fecha_venta,
            'cliente_id' => $data['cliente_id'] ?? $venta->cliente_id,
            'sucursal_id' => $data['sucursal_id'] ?? $venta->sucursal_id,
        ];

        $venta->update($update);

        // Actualizao el movimiento de caja relacionado
        $movimiento = MovimientoCaja::where('descripcion', 'Venta #'.$venta->numero_venta)
            ->where('sucursal_id', $venta->sucursal_id)
            ->first();
        if ($movimiento) {
            $movimiento->update([
                'monto' => $venta->total_venta,
                'descripcion' => 'Venta #'.$venta->numero_venta.' (actualizada)',
            ]);
        }

        return $venta;
    }

    public function AnularVenta(Venta $venta): void
    {
        DB::transaction(function () use ($venta) {

            // Verificamos que la venta sea de esa sucursal para evitar problemas de seguridad
            $sucursal_id = session('sucursal_id');

            if (! $sucursal_id) {
                throw new \Exception('No hay sucursal activa');
            }

            // evitamos anular ventas que ya han sido anuladas
            if ($venta->estado === 'anulada') {
                throw new \Exception('La venta ya ha sido anulada.');
            }

            // Cargamos los detalles de la venta para revertir el stock
            $venta->load('detalles');

            // Obtenemos la caja de la sucursal para registrar el movimiento inverso
            $caja = Caja::where('sucursal_id', $sucursal_id)
                ->where('estado', 'abierta')
                ->first();

            if (! $caja) {
                throw new \Exception('No hay una caja abierta en esta sucursal');
            }

            foreach ($venta->detalles as $detalle) {
                $productoSucursal = ProductoSucursal::where('producto_id', $detalle->producto_id)
                    ->where('sucursal_id', $venta->sucursal_id)
                    ->first();

                if ($productoSucursal) {
                    // Revertir el stock sumando la cantidad de la venta anulada
                    $productoSucursal->stock += $detalle->cantidad;
                    $productoSucursal->save();
                }
            }

            // Marcamos como anulada la venta
            $venta->update([
                'estado' => 'anulada',
            ]);

            MovimientoCaja::create([
                'tipo' => 'egreso', // inverso de la venta
                'tipo_operacion' => 'anulación_venta',
                'monto' => $venta->total_venta,
                'descripcion' => 'Anulación venta #'.$venta->numero_venta,
                'sucursal_id' => $sucursal_id,
                'empresa_id' => $venta->empresa_id,
                'caja_id' => $caja->id,
            ]);

            return $venta;
        });
    }

    public function generarPdfVenta(Venta $venta)
    {
        return app(PdfService::class)->generarVenta($venta);
    }
}
