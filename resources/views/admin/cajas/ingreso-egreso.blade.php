@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Movimiento de Caja</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.cajas.movimientos', $caja) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">Tipo de movimiento</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control select2" name="tipo_movimiento">
                                                        <option value="" disabled selected>Seleccionar Tipo</option>
                                                        <option value="ingreso">Ingreso</option>
                                                        <option value="egreso">Egreso</option>
                                                    </select>
                                                    @error('tipo_movimiento')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">Monto</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('monto') }}" name="monto"
                                                        required>
                                                    @error('monto')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="">Descripción</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('descripcion') }}" name="descripcion"
                                                        required>
                                                    @error('descripcion')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
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
