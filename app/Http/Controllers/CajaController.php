<?php

namespace App\Http\Controllers;

use App\Http\Requests\CierreCajaRequest;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;
use App\Models\Caja;
use App\Models\Sucursal;
use App\Models\MovimientoCaja;
use App\Services\CajaService;
use App\Services\MovimientoCajaService;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    public function __construct(CajaService $cajaService, MovimientoCajaService $movimientoCajaService)
    {
        $this->cajaService = $cajaService;
        $this->movimientoCajaService = $movimientoCajaService;
    }

    private function getSucursalId()
    {
        $sucursal_id = session('sucursal_id');

        if (! $sucursal_id) {
            $sucursal = Sucursal::whereHas('usuarios', function ($q) {
                $q->where('usuario_id', Auth::id());
            })->first();

            if (! $sucursal) {
                throw new \Exception('El usuario no tiene sucursal asignada');
            }

            $sucursal_id = $sucursal->id;
            session(['sucursal_id' => $sucursal_id]);
        }

        return $sucursal_id;
    }

    public function index()
    {
        $sucursal_id = $this->getSucursalId();
        $cajas = Caja::where('sucursal_id', $sucursal_id)
            ->where('empresa_id', Auth::user()->empresa_id)
            ->get();

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
            dd($e->getMessage());

            return back()->withErrors(['error' => 'Error al crear la caja: '.$e->getMessage()]);
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
        $anulaciones = $this->cajaService->obtenerAnulaciones($caja);
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.cajas.show', compact('caja', 'ingresos', 'egresos', 'anulaciones', 'sucursales'));
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

            return back()->withErrors(['error' => 'Error al actualizar la caja: '.$e->getMessage()]);
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
            return back()->withErrors(['error' => 'Error al eliminar la caja: '.$e->getMessage()]);
        }
    }

    public function cerrarCaja(Caja $caja)
    {
        $ingresos = MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'ingreso')
            ->sum('monto');

        $egresos = MovimientoCaja::where('caja_id', $caja->id)
            ->where('tipo', 'egreso')
            ->sum('monto');

        $monto_teorico = $caja->monto_inicial + $ingresos - $egresos;

        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        $caja = $this->cajaService->mostrarCaja($caja);

        return view('admin.cajas.cierre', compact('caja', 'sucursales', 'monto_teorico'));
    }

    public function cierre(CierreCajaRequest $request, Caja $caja)
    {
        try {
            $this->cajaService->cerrarCaja($caja, $request->validated());

            return redirect()->route('admin.cajas.index')->with('success', 'Caja cerrada exitosamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al cerrar la caja: '.$e->getMessage()]);
        }
    }

    public function ingresosEgresos(Caja $caja) 
    {
        $caja = $this->cajaService->mostrarCaja($caja);

        return view('admin.cajas.ingreso-egreso', compact('caja'));
    }
}
