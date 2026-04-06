<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\Caja;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function __construct(CompraService $compraService)
    {
        $this->compraService = $compraService;
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

        $compras = Compra::where('empresa_id', Auth::user()->empresa_id)
            ->where('sucursal_id', $sucursal_id )
            //->where('estado', 'confirmada')
            //->with(['cliente', 'sucursal'])
            ->orderBy('created_at', 'desc')
            ->get();


        $cajaAbierta = Caja::where('sucursal_id', $sucursal_id)
                        ->where('empresa_id', Auth::user()->empresa_id)
                        ->where('estado', 'abierta')
                        ->first();

        return view('admin.compras.index', compact('compras', 'cajaAbierta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        //$sucursales = Sucursal::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();

        // Si no hay sucursal activa, setear una por defecto
        if (! session()->has('sucursal_id')) {
            $sucursal = Sucursal::whereHas('usuarios', function ($q) {
                $q->where('usuario_id', Auth::id());
            })->first();

            session(['sucursal_id' => $sucursal->id ?? null]);
        }

        $sucursal_id = session('sucursal_id');

        $sesion_id = session()->getId(); // Creo una variable de session_id porque como es del mismo equipo lo va a almacenar
        $tmp_compras = TmpCompra::where('session_id', $sesion_id)->get(); // Consulto la session para mostrar los productos seleccionados en la tabla de compras temporales

        $sucursales = Sucursal::whereHas('usuarios', function ($q) {
            $q->where('usuario_id', Auth::id());
        })->get();

        return view('admin.compras.create', compact('productos', 'sucursales', 'proveedores', 'tmp_compras', 'sucursal_id'));
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
            //return redirect()->back()->with('error', 'Error al crear la compra: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Error al crear la compra' . $th->getMessage());
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
        $sucursales = Sucursal::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
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
