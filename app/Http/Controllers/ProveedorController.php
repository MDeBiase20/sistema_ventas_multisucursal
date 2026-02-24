<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Services\ProveedorService;

class ProveedorController extends Controller
{
    public function __construct(ProveedorService $proveedorService)
    {
        $this->proveedorService = $proveedorService;
    }

    public function index()
    {
        $proveedores = Proveedor::all();

        return view('admin.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request)
    {

        try {
            $proveedor = $this->proveedorService->CrearProveedor($request->validated());

            return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor creado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el proveedor: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        $proveedor = $this->proveedorService->mostrarProveedor($proveedor);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        try {
            $proveedor = $this->proveedorService->ActualizarProveedor($proveedor, $request->all());

            return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al actualizar el proveedor: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $id)
    {
        try {
            $this->proveedorService->eliminarProveedor($id);

            return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar el proveedor: '.$e->getMessage()]);
        }
    }
}
