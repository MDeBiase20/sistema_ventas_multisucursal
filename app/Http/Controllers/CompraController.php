<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;

class CompraController extends Controller
{
    public function __construct(CompraService $compraService)
    {
        $this->compraService = $compraService;
    }

    public function index()
    {
        $compras = Compra::all();

        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $sucursales = Sucursal::all();
        $proveedores = Proveedor::all();

        $sesion_id = session()->getId(); // Creo una variable de session_id porque como es del mismo equipo lo va a almacenar
        $tmp_compras = TmpCompra::where('session_id', $sesion_id)->get(); // Consulto la session para mostrar los productos seleccionados en la tabla de compras temporales

        return view('admin.compras.create', compact('productos', 'sucursales', 'proveedores', 'tmp_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        try {
            $compra = $this->compraService->CrearCompra($request->validated());
            return redirect()->route('admin.compras.index')->with('success', 'Compra creada exitosamente');

        } catch (\Throwable $th) {
            //dd($th->validated());
            return redirect()->back()->with('error', 'Error al crear la compra: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        $sucursales = Sucursal::all();
        $compra = $this->compraService->mostrarCompra($compra);
        return view('admin.compras.show', compact('compra', 'sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $sucursales = Sucursal::all();
        $proveedores = Proveedor::all();
        $compra = $this->compraService->mostrarCompra($compra);
        return view('admin.compras.edit', compact('compra', 'sucursales', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        try {
            $compra = $this->compraService->ActualizarCompra($compra, $request->validated());
            return redirect()->route('admin.compras.index')->with('success', 'Compra actualizada exitosamente');

        } catch (\Throwable $th) {
            //dd($th->validated());
            return redirect()->back()->with('error', 'Error al actualizar la compra: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function anular(Compra $compra)
    {
        try {
            $this->compraService->AnularCompra($compra);
            return redirect()->route('admin.compras.index')->with('success', 'Compra anulada exitosamente');

        } catch (\Throwable $th) {
            //dd($th->validated());
            return redirect()->back()->with('error', 'Error al anular la compra: ' . $th->getMessage());
        }
    }
}
