<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSucursalRequest;
use App\Http\Requests\UpdateSucursalRequest;
use App\Models\Sucursal;
use App\Models\User;
use App\Services\SucursalService;

class SucursalController extends Controller
{
    public function __construct(SucursalService $sucursalService)
    {
        $this->sucursalService = $sucursalService;
    }

    public function index()
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.sucursales.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSucursalRequest $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        // dd($request->usuarios);

        try {
            $sucursal = $this->sucursalService->CrearSucursal($request->all());

            return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la sucursal: '.$e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sucursal $sucursal)
    {
        $sucursal->load('usuarios');   // eager loading

        return view('admin.sucursales.show', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sucursal $sucursal)
    {
        $sucursal->load('usuarios');
        $usuarios = User::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.sucursales.edit', compact('sucursal', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSucursalRequest $request, sucursal $sucursal)
    {
        try {
            $sucursal = $this->sucursalService->ActualizarSucursal($sucursal, $request->all());

            return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la sucursal: '.$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sucursal = Sucursal::findOrFail($id);
            $this->sucursalService->eliminarSucursal($sucursal);

            return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la sucursal: '.$e->getMessage());
        }
    }
}
