<?php

namespace App\Services;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SucursalService
{

    /**
     * Preparar datos para la sucursal
     */
    public function CrearSucursal(array $data)
    {
        return DB::transaction(function () use ($data) {

            $sucursal = Sucursal::create([
                'nombre' => $data['nombre'],
                'direccion' => $data['direccion'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            //Guardamos la relación pivot entre sucursal y usuarios
            if (isset($data['usuarios'])) {
                $sucursal->usuarios()->sync($data['usuarios']);
            }

            return $sucursal;
        });
    }

    public function mostrarSucursal(Sucursal $sucursal)
    {
        return $sucursal->load('usuarios');

    }

    public function ActualizarSucursal(Sucursal $sucursal, array $data): Sucursal
    {
        $update = [
            'nombre' => $data['nombre'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
        ];

        $sucursal->update($update);

        //Sincronizamos la relación pivot entre sucursal y usuarios
        if(array_key_exists('usuarios', $data)) {
            $sucursal->usuarios()->sync($data['usuarios'] ?? []);
        }
        
        return $sucursal;
    }

    public function eliminarSucursal(Sucursal $sucursal): void
    {
        DB::transaction(function () use ($sucursal) {
            $sucursal->delete();
        });
    }
}
