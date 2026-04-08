@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Asignar permisos al {{ $rol->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.asignar', $rol->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        {{-- foreach para desplegar la agrupación --}}
                        @foreach($permisos as $modulo => $grupoPermisos)
                            <h5>{{ $modulo }}</h5>
                            <div class="mb-3">
                                @foreach($grupoPermisos as $grupoPermiso)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $grupoPermiso->id }}" id="permiso{{ $grupoPermiso->id }}"
                                            {{ $rol->hasPermissionTo($grupoPermiso->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permiso{{ $grupoPermiso->id }}">
                                            {{ $grupoPermiso->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Actualizar Permisos</button>
                    </form>

                </div>
    </div>
@endsection
