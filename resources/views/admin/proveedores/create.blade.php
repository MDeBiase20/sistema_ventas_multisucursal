@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de proveedores</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.proveedores.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Nombre del proveedor</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre', $proveedor->nombre ?? '') }}" name="nombre"
                                                        required>
                                                    @error('nombre')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-truck"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Dirección</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('direccion', $proveedor->direccion ?? '') }}"
                                                        name="direccion" required>
                                                    @error('direccion')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-card-text"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <label for="">Teléfono</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('telefono', $proveedor->telefono ?? '') }}"
                                                        name="telefono" required>
                                                    @error('telefono')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-telephone"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Correo</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="email" class="form-control"
                                                        value="{{ old('email', $proveedor->email ?? '') }}" name="email"
                                                        required>
                                                    @error('email')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-at"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Cuit</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('cuit', $proveedor->cuit ?? '') }}" name="cuit"
                                                        required>
                                                    @error('cuit')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-c-circle"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar proveedor</button>
                                                <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
