<?php

namespace App\Services;

use App\Models\Producto;
use App\Models\ProductoSucursal;
use App\Models\TmpVentas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TmpVentasService
{
    /**
     * Preparar datos para el cliente
     */
    public function CrearTmpVentas(array $data)
    {
        return DB::transaction(function () use ($data) {

            $codigo = trim($data['codigo']);

            $producto = Producto::where('codigo', $codigo)
                ->where('empresa_id', Auth::user()->empresa_id)
                ->first();

            if (! $producto) {
                throw new \Exception('Producto no encontrado');
            }

            $sucursal_id = session('sucursal_id');

            if (! $sucursal_id) {
                throw new \Exception('No hay sucursal activa');
            }

            $productoSucursal = ProductoSucursal::where('producto_id', $producto->id)
                ->where('sucursal_id', $sucursal_id)
                ->first();

            if (! $productoSucursal) {
                throw new \Exception('El producto no existe en esta sucursal');
            }

            if ($productoSucursal->stock <= 0) {
                throw new \Exception('Sin stock disponible');
            }

            return TmpVentas::create([
                'producto_id' => $producto->id,
                'cantidad' => $data['cantidad'],
                'session_id' => session()->getId(),
            ]);
        });
    }

    public function mostrarTmpVentas(TmpVentas $tmpVentas)
    {
        return $tmpVentas->load('empresa');

    }

    public function ActualizarTmpVentas(TmpVentas $tmpVentas, array $data): TmpVentas
    {
        $update = [
            'codigo' => $data['codigo'],
            'cantidad' => $data['cantidad'],
        ];

        $tmpVentas->update($update);

        return $tmpVentas;
    }

    public function eliminarTmpVentas(TmpVentas $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
