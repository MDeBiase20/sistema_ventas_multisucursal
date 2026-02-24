<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    /**
     *  Creamos los roles
     */
    public function CrearRoles(array $data)
    {
        return DB::transaction(function () use ($data) {

            $roles = Role::create($this->PrepararRoles($data));
        });
    }

    /**
     * Preparar datos para la empresa
     */
    private function PrepararRoles(array $data): array
    {
        
        return [
            'empresa_id' => Auth::user()->empresa_id,
            'name' => $data['nombre'],
            'guard_name' => 'web',
        ];
    }

    /**
     * Crear Roles para la empresa
     */
    private function crearRol(Role $rol, array $data): Role
    {
        $role = Role::create([
            'name' => $data['nombre'] ?? $rol->name,
            'empresa_id' => Auth::user()->empresa_id,
            'guard_name' => 'web',
        ]);

        return $role;
    }

    public function mostrarRoles()
    {
        $roles = Role::where('empresa_id', Auth::user()->empresa_id)->get();
        return $roles;
    }

    public function actualizarRoles(Role $rol, array $data): Role
    {
        return DB::transaction(function () use ($rol, $data) {
            $rol->update([
                'name' => $data['nombre'] ?? $rol->name,
            ]);

            return $rol;
        });
    }

    public function eliminarRoles(Role $rol): void
    {
        DB::transaction(function () use ($rol) {
            $rol->delete();
        });
    }

}
