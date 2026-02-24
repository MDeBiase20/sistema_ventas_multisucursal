@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Datos de la sucursal</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Nombre de sucursal</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" value="{{ $sucursal->nombre }}"
                                                    name="nombre" disabled>
                                                @error('nombre')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-buildings"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="">Dirección</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control"
                                                    value="{{ $sucursal->direccion }}" name="direccion" disabled>
                                                @error('direccion')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-card-text"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Teléfono</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" value="{{ $sucursal->telefono }}"
                                                    name="telefono" disabled>
                                                @error('telefono')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="row">

                                        <div class="col-md-5">
                                            <label for="">Correo</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="email" class="form-control" value="{{ $sucursal->email }}"
                                                    name="email" disabled>
                                                @error('email')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-at"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="">Usuario Asignados</label>
                                            <ul class="list-group">
                                                @forelse ($sucursal->usuarios as $usuario)
                                                    <li class="list-group-item d-flex align-items-center">
                                                        <i class="bi bi-person me-2"></i> {{ $usuario->name }}
                                                    </li>
                                                @empty
                                                    <li class="list-group-item text-muted">No hay usuarios asignados</li>
                                                @endforelse
                                            </ul>
                                        </div>

                                    </div>

                                    <br>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('admin.sucursales.index') }}"
                                                class="btn btn-secondary">Volver</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        new Choices('.choices', {
            removeItemButton: true,
            allowHTML: false,
        });
    </script>
@endsection
