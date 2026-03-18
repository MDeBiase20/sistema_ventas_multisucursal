<?php

namespace App\Services;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\TmpCompra;
use App\Models\ProductoSucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraService
{
    public function __construct(DetalleCompraService $detalleCompraService)
    {
        $this->detalleCompraService = $detalleCompraService;
    }

    public function CrearCompra(array $data)
    {
        return DB::transaction(function () use ($data) {

            $tmpCompras = TmpCompra::where('session_id', session()->getId())->get();

            if ($tmpCompras->isEmpty()) {
                throw new \Exception('No hay productos en el carrito de compras.');
            }

            // calcular total
            $total = 0;

            foreach ($tmpCompras as $tmp) {
                $producto = Producto::find($tmp->producto_id);
                $total += $producto->precio * $tmp->cantidad;
            }

            // crear compra
            $compra = Compra::create([
                'numero_compra' => $data['comprobante'],
                'fecha_compra' => $data['fecha_compra'],
                'total_compra' => $total,
                'proveedor_id' => $data['proveedor_id'],
                'sucursal_id' => $data['sucursal_id'],
                'empresa_id' => Auth::user()->empresa_id,
                'usuario_id' => Auth::id(),
            ]);

            // crear detalles
            foreach ($tmpCompras as $tmp) {

                $this->detalleCompraService->CrearDetalleCompra([
                    'compra_id' => $compra->id,
                    'producto_id' => $tmp->producto_id,
                    'cantidad' => $tmp->cantidad,
                    'sucursal_id' => $data['sucursal_id'],
                ]);

                $tmp->delete();
            }

            return $compra;
        });
    }

    public function mostrarCompra(Compra $compra)
    {
        return $compra->load([
        'proveedor',
        'sucursal',
        'empresa',
        'detalles.producto'
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
            //evitamos anular compras que ya han sido anuladas
            if ($compra->estado === 'anulada') {
                throw new \Exception('La compra ya ha sido anulada.');
            }

            //Cargamos los detalles de la compra para revertir el stock
            $compra->load('detalles');

            foreach ($compra->detalles as $detalle) {
                $productoSucursal = ProductoSucursal::where('producto_id', $detalle->producto_id)
                    ->where('sucursal_id', $compra->sucursal_id)
                    ->first();

                if ($productoSucursal) {
                    // Revertir el stock restando la cantidad de la compra anulada
                    $productoSucursal->stock -= $detalle->cantidad;
                    if($productoSucursal->stock < 0){
                        throw new \Exception('Stock inconsistente al anular.'); // Evitar stock negativo
                    }
                        
                    $productoSucursal->save();
                }
            }

            //Marcamos como anulada la compra
            $compra->update([
                'estado' => 'anulada',
            ]);

            return $compra;
        });
    }
}
