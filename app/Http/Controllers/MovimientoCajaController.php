<?php

namespace App\Http\Controllers;

use App\Services\MovimientoCajaService;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\MovimientoCaja;
use App\Models\Caja;
use App\Http\Requests\StoreMovimientoCajaRequest;

class MovimientoCajaController extends Controller
{
    public function __construct(MovimientoCajaService $movimientoCajaService)
    {
        $this->movimientoCajaService = $movimientoCajaService;
    }

    public function ingresosEgresos()
    {
        $caja = Caja::where('empresa_id', auth()->user()->empresa_id)->first();
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        return view('admin.cajas.ingreso-egreso', compact('caja', 'sucursales'));
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
    public function movimientos(StoreMovimientoCajaRequest $request, Caja $caja)
    {
        try {
            $movimiento = $this->movimientoCajaService->CrearIngresoEgreso($request->validated(), $caja);
            return redirect()->route('admin.cajas.index')->with('success', 'Movimiento registrado exitosamente.');
        } catch (\Throwable $th) {

            return redirect()->back()->withInput()->withErrors(['error' => 'Error al registrar el movimiento: '.$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(movimiento_caja $movimiento_caja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(movimiento_caja $movimiento_caja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, movimiento_caja $movimiento_caja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(movimiento_caja $movimiento_caja)
    {
        //
    }
}
