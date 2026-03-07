<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductoService
{

    /**
     * Preparar datos para el producto
     */
    public function CrearProducto(array $data)
    {
        return DB::transaction(function () use ($data) {

            $producto = Producto::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                'stock' => $data['stock'],
                'codigo'=> $data['codigo'],
                'sucursal_id' => $data['sucursal_id'],
                'proveedor_id' => $data['proveedor_id'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            return $producto;
        });
    }

    public function mostrarProducto(Producto $producto)
    {
        return $producto->load('empresa');

    }

    public function ActualizarProducto(Producto $producto, array $data): Producto
    {
        $update = [
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'stock' => $data['stock'],
            'codigo'=> $data['codigo'],
            'sucursal_id' => $data['sucursal_id'],
            'proveedor_id' => $data['proveedor_id'],
        ];

        $producto->update($update);

        return $producto;
    }

    public function eliminarProducto(Producto $id): void
    {
        DB::transaction(function () use ($id) {
            $id->delete();
        });
    }
}
