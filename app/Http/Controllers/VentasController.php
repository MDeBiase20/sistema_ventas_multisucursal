<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Cliente;
use App\Models\ProductoSucursal;
use App\Models\Sucursal;
use App\Models\TmpVentas;
use App\Models\Venta;
use App\Models\Caja;
use App\Services\VentaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function __construct(VentaService $ventaService)
    {
        $this->ventaService = $ventaService;
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

        $cajaAbierta = Caja::where('sucursal_id', $sucursal_id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('estado', 'abierta')
                        ->first();

        $ventas = Venta::where('empresa_id', Auth::user()->empresa_id)
                    ->where('sucursal_id', $sucursal_id )
            //->where('estado', 'confirmada')
                    ->with(['cliente', 'sucursal'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.ventas.index', compact('ventas', 'cajaAbierta'));
    }

    public function create()
    {
        // Si no hay sucursal activa, setear una por defecto
        if (! session()->has('sucursal_id')) {
            $sucursal = Sucursal::whereHas('usuarios', function ($q) {
                $q->where('usuario_id', Auth::id());
            })->first();

            session(['sucursal_id' => $sucursal->id ?? null]);
        }

        $sucursal_id = session('sucursal_id');

        $productos = ProductoSucursal::with('producto')
            ->where('sucursal_id', $sucursal_id)
            ->get();

        $sucursales = Sucursal::whereHas('usuarios', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->get();

        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        $tmp_ventas = TmpVentas::where('session_id', session()->getId())->get();

        return view('admin.ventas.create', compact('productos', 'sucursales', 'clientes', 'tmp_ventas', 'sucursal_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request)
    {
        try {
            $venta = $this->ventaService->CrearVenta($request->validated());
            return redirect()->route('admin.ventas.index')->with('success', 'Venta creada exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al crear la venta: '.$th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta = $this->ventaService->mostrarVenta($venta);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $venta = $this->ventaService->mostrarVenta($venta);

        $sucursal_id = session('sucursal_id');

        $productos = ProductoSucursal::with('producto')
            ->where('sucursal_id', $sucursal_id)
            ->get();

        $sucursales = Sucursal::whereHas('usuarios', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->get();

        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        $detalles = $venta->detalles()->with('producto')->get();

        return view('admin.ventas.edit', compact('venta', 'productos', 'sucursales', 'clientes', 'detalles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        try {
            $this->ventaService->ActualizarVenta($venta, $request->validated());
            return redirect()->route('admin.ventas.index')->with('success', 'Venta actualizada exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar la venta: '.$th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function Anular(Venta $venta)
    {
        try {
            $this->ventaService->AnularVenta($venta);
            return redirect()->route('admin.ventas.index')->with('success', 'Venta anulada exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al anular la venta: '.$th->getMessage())->withInput();
        }
    }
}
