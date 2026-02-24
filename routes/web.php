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
Route::get('/empresas/edit/{id}', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.empresas.configuracion')->middleware('auth');
// Route::put('/empresas/edit/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.empresas.update')->middleware('auth');
Route::put('/empresas/{empresa}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.empresas.update')->middleware('auth');
    
//Rutas AJAX para obtener estados y ciudades
Route::get('/paises', [App\Http\Controllers\EmpresaController::class, 'paises'])->name('ubicaciones.paises');
Route::get('/ubicaciones/paises/{paisId}/estados', [App\Http\Controllers\EmpresaController::class, 'obtenerEstados'])->name('ubicaciones.estados');
Route::get('/ubicaciones/estados/{estadoId}/ciudades', [App\Http\Controllers\EmpresaController::class, 'obtenerCiudades'])->name('ubicaciones.ciudades');

//Rutas para los roles
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::put('/roles/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/roles/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

//Rutas para los usuarios
Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/usuarios/edit/{id}', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/usuarios/{usuario}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

//Rutas para las sucursales
Route::get('/sucursales', [App\Http\Controllers\SucursalController::class, 'index'])->name('admin.sucursales.index')->middleware('auth');
Route::get('/sucursales/create', [App\Http\Controllers\SucursalController::class, 'create'])->name('admin.sucursales.create')->middleware('auth');
Route::post('/sucursales/create', [App\Http\Controllers\SucursalController::class, 'store'])->name('admin.sucursales.store')->middleware('auth');
Route::get('/sucursales/{sucursal}', [App\Http\Controllers\SucursalController::class, 'show'])->name('admin.sucursales.show')->middleware('auth');
Route::get('/sucursales/edit/{sucursal}', [App\Http\Controllers\SucursalController::class, 'edit'])->name('admin.sucursales.edit')->middleware('auth');
Route::put('/sucursales/{sucursal}', [App\Http\Controllers\SucursalController::class, 'update'])->name('admin.sucursales.update')->middleware('auth');
Route::delete('/sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'destroy'])->name('admin.sucursales.destroy')->middleware('auth');

//Rutas para los proveedores
Route::get('/proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('admin.proveedores.index')->middleware('auth');
Route::get('/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedores.create')->middleware('auth');
Route::post('/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedores.store')->middleware('auth');
Route::get('/proveedores/edit/{proveedor}', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedores.edit')->middleware('auth');
Route::put('/proveedores/{proveedor}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth');