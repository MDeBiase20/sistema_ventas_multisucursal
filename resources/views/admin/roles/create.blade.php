@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Creación de Roles</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" name="empresa_id" value="{{ auth()->user()->empresa_id }}" hidden>
                                                <label for="">Nombre del rol</label>
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
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Agregar rol</button>
                                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Volver</a>
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
