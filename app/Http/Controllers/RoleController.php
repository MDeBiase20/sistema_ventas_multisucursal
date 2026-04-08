<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Services\RoleService;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

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
        $rol = Role::findOrFail($id);
        
        /*La función "stripos" agarra algunos caracteres del campo en este caso "name" que sean similiares al prefijo en este caso "usu" */
        $permisos = Permission::where('empresa_id', Auth::user()->empresa_id)
                                ->get()
                                ->groupBy(function($permiso){
                                    if (stripos($permiso->name, 'config') !==false) {
                                        return 'Configuración';
                                    }elseif (stripos($permiso->name, 'rol') !==false ){
                                        return 'Roles';
                                    }elseif (stripos($permiso->name, 'permi') !==false ){
                                        return 'Permisos';
                                    }elseif (stripos($permiso->name, 'usu') !==false ){
                                        return 'Usuarios';
                                    }elseif (stripos($permiso->name, 'suc') !==false ){
                                        return 'Sucursales';
                                    }elseif (stripos($permiso->name, 'prod') !==false ){
                                        return 'Productos';
                                    }elseif (stripos($permiso->name, 'prov') !==false ){
                                        return 'Proveedores';
                                    }elseif (stripos($permiso->name, 'comp') !==false ){
                                        return 'Compras';
                                    }elseif (stripos($permiso->name, 'cli') !==false ){
                                        return 'Clientes';
                                    }elseif (stripos($permiso->name, 'ven') !==false ){
                                        return 'Ventas';
                                    }elseif (stripos($permiso->name, 'caj') !==false ){
                                        return 'Caja';
                                    }
                                });

        return view('admin.roles.asignar-permisos', compact('rol', 'permisos'));
    }

    public function asignar(Request $request, $id)
    {
        $rol = Role::findOrFail($id);
        $permisos = $request->input('permisos', []);
        $this->roleService->asignarPermisos($rol, $permisos);
        return redirect()->route('admin.roles.index')->with('success', 'Permisos asignados exitosamente.');
    }
}
