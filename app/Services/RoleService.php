<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

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

    public function asignarPermisos(Role $rol, array $permisos): void
    {
        DB::transaction(function () use ($rol, $permisos) {

            $permisosModel = Permission::whereIn('id', $permisos)
                ->where('empresa_id', Auth::user()->empresa_id)
                ->get();

            $rol->syncPermissions($permisosModel);
        });
    }
}
