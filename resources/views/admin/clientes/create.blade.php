@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de clientes</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.clientes.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Nombre del cliente</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre', $cliente->nombre ?? '') }}" name="nombre"
                                                        required>
                                                    @error('nombre')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-badge"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Apellido</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('apellido', $cliente->apellido ?? '') }}" name="apellido"
                                                        required>
                                                    @error('apellido')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-badge"></i>
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
                                                        value="{{ old('telefono', $cliente->telefono ?? '') }}"
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
                                                        value="{{ old('email', $cliente->email ?? '') }}" name="email"
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
                                                <label for="">Dirección</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('direccion', $cliente->direccion ?? '') }}" name="direccion"
                                                        required>
                                                    @error('direccion')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-house-door"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar cliente</button>
                                                <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Cancelar</a>
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
