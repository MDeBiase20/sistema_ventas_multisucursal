<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function index()
    {
        $productos = Producto::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', auth()->user()->empresa_id)->get();
        return view('admin.productos.create', compact('sucursales', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        try {
            $producto = $this->productoService->CrearProducto($request->validated());

            return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el producto: '.$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', auth()->user()->empresa_id)->get();
        $producto = $this->productoService->mostrarProducto($producto);

        return view('admin.productos.show', compact('producto', 'sucursales', 'proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', auth()->user()->empresa_id)->get();

        return view('admin.productos.edit', compact('producto', 'sucursales', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        try {
            $this->productoService->ActualizarProducto($producto, $request->all());

            return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al actualizar el producto: '.$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $id)
    {
        try {
            $this->productoService->eliminarProducto($id);

            return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar el producto: '.$th->getMessage()]);
        }
    }
}
