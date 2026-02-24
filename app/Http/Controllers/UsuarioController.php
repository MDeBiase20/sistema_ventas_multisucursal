<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use App\Services\UsuarioService;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        // consulta para mostrar los usuarios de la empresa autenticada
        $empresa_id = Auth::user()->empresa_id;
        $usuarios = User::where('empresa_id', $empresa_id)->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->usuarioService->ObtenerRoles();

        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        try {
            $usuario = $this->usuarioService->CrearUsuarios($request->validated());

            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado exitosamente.');

        } catch (\Exception $th) {
            dd($th->getMessage());

            return redirect()->route('admin.usuarios.create')->with('error', 'Error al crear el usuario.');
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
        $usuario = User::with('roles')->findOrFail($id);
        $roles = $this->usuarioService->mostrarRoles();

        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, User $usuario)
    {
        try {
            $this->usuarioService->ActualizarUsuario($usuario, $request->validated());
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $th) {
            return redirect()->route('admin.usuarios.edit', $usuario)->with('error', 'Error al actualizar el usuario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $this->usuarioService->eliminarUsuario($user);
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.usuarios.index')->with('error', 'Error al eliminar el usuario.');
        }
    }
}
