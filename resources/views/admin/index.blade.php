@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Bienvenido al panel de administración</h3>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card" style="background-color: rgb(247, 234, 123)">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.usuarios.index') }}">Usuarios Registrados</a>
                                <p class="font-extrabold mb-0">{{ $users }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.sucursales.index') }}">Sucursales Registradas</a>
                                <p class="font-extrabold mb-0">{{ $sucursales }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.proveedores.index') }}">Proveedores Registrados</a>
                                <p class="font-extrabold mb-0">{{ $proveedores }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.productos.index') }}">Productos Registrados</a>
                                <p class="font-extrabold mb-0">{{ $productos }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.clientes.index') }}">Clientes Registrados</a>
                                <p class="font-extrabold mb-0">{{ $clientes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.cajas.index') }}">Cajas Registradas</a>
                                <p class="font-extrabold mb-0">{{ $cajas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card" style="background-color: rgb(141, 240, 141)">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.compras.index') }}">Compras Registradas</a>
                                <p class="font-extrabold mb-0">{{ $compras }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <a href="{{ route('admin.ventas.index') }}">Ventas Registradas</a>
                                <p class="font-extrabold mb-0">{{ $ventas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
