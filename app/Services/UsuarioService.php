<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioService
{
    /**
     *  Creamos los roles
     */
    public function ObtenerRoles()
    {
        // consulta para mostrar los roles de la empresa autenticada
        return Role::where('empresa_id', Auth::user()->empresa_id)->get();
    }

    /**
     * Preparar datos para la empresa
     */
    public function CrearUsuarios(array $data)
    {
        return DB::transaction(function () use ($data) {

            $usuario = User::create([
                'name' => $data['nombre'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            // Validamos que el rol exista en la empresa
            $rol = Role::where('id', $data['rol_id'])->where('empresa_id', Auth::user()->empresa_id)->first();

            // Asisgnamos el rol al usuario
            $usuario->assignRole($rol);

            return $usuario;
        });
    }

    public function mostrarRoles()
    {
        $roles = Role::where('empresa_id', Auth::user()->empresa_id)->get();

        return $roles;
    }

    public function ActualizarUsuario(User $usuario, array $data): User
    {
        $update = [
            'name' => $data['nombre'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        $usuario->update($update);

        $rol = Role::findOrFail($data['rol_id']);

        $usuario->syncRoles([$rol->name]);

        return $usuario;
    }

    public function eliminarUsuario(User $usuario): void
    {
        DB::transaction(function () use ($usuario) {
            $usuario->delete();
        });
    }
}
