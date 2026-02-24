@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Creación de Usuarios</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="empresa_id" value="{{ auth()->user()->empresa_id }}" hidden>
                                                <label for="">Nombre del usuario</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre') }}" name="nombre"
                                                        required>
                                                    @error('nombre')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Rol</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control select2" name="rol_id">
                                                        <option value="" enabled>Seleccionar Rol</option>
                                                        @foreach ($roles as $rol)
                                                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('rol_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Correo electrónico</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="email" class="form-control"
                                                        value="{{ old('email') }}" name="email"
                                                        required>
                                                    @error('email')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Contraseña</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="password" class="form-control"
                                                        value="{{ old('password') }}" name="password"
                                                        required>
                                                    @error('password')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-key"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Repetir Contraseña</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="password" class="form-control"
                                                        value="{{ old('password_confirmation') }}" name="password_confirmation"
                                                        required>
                                                    @error('password_confirmation')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-key"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Agregar usuario</button>
                                                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Volver</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
    </div>
@endsection
