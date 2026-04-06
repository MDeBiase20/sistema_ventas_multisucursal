<?php

namespace App\Services;

use App\Models\DetalleVenta;
use App\Models\ProductoSucursal;
use Illuminate\Support\Facades\DB;

class DetalleVentaService
{
    /**
     * Preparar datos para el detalle de la venta
     */
    public function CrearDetalleVenta(array $data)
    {
        return DB::transaction(function () use ($data) {

            $detalleVenta = DetalleVenta::create([
                'cantidad' => $data['cantidad'],
                'venta_id' => $data['venta_id'],
                'producto_id' => $data['producto_id'],
            ]);

            // Buscar inventario
            $inventario = ProductoSucursal::where('producto_id', $data['producto_id'])
                ->where('sucursal_id', $data['sucursal_id'])
                ->first();

            if (! $inventario) {
                throw new \Exception('Inventario no encontrado');
            }

            // Validar stock
            if ($inventario->stock < $data['cantidad']) {
                throw new \Exception('Stock insuficiente');
            }

            // Descontar stock
            $inventario->stock -= $data['cantidad'];
            $inventario->save();

            return $detalleVenta;
        });
    }

    public function ActualizarDetalleVenta(DetalleVenta $detalleVenta, array $data): DetalleVenta
    {
        $update = [
            'cantidad' => $data['cantidad'],
            'venta_id' => $data['venta_id'],
            'producto_id' => $data['producto_id'],
        ];

        $detalleVenta->update($update);

        return $detalleVenta;
    }

    public function eliminarDetalleVenta(DetalleVenta $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
