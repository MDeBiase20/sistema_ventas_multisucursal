<?php

namespace App\Services;

use App\Models\DetalleCompra;
use App\Models\ProductoSucursal;
use Illuminate\Support\Facades\DB;

class DetalleCompraService
{
    /**
     * Preparar datos para el detalle de la compra
     */
    public function CrearDetalleCompra(array $data)
    {
        return DB::transaction(function () use ($data) {

            $detalleCompra = DetalleCompra::create([
                'cantidad' => $data['cantidad'],
                'compra_id' => $data['compra_id'],
                'producto_id' => $data['producto_id'],
            ]);

            $inventario = ProductoSucursal::updateOrCreate(
                [
                    'producto_id' => $data['producto_id'],
                    'sucursal_id' => $data['sucursal_id'],
                ],
                [
                    'stock' => DB::raw('COALESCE(stock,0) + '.$data['cantidad']),
                ]
            );

            return $detalleCompra;
        });
    }


    public function ActualizarDetalleCompra(DetalleCompra $detalleCompra, array $data): DetalleCompra
    {
        $update = [
            'cantidad' => $data['cantidad'],
            'compra_id' => $data['compra_id'],
            'producto_id' => $data['producto_id'],
        ];

        $detalleCompra->update($update);

        return $detalleCompra;
    }

    public function eliminarDetalleCompra(DetalleCompra $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
