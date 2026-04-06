<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Services\RoleService;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->mostrarRoles();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        try {
            $role = $this->roleService->CrearRoles($request->validated());
            return redirect()->route('admin.roles.index')->with('success', 'Rol creado exitosamente.');

        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->route('admin.roles.create')->with('error', 'Error al crear el rol.');
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
    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoleRequest $request, $id)
    {
        $rol = Role::findOrFail($id);
        $this->roleService->actualizarRoles($rol, $request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $this->roleService->eliminarRoles($rol);
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    public function asignarPermisos($id)
    {
        return view('admin.roles.asignar-permisos');
    }
}
