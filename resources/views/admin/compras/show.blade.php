@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detalle de la compra</h4>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-8">
                                        <br>
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
                                                    $total_compra = 0; ?>

                                                    @foreach ($compra->detalles as $detalle)
                                                        <tr>
                                                            <td style="text-align: center">{{ $contador++ }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                                                            <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                                                            <td style="text-align: center">{{ $detalle->producto->precio }}</td>
                                                            <td style="text-align: center">{{ $total = $detalle->producto->precio * $detalle->cantidad }}</td>
                                                        </tr>
                                                        @php
                                                            $total_cantidad += $detalle->cantidad;
                                                            $total_compra += $total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: center" colspan="2"><b>Total cántidad</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>

                                                        <td style="text-align: center" colspan="1"></td>

                                                        <td style="text-align: center" colspan="1"><b>Precio Total</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_compra }}</b></td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="col-md-10">
                                                <label for="nombre_proveedor">Proveedor</label>
                                                <input type="text" id="nombre_proveedor" style="text-align: center" value="{{ $compra->proveedor->nombre ?? '' }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input type="date" name="fecha_compra"
                                                        value="{{ old('fecha_compra', $compra->fecha_compra) }}" class="form-control" readonly>
                                                    @error('fecha_compra')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="comprobante">Comprobante</label>
                                                    <input type="text" name="comprobante"
                                                        value="{{ old('comprobante', $compra->numero_compra) }}" class="form-control" readonly>
                                                    @error('comprobante')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sucursal">Sucursal</label>
                                                    <input type="text" name="sucursal"
                                                        value="{{ old('sucursal', $compra->sucursal->nombre) }}" class="form-control" readonly>
                                                    @error('sucursal')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="precio_total">Costo Total</label>
                                                    <input type="text"
                                                        style="text-align: center; color:rgb(0, 0, 0); background-color:bisque"
                                                        name="precio_total" value="{{ $total_compra }}"
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
                                                    <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary btn-block">Volver</a>
                                                </div>
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
@endsection
