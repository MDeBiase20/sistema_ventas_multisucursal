<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.index');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//Rutas para la empresa
Route::get('/empresas/create', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.empresas.create');
Route::post('/empresas/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.store');
Route::get('/empresas/edit/{id}', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.empresas.configuracion')->middleware('auth', 'can:Configuracion');
// Route::put('/empresas/edit/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.empresas.update')->middleware('auth');
Route::put('/empresas/{empresa}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.empresas.update')->middleware('auth');
    
//Rutas AJAX para obtener estados y ciudades
Route::get('/paises', [App\Http\Controllers\EmpresaController::class, 'paises'])->name('ubicaciones.paises');
Route::get('/ubicaciones/paises/{paisId}/estados', [App\Http\Controllers\EmpresaController::class, 'obtenerEstados'])->name('ubicaciones.estados');
Route::get('/ubicaciones/estados/{estadoId}/ciudades', [App\Http\Controllers\EmpresaController::class, 'obtenerCiudades'])->name('ubicaciones.ciudades');

//Rutas para los roles
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth', 'can:Roles - index');
Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth', 'can:Roles - create');
Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth', 'can:Roles - edit');
Route::put('/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth', 'can:Roles - destroy');
Route::get('/roles/asignar-permisos/{id}', [App\Http\Controllers\RoleController::class, 'asignarPermisos'])->name('admin.roles.asignar-permisos')->middleware('auth', 'can:Roles - asignar-permisos');
Route::put('/roles/asignar/{id}', [App\Http\Controllers\RoleController::class, 'asignar'])->name('admin.roles.asignar')->middleware('auth');

//Rutas para los permisos
Route::get('/permisos', [App\Http\Controllers\PermissionController::class, 'index'])->name('admin.permisos.index')->middleware('auth', 'can:Permisos - index');
Route::get('/permisos/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('admin.permisos.create')->middleware('auth', 'can:Permisos - create');
Route::post('/permisos/create', [App\Http\Controllers\PermissionController::class, 'store'])->name('admin.permisos.store')->middleware('auth');
Route::get('/permisos/edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('admin.permisos.edit')->middleware('auth', 'can:Permisos - edit');
Route::put('/permisos/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('admin.permisos.update')->middleware('auth');
Route::delete('/permisos/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('admin.permisos.destroy')->middleware('auth', 'can:Permisos - destroy');

//Rutas para los usuarios
Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth' , 'can:Usuarios - index');
Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth', 'can:Usuarios - create');
Route::post('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/usuarios/edit/{id}', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth', 'can:Usuarios - edit');
Route::put('/usuarios/{usuario}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth', 'can:Usuarios - destroy');

//Rutas para las sucursales
Route::get('/sucursales', [App\Http\Controllers\SucursalController::class, 'index'])->name('admin.sucursales.index')->middleware('auth' , 'can:Sucursales - index');
Route::get('/sucursales/create', [App\Http\Controllers\SucursalController::class, 'create'])->name('admin.sucursales.create')->middleware('auth', 'can:Sucursales - create');
Route::post('/sucursales/create', [App\Http\Controllers\SucursalController::class, 'store'])->name('admin.sucursales.store')->middleware('auth');
Route::get('/sucursales/{sucursal}', [App\Http\Controllers\SucursalController::class, 'show'])->name('admin.sucursales.show')->middleware('auth');
Route::get('/sucursales/edit/{sucursal}', [App\Http\Controllers\SucursalController::class, 'edit'])->name('admin.sucursales.edit')->middleware('auth', 'can:Sucursales - edit');
Route::put('/sucursales/{sucursal}', [App\Http\Controllers\SucursalController::class, 'update'])->name('admin.sucursales.update')->middleware('auth');
Route::delete('/sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'destroy'])->name('admin.sucursales.destroy')->middleware('auth', 'can:Sucursales - destroy');

//Rutas para los proveedores
Route::get('/proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('admin.proveedores.index')->middleware('auth' , 'can:Proveedores - index');
Route::get('/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedores.create')->middleware('auth', 'can:Proveedores - create');
Route::post('/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedores.store')->middleware('auth');
Route::get('/proveedores/edit/{proveedor}', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedores.edit')->middleware('auth', 'can:Proveedores - edit');
Route::put('/proveedores/{proveedor}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth', 'can:Proveedores - destroy');

//Rutas para los productos
Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth' , 'can:Productos - index');
Route::get('/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth', 'can:Productos - create');
Route::post('/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth', 'can:Productos - show');
Route::get('/productos/edit/{producto}', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth', 'can:Productos - edit');
Route::put('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth', 'can:Productos - destroy');

//Rutas para los productos por sucursal
Route::get('/productos-sucursal', [App\Http\Controllers\ProductoSucursalController::class, 'index'])->name('admin.productos_sucursales.index')->middleware('auth' , 'can:ProductosPorSucursales - index');

//Ruta para los clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth' , 'can:Clientes - index');
Route::get('/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth', 'can:Clientes - create');
Route::post('/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
// Route::get('/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth');
Route::get('/clientes/edit/{cliente}', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth', 'can:Clientes - edit');
Route::put('/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth', 'can:Clientes - destroy');

//Ruta para las cajas
Route::get('/cajas', [App\Http\Controllers\CajaController::class, 'index'])->name('admin.cajas.index')->middleware('auth' , 'can:Caja - index');
Route::get('/cajas/create', [App\Http\Controllers\CajaController::class, 'create'])->name('admin.cajas.create')->middleware('auth', 'can:Caja - create');
Route::post('/cajas/create', [App\Http\Controllers\CajaController::class, 'store'])->name('admin.cajas.store')->middleware('auth');
Route::get('/cajas/{caja}', [App\Http\Controllers\CajaController::class, 'show'])->name('admin.cajas.show')->middleware('auth' , 'can:Caja - show');
Route::get('/cajas/edit/{caja}', [App\Http\Controllers\CajaController::class,'edit'])->name('admin.cajas.edit')->middleware('auth', 'can:Caja - edit');
Route::put('/cajas/{caja}', [App\Http\Controllers\CajaController::class, 'update'])->name('admin.cajas.update')->middleware('auth');
//Route::delete('/cajas/{id}', [App\Http\Controllers\CajaController::class, 'destroy'])->name('admin.cajas.destroy')->middleware('auth');

Route::get('/cajas/{caja}/ingresos-egresos', [App\Http\Controllers\MovimientoCajaController::class, 'ingresosEgresos'])->name('admin.cajas.ingresos-egresos')->middleware('auth' , 'can:Caja - ingresos-egresos');
Route::post('/cajas/{caja}/movimientos', [App\Http\Controllers\MovimientoCajaController::class, 'movimientos'])->name('admin.cajas.movimientos')->middleware('auth' , 'can:Caja - movimientos');

//Ruta para el cierre de caja
Route::get('/cajas/{caja}/cierre', [App\Http\Controllers\CajaController::class, 'cerrarCaja'])->name('admin.cajas.cerrar')->middleware('auth' , 'can:Caja - CerrarCaja');
Route::put('/cajas/{caja}/cierre', [App\Http\Controllers\CajaController::class, 'cierre'])->name('admin.cajas.cierre')->middleware('auth');

//Ruta para las compras temporales
Route::post('/compras-temporales', [App\Http\Controllers\TmpComprasController::class, 'store'])->name('admin.compras-temporales.store')->middleware('auth');
Route::delete('/compras-temporales/{id}', [App\Http\Controllers\TmpComprasController::class, 'destroy'])->name('admin.compras-temporales.destroy')->middleware('auth');

//Ruta para las compras
Route::get('/compras', [App\Http\Controllers\CompraController::class, 'index'])->name('admin.compras.index')->middleware('auth' , 'can:Compras - index');
Route::get('/compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('admin.compras.create')->middleware('auth', 'can:Compras - create');
Route::post('/compras/create', [App\Http\Controllers\CompraController::class, 'store'])->name('admin.compras.store')->middleware('auth');
Route::get('/compras/{compra}', [App\Http\Controllers\CompraController::class, 'show'])->name('admin.compras.show')->middleware('auth' , 'can:Compras - show');
Route::get('/compras/edit/{compra}', [App\Http\Controllers\CompraController::class, 'edit'])->name('admin.compras.edit')->middleware('auth', 'can:Compras - edit');
Route::put('/compras/{compra}', [App\Http\Controllers\CompraController::class, 'update'])->name('admin.compras.update')->middleware('auth');
Route::patch('/compras/{compra}',[App\Http\Controllers\CompraController::class, 'anular'])->name('admin.compras.anular')->middleware('auth' , 'can:Compras - anular');

//Ruta para las ventas temporales
Route::post('/ventas-temporales', [App\Http\Controllers\TmpVentasController::class, 'store'])->name('admin.ventas-temporales.store')->middleware('auth');
Route::delete('/ventas-temporales/{id}', [App\Http\Controllers\TmpVentasController::class, 'destroy'])->name('admin.ventas-temporales.destroy')->middleware('auth');

//Rutas para las ventas
Route::get('/ventas', [App\Http\Controllers\VentasController::class, 'index'])->name('admin.ventas.index')->middleware('auth' , 'can:Ventas - index');
Route::get('/ventas/create', [App\Http\Controllers\VentasController::class, 'create'])->name('admin.ventas.create')->middleware('auth', 'can:Ventas - create');
Route::post('/ventas/create', [App\Http\Controllers\VentasController::class, 'store'])->name('admin.ventas.store')->middleware('auth');
Route::get('/ventas/{venta}', [App\Http\Controllers\VentasController::class, 'show'])->name('admin.ventas.show')->middleware('auth' , 'can:Ventas - show');
Route::get('/ventas/edit/{venta}', [App\Http\Controllers\VentasController::class, 'edit'])->name('admin.ventas.edit')->middleware('auth', 'can:Ventas - edit');
Route::put('/ventas/{venta}', [App\Http\Controllers\VentasController::class, 'update'])->name('admin.ventas.update')->middleware('auth');
Route::patch('/ventas/{venta}', [App\Http\Controllers\VentasController::class, 'anular'])->name('admin.ventas.anular')->middleware('auth' , 'can:Ventas - anular');
Route::get('/ventas/{venta}/pdf', [App\Http\Controllers\VentasController::class, 'pdf'])->name('admin.ventas.pdf')->middleware('auth');