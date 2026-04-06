<?php

namespace App\Http\Controllers;

use App\Services\PermisoService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(PermisoService $permisoService)
    {
        $this->permisoService = $permisoService;
    }

    public function index()
    {
        $permisos = Permission::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $this->permisoService->CrearPermisos($data);
            return redirect()->route('admin.permisos.index')->with('success', 'Permiso creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el permiso: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permiso = Permission::findOrFail($id);
        return view('admin.permisos.edit', compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        try {
            $data = $request->all();
            $this->permisoService->actualizarPermisos($permission, $data);
            return redirect()->route('admin.permisos.index')->with('success', 'Permiso actualizado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar el permiso: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permiso = Permission::findOrFail($id);
            $this->permisoService->eliminarPermisos($permiso);
            return redirect()->route('admin.permisos.index')->with('success', 'Permiso eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al eliminar el permiso: ' . $th->getMessage());
        }
    }
}
