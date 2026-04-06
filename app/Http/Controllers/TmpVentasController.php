<?php

namespace App\Http\Controllers;

use App\Models\TmpVentas;
use Illuminate\Http\Request;
use App\Services\TmpVentasService;

class TmpVentasController extends Controller
{
    public function __construct(TmpVentasService $tmpVentasService)
    {
        $this->tmpVentasService = $tmpVentasService;
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
        try {
            $tmpVenta = $this->tmpVentasService->CrearTmpVentas($request->all());

            return response()->json($tmpVenta, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al agregar el producto a la venta temporal: '.$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TmpVentas $tmpVentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpVentas $tmpVentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpVentas $tmpVentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TmpVentas $id)
    {
        try {
            $id->delete();

            return response()->json(['message' => 'Producto eliminado de la venta temporal'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al eliminar el producto de la venta temporal: '.$th->getMessage()], 500);
        }
    }
}
