<?php

namespace App\Http\Controllers;

use App\Models\TmpCompra;
use Illuminate\Http\Request;
use App\Services\TmpCompraService;

class TmpComprasController extends Controller
{
    public function __construct(TmpCompraService $tmpcompraService)
    {
        $this->tmpcompraService = $tmpcompraService;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Guardamos el producto seleccionado en la tabla de compras temporales
        try {
            $compraTemporal = $this->tmpcompraService->CrearTmpCompra($request->all());
            return response()->json($compraTemporal, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al agregar el producto a la compra temporal: ' . $th->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TmpCompra $tmp_compras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpCompra $tmp_compras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpCompra $tmp_compras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TmpCompra $id)
    {
        try {
            $this->tmpcompraService->eliminarTmpCompra($id);
            return response()->json(['message' => 'Producto eliminado de la compra temporal'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al eliminar el producto de la compra temporal: ' . $th->getMessage()], 500);
        }
    }
}
