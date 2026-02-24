@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Actualización de Usuarios</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="post">
                        @csrf
                        @method('PUT')
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
                                                        value="{{ old('nombre', $usuario->name) }}" name="nombre"
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
                                                            <option value="{{ $rol->id }}" {{ optional($usuario->roles->first())->id === $rol->id ? 'selected' : '' }}>{{ $rol->name }}</option>
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
                                                        value="{{ old('email', $usuario->email) }}" name="email"
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
                                                        value="{{ old('password') }}" name="password">
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
                                                        value="{{ old('password_confirmation') }}" name="password_confirmation">
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
                                                <button type="submit" class="btn btn-success">Actualizar usuario</button>
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
