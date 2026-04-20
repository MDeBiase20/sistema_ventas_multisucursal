@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de Caja</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cajas.cierre', $caja->id) }}" method="post">
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
                                            <div class="col-md-8">
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

                                            <div class="col-md-8">
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
                                            <div class="col-md-8">
                                                <label for="">Fecha de cierre</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="datetime-local" class="form-control"
                                                        value="{{ old('fecha_cierre', $caja->fecha_cierre ?? '') }}"
                                                        name="fecha_cierre" required>
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
                                            <div class="col-md-8">
                                                <label for="">Monto Teórico</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="monto_teorico"
                                                        value="{{ $monto_teorico }}" name="monto_teorico" readonly>
                                                    @error('monto_teorico')
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
                                                <label for="">Monto Efectivo</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="monto_efectivo"
                                                        value="{{ old('monto_efectivo', $caja->monto_efectivo ?? '') }}"
                                                        name="monto_efectivo">
                                                    @error('monto_efectivo')
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
                                                <label for="">Monto Transferencia</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="monto_transferencia"
                                                        value="{{ old('monto_transferencia', $caja->monto_transferencia ?? '') }}"
                                                        name="monto_transferencia">
                                                    @error('monto_transferencia')
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
                                                <label for="">Otros</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="monto_otros"
                                                        value="{{ old('monto_otros') }}" name="monto_otros">
                                                    @error('monto_otros')
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
                                                <label for="">Total Real</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="total_real"
                                                        value="{{ old('monto_cierre_real', $caja->monto_cierre_real ?? '') }}"
                                                        name="monto_cierre_real" readonly>
                                                    @error('monto_cierre_real')
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
                                                <label for="">Diferencia</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" id="diferencia"
                                                        value="{{ old('diferencia', $caja->diferencia ?? '') }}"
                                                        name="diferencia" readonly>
                                                    @error('diferencia')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mt-3">
                                                <label>Estado de caja</label>
                                                <div id="estado_caja" class="alert text-center fw-bold">
                                                    -
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Cerrar Caja</button>
                                                <a href="{{ route('admin.cajas.index') }}"
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

    <script>
        function calcularCaja() {
            let monto_efectivo = parseFloat(document.getElementById('monto_efectivo').value) || 0;
            let monto_transferencia = parseFloat(document.getElementById('monto_transferencia').value) || 0;
            let monto_otros = parseFloat(document.getElementById('monto_otros').value) || 0;
            let monto_teorico = parseFloat(document.getElementById('monto_teorico').value) || 0;

            let totalReal = monto_efectivo + monto_transferencia + monto_otros;
            let diferencia = totalReal - monto_teorico;

            document.getElementById('total_real').value = totalReal.toFixed(2);
            document.getElementById('diferencia').value = diferencia.toFixed(2);

            // 🔥 INDICADOR VISUAL
            let estadoCaja = document.getElementById('estado_caja');

            // tolerancia configurable
            let tolerancia = 100; // podés ajustar

            estadoCaja.classList.remove('alert-success', 'alert-danger', 'alert-warning');

            if (Math.abs(diferencia) <= tolerancia) {
                estadoCaja.classList.add('alert-success');
                estadoCaja.innerText = '✔ Caja equilibrada';
            } else if (diferencia > 0) {
                estadoCaja.classList.add('alert-warning');
                estadoCaja.innerText = '⚠ Sobrante de ' + diferencia.toFixed(2);
            } else {
                estadoCaja.classList.add('alert-danger');
                estadoCaja.innerText = '✖ Faltante de ' + Math.abs(diferencia).toFixed(2);
            }

        }

        // listeners
        document.getElementById('monto_efectivo').addEventListener('input', calcularCaja);
        document.getElementById('monto_transferencia').addEventListener('input', calcularCaja);
        document.getElementById('monto_otros').addEventListener('input', calcularCaja);

        // ejecutar al cargar (clave)
        window.addEventListener('load', calcularCaja);
        
    </script>
@endsection
