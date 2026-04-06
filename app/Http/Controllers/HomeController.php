<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursal;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Caja;
use App\Models\Compra;
use App\Models\Venta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('empresa_id', auth()->user()->empresa_id)->count();
        $sucursales = Sucursal::where('empresa_id', auth()->user()->empresa_id)->count();
        $proveedores = Proveedor::where('empresa_id', auth()->user()->empresa_id)->count();
        $productos = Producto::where('empresa_id', auth()->user()->empresa_id)->count();
        $clientes = Cliente::where('empresa_id', auth()->user()->empresa_id)->count();
        $cajas = Caja::where('empresa_id', auth()->user()->empresa_id)->count();
        $compras = Compra::where('empresa_id', auth()->user()->empresa_id)->count();
        $ventas = Venta::where('empresa_id', auth()->user()->empresa_id)->count();
        
        return view('admin.index', compact('users', 'sucursales', 'proveedores', 'productos', 'clientes', 'cajas' ,'compras', 'ventas'));
    }
}
