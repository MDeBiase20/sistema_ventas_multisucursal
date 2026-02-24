@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Actulización de la Sucursal</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sucursales.update', $sucursal) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Nombre de la sucursal</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ $sucursal->nombre}}" name="nombre"
                                                        required>
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
                                                        value="{{ $sucursal->direccion  }}"
                                                        name="direccion" required>
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
                                                    <input type="text" class="form-control"
                                                        value="{{ $sucursal->telefono  }}"
                                                        name="telefono" required>
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
                                                    <input type="email" class="form-control"
                                                        value="{{ $sucursal->email  }}" name="email"
                                                        required>
                                                    @error('email')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-at"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Usuario</label>
                                                    <select class="form-control choices multiple-remove" multiple="multiple" name="usuarios[]">
                                                        <option value="" enabled>Seleccionar Usuario</option>
                                                        @foreach ($usuarios as $usuario)
                                                            <option value="{{ $usuario->id }}" {{ $sucursal->usuarios->contains($usuario->id) ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('usuario_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                            </div>

                                        </div>

                                        <br>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Actualizar sucursal</button>
                                                <a href="{{ route('admin.sucursales.index') }}"
                                                    class="btn btn-secondary">Cancelar</a>
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
    <script>
        new Choices('.choices', {
            removeItemButton: true,
            allowHTML: false,
        });
    </script>
@endsection
