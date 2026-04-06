@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de Caja</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cajas.store') }}" method="post">
                        @csrf
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
                                                    <select id="sucursal_select" class="form-control" disabled>
                                                            @foreach ($sucursales as $sucursal)
                                                                <option value="{{ $sucursal->id }}"
                                                                    {{ session('sucursal_id') == $sucursal->id ? 'selected' : '' }}>
                                                                    {{ $sucursal->nombre }}
                                                                </option>
                                                            @endforeach
                                                    </select readonly>
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
                                                <button type="submit" class="btn btn-primary">Registrar Caja</button>
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
