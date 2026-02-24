<?php

namespace App\Services;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProveedorService
{

    /**
     * Preparar datos para el proveedor
     */
    public function CrearProveedor(array $data)
    {
        return DB::transaction(function () use ($data) {

            $proveedor = Proveedor::create([
                'nombre' => $data['nombre'],
                'direccion' => $data['direccion'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'cuit' => $data['cuit'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            return $proveedor;
        });
    }

    public function mostrarProveedor(Proveedor $proveedor)
    {
        return $proveedor->load('empresa');

    }

    public function ActualizarProveedor(Proveedor $proveedor, array $data): Proveedor
    {
        $update = [
            'nombre' => $data['nombre'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'cuit' => $data['cuit'],
        ];

        $proveedor->update($update);

        return $proveedor;
    }

    public function eliminarProveedor(Proveedor $proveedor): void
    {
        DB::transaction(function () use ($proveedor) {
            $proveedor->delete();
        });
    }
}
