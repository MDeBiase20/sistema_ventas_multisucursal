<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;
use App\Http\Requests\CierreCajaRequest;
use App\Models\Caja;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Services\CajaService;
use App\Services\MovimientoCajaService;

class CajaController extends Controller
{
    public function __construct(CajaService $cajaService, MovimientoCajaService $movimientoCajaService)
    {
        $this->cajaService = $cajaService;
        $this->movimientoCajaService = $movimientoCajaService;
    }

    public function index()
    {
        $cajas = Caja::all();

        return view('admin.cajas.index', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.cajas.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCajaRequest $request)
    {
        try {
            $caja = $this->cajaService->CrearCaja($request->validated());

            return redirect()->route('admin.cajas.index')->with('success', 'Caja creada exitosamente.');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->withErrors(['error' => 'Error al crear la caja: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Caja $caja)
    {
        $caja = $this->cajaService->mostrarCaja($caja);
        $ingresos = $this->movimientoCajaService->obtenerIngresosPorCaja($caja);
        $egresos = $this->movimientoCajaService->obtenerEgresosPorCaja($caja);
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.cajas.show', compact('caja', 'ingresos', 'egresos', 'sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caja $caja)
    {
        $caja = $this->cajaService->mostrarCaja($caja);
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.cajas.edit', compact('caja', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCajaRequest $request, Caja $caja)
    {
        try {
            $caja = $this->cajaService->ActualizarCaja($caja, $request->validated());

            return redirect()->route('admin.cajas.index')->with('success', 'Caja actualizada exitosamente.');
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Error al actualizar la caja: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $id)
    {
        try {
            $this->cajaService->eliminarCaja($id);

            return redirect()->route('admin.cajas.index')->with('success', 'Caja eliminada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar la caja: ' . $e->getMessage()]);
        }
    }

    public function cerrarCaja(Caja $caja)
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        $caja = $this->cajaService->mostrarCaja($caja);
        return view('admin.cajas.cierre', compact('caja' , 'sucursales'));
    }

    public function cierre(CierreCajaRequest $request, Caja $caja)
    {
        try {
            $this->cajaService->cerrarCaja($caja, $request->validated());

            return redirect()->route('admin.cajas.index')->with('success', 'Caja cerrada exitosamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al cerrar la caja: ' . $e->getMessage()]);
        }
    }

    public function ingresosEgresos(Caja $caja)
    {
        $caja = $this->cajaService->mostrarCaja($caja);
        return view('admin.cajas.ingreso-egreso', compact('caja'));
    }
}
