@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Actualización de Caja</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cajas.update', $caja->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">Fecha de apertura</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="datetime-local" class="form-control"
                                                        value="{{ old('fecha_apertura', $caja->fecha_apertura ?? '') }}" name="fecha_apertura"
                                                        required>
                                                    @error('fecha_apertura')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">Monto inicial</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('monto_inicial', $caja->monto_inicial ?? '') }}" name="monto_inicial"
                                                        required>
                                                    @error('monto_inicial')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">

                                            <div class="col-md-8">
                                                <label for="">Sucursal</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control select2" name="sucursal_id">
                                                        <option value="" enabled>Seleccionar Sucursal</option>
                                                        @foreach ($sucursales as $sucursal)
                                                            <option value="{{ $sucursal->id }}" {{ $caja->sucursal_id === $sucursal->id ? 'selected' : '' }}>
                                                                {{ $sucursal->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('sucursal_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Actualizar Caja</button>
                                                <a href="{{ route('admin.cajas.index') }}" class="btn btn-secondary">Cancelar</a>
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
