@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Datos de la venta</h4>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-8">

                                        <div class="row">
                                            <table
                                                class="table table-striped table-sm table-bordered table-group-divider table-hover"
                                                style="width: 100%">
                                                <thead class="table-primary">
                                                    <tr style="text-align: center">
                                                        <th>Nro</th>
                                                        <th>Código</th>
                                                        <th>Cántidad</th>
                                                        <th>Nombre</th>
                                                        <th>Costo</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $contador = 1;
                                                    $total_cantidad = 0;
                                                    $total_venta = 0; ?>

                                                    @foreach ($venta->detalles as $detalle)
                                                        <tr>
                                                            <td style="text-align: center">{{ $contador++ }}</td>
                                                            <td style="text-align: center">
                                                                {{ $detalle->producto->codigo }}</td>
                                                            <td style="text-align: center">{{ $detalle->cantidad }}
                                                            </td>
                                                            <td style="text-align: center">
                                                                {{ $detalle->producto->nombre }}</td>
                                                            <td style="text-align: center">
                                                                {{ $detalle->producto->precio }}</td>
                                                            <td style="text-align: center">
                                                                {{ $total = $detalle->producto->precio * $detalle->cantidad }}
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $total_cantidad += $detalle->cantidad;
                                                            $total_venta += $total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: right" colspan="2"><b>Total cántidad</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>
                                                        
                                                        <td style="text-align: center" colspan="1"></td>

                                                        <td style="text-align: right" colspan="1"><b>Precio Total</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_venta }}</b></td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" value="{{ $venta->cliente->nombre ?? ' S/N' }}" id="nombre_cliente" class="form-control" readonly>
                                                <input type="text" id="id_cliente" class="form-control"
                                                    name="cliente_id" hidden>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input type="date" name="fecha_venta"
                                                        value="{{ old('fecha_venta', $venta->fecha_venta) }}" class="form-control" readonly>
                                                    @error('fecha_venta')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="numero_venta">Número de Venta</label>
                                                    <input type="text" name="numero_venta"
                                                        value="{{ old('numero_venta', $venta->numero_venta) }}" class="form-control" readonly>
                                                    @error('numero_venta')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="precio_total">Sucursal</label>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <input type="text" name="sucursal"
                                                        value="{{ old('sucursal', $venta->sucursal->nombre) }}" class="form-control" readonly>
                                                        @error('sucursal_id')
                                                            <small style="color: red">{{ $message }}</small>
                                                        @enderror
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-list"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="precio_total">Costo Total</label>
                                                    <input type="text"
                                                        style="text-align: center; color:rgb(0, 0, 0); background-color:bisque"
                                                        name="precio_total" value="{{ $total_venta }}"
                                                        class="form-control" readonly>
                                                    @error('precio_total')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary btn-block">
                                                        <i class="bi bi-arrow-left"></i> Volver
                                                    </a>
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

@endsection
