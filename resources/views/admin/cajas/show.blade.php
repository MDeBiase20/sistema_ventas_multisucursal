@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Datos de Caja</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Fecha de apertura</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="datetime-local" class="form-control"
                                                    value="{{ old('fecha_apertura', $caja->fecha_apertura ?? '') }}"
                                                    name="fecha_apertura" disabled>
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
                                        <div class="col-md-12">
                                            <label for="">Monto inicial</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control"
                                                    value="{{ old('monto_inicial', $caja->monto_inicial ?? '') }}"
                                                    name="monto_inicial" disabled>
                                                @error('monto_inicial')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="">Sucursal</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <select class="form-control select2" name="sucursal_id" disabled>
                                                    <option value="" enabled>Seleccionar Sucursal</option>
                                                    @foreach ($sucursales as $sucursal)
                                                        <option value="{{ $sucursal->id }}"
                                                            {{ $caja->sucursal_id === $sucursal->id ? 'selected' : '' }}>
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Fecha de cierre</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="datetime-local" class="form-control"
                                                    value="{{ old('fecha_cierre', $caja->fecha_cierre ?? '') }}"
                                                    name="fecha_cierre" disabled>
                                                @error('fecha_cierre')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Monto final</label>
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control"
                                                    value="{{ old('monto_final', $caja->monto_cierre_real ?? '') }}"
                                                    name="monto_final" disabled>
                                                @error('monto_final')
                                                    <small style="color: red">{{ $message }}</small>
                                                @enderror
                                                <div class="form-control-icon">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('admin.cajas.index') }}" class="btn btn-secondary">Volver</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ingresos</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table table-striped table-bordered table-hover table-sm table-success">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th>#</th>
                                                    <th>Monto</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $contador_ingresos = 1; ?>
                                                @foreach ($ingresos as $ingreso)
                                                    <tr style="text-align: center">
                                                        <td>{{ $contador_ingresos++ }}</td>
                                                        <td>{{ $ingreso->monto }}</td>
                                                        <td>{{ $ingreso->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr style="text-align: center">
                                                    <th colspan="1">Total Ingresos</th>
                                                    <th colspan="1">{{ $ingresos->sum('monto') }}</th>
                                                    <th colspan="0"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Egresos</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table table-striped table-bordered table-hover table-sm table-danger">
                                            <thead>
                                                <tr style="text-align: center">
                                                    <th>#</th>
                                                    <th>Monto</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $contador_egresos = 1; ?>
                                                @foreach ($egresos as $egreso)
                                                    <tr style="text-align: center">
                                                        <td>{{ $contador_egresos++ }}</td>
                                                        <td>{{ $egreso->monto }}</td>
                                                        <td>{{ $egreso->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr style="text-align: center">
                                                    <th colspan="1">Total Egresos</th>
                                                    <th colspan="1">{{ $egresos->sum('monto') }}</th>
                                                    <th colspan="0"></th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        
    </div>

@endsection
