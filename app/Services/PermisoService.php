<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PermisoService
{
    /**
     *  Creamos los permisos
     */
    public function CrearPermisos(array $data)
    {
        return DB::transaction(function () use ($data) {

            $permisos = Permission::create($this->PrepararPermisos($data));
        });
    }

    /**
     * Preparar datos para la empresa
     */
    private function PrepararPermisos(array $data): array
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
    private function crearPermiso(Permission $permiso, array $data): Permission
    {
        $permission = Permission::create([
            'name' => $data['nombre'] ?? $permiso->name,
            'empresa_id' => Auth::user()->empresa_id,
            'guard_name' => 'web',
        ]);

        return $permission;
    }

    public function mostrarPermisos()
    {
        $permisos = Permission::where('empresa_id', Auth::user()->empresa_id)->get();
        return $permisos;
    }

    public function actualizarPermisos(Permission $permiso, array $data): Permission
    {
        return DB::transaction(function () use ($permiso, $data) {
            $permiso->update([
                'name' => $data['nombre'] ?? $permiso->name,
            ]);

            return $permiso;
        });
    }

    public function eliminarPermisos(Permission $permiso): void
    {
        DB::transaction(function () use ($permiso) {
            $permiso->delete();
        });
    }

}
