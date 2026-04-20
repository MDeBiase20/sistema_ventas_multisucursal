<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\MovimientoCaja;
use App\Models\Producto;
use App\Models\ProductoSucursal;
use App\Models\TmpCompra;
use App\Models\Sucursal;
use App\Models\Caja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraService
{
    public function __construct(DetalleCompraService $detalleCompraService, CajaService $cajaService)
    {
        $this->detalleCompraService = $detalleCompraService;
        $this->cajaService = $cajaService;
    }

    public function CrearCompra(array $data)
    {
        return DB::transaction(function () use ($data) {

            $sucursal_id = session('sucursal_id');

            if (! $sucursal_id) {
                throw new \Exception('No hay sucursal activa');
            }

            $tmpCompras = TmpCompra::where('session_id', session()->getId())->get();

            if ($tmpCompras->isEmpty()) {
                throw new \Exception('No hay productos en el carrito de compras.');
            }

            // 🔒 BLOQUEAR la sucursal para evitar duplicados
            $sucursal = Sucursal::where('id', $sucursal_id)->lockForUpdate()->first();

            $caja = $this->cajaService->obtenerCajaAbierta();

            if (!$caja) {
                throw new \Exception('No hay una caja abierta en esta sucursal');
            }

            // calcular total
            $total = 0;

            // crear compra
            $compra = Compra::create([
                'numero_compra' => $data['comprobante'],
                'fecha_compra' => $data['fecha_compra'],
                'total_compra' => $data['precio_total'],
                'proveedor_id' => $data['proveedor_id'],
                'sucursal_id' => $sucursal_id,
                'empresa_id' => Auth::user()->empresa_id,
                'usuario_id' => Auth::id(),
            ]);

            // crear detalles
            foreach ($tmpCompras as $tmp) {

                $this->detalleCompraService->CrearDetalleCompra([
                    'compra_id' => $compra->id,
                    'producto_id' => $tmp->producto_id,
                    'cantidad' => $tmp->cantidad,
                    'sucursal_id' => $sucursal_id,
                ]);

                $tmp->delete();
            }

            // Registrar movimiento de caja
            MovimientoCaja::create([
                'tipo' => 'egreso',
                'tipo_operacion' => 'compra',
                'monto' => $data['precio_total'],
                'descripcion' => 'Compra #'.$compra->numero_compra,
                'sucursal_id' => $sucursal_id,
                'empresa_id' => Auth::user()->empresa_id,
                'caja_id' => $caja->id,
                'compra_id' => $compra->id,
            ]);

            return $compra;
        });
    }

    public function mostrarCompra(Compra $compra)
    {
        return $compra->load([
            'proveedor',
            'sucursal',
            'empresa',
            'detalles.producto',
        ]);

    }

    public function ActualizarCompra(Compra $compra, array $data): Compra
    {
        $update = [
            'numero_compra' => $data['comprobante'] ?? $compra->numero_compra,
            'fecha_compra' => $data['fecha_compra'] ?? $compra->fecha_compra,
            'proveedor_id' => $data['proveedor_id'] ?? $compra->proveedor_id,
            'sucursal_id' => $data['sucursal_id'] ?? $compra->sucursal_id,
        ];

        $compra->update($update);

        return $compra;
    }

    public function AnularCompra(Compra $compra): void
    {
        DB::transaction(function () use ($compra) {

        //Verificamos que la compra sea de esa sucursal para evitar problemas de seguridad
            $sucursal_id = session('sucursal_id');

            if (! $sucursal_id) {
                throw new \Exception('No hay sucursal activa');
            }

            // evitamos anular compras que ya han sido anuladas
            if ($compra->estado === 'anulada') {
                throw new \Exception('La compra ya ha sido anulada.');
            }

            // Obtenemos la caja de la sucursal para registrar el movimiento inverso
            $caja = $this->cajaService->obtenerCajaAbierta();

            if (! $caja) {
                throw new \Exception('No hay una caja abierta en esta sucursal');
            }

            // Cargamos los detalles de la compra para revertir el stock
            $compra->load('detalles');

            foreach ($compra->detalles as $detalle) {
                $productoSucursal = ProductoSucursal::where('producto_id', $detalle->producto_id)
                    ->where('sucursal_id', $compra->sucursal_id)
                    ->first();

                if ($productoSucursal) {
                    // Revertir el stock restando la cantidad de la compra anulada
                    $productoSucursal->stock -= $detalle->cantidad;
                    if ($productoSucursal->stock < 0) {
                        throw new \Exception('No se puede anular la compra porque ya hay ventas asociadas a ese producto.'); // Evitar stock negativo
                    }

                    $productoSucursal->save();
                }
            }

            // Marcamos como anulada la compra
            $compra->update([
                'estado' => 'anulada',
            ]);

            MovimientoCaja::create([
                'tipo' => 'ingreso', // inverso de la compra
                'tipo_operacion' => 'anulación_compra',
                'monto' => $compra->total_compra,
                'descripcion' => 'Anulación compra #'.$compra->numero_compra,
                'sucursal_id' => $sucursal_id,
                'empresa_id' => $compra->empresa_id,
                'caja_id' => $caja->id,
            ]);

            return $compra;
        });
    }
}
