@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Actualizar Compra</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.compras.update', $compra->id) }}" method="post" id="formulario_compra">
                        @csrf
                        @method('PUT')
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
                                                    $total_compra = 0; ?>

                                                    @foreach ($compra->detalles as $detalle)
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
                                                            $total_compra += $total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: right" colspan="2"><b>Total cántidad</b></td>
                                                        
                                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>

                                                        <td style="text-align: center" colspan="2"><b>Precio Total</b></td>
                                                        
                                                        <td style="text-align: center"><b>{{ $total_compra }}</b></td>
                                                        
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-bs-toggle="modal" data-bs-target="#proveedorModal">
                                                    Buscar Proveedor
                                                </button>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" id="nombre_proveedor" value="{{ $compra->proveedor->nombre }}" class="form-control"
                                                    readonly>
                                                <input type="hidden" name="proveedor_id" value="{{ $compra->proveedor_id }}" readonly>
                                            </div>

                                            <!-- Modal para la búsqueda de proveedores-->
                                            <div class="modal fade" id="proveedorModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-l">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Listado de
                                                                proveedores</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="table_proveedores"
                                                                class="table table-striped table-hover table-sm dt-responsive nowrap"
                                                                style="width: 100%">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col" style="text-align: center">#
                                                                        </th>
                                                                        <th scope="col" style="text-align: center">
                                                                            Acción
                                                                        </th>
                                                                        <th scope="col" style="text-align: center">
                                                                            Empresa
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $contador_proveedores = 1; ?>
                                                                    @foreach ($proveedores as $proveedor)
                                                                        <tr>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                {{ $contador_proveedores++ }}</td>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                <button type="button"
                                                                                    class="btn btn-info btn-sm btn-seleccionar-proveedor"
                                                                                    data-id="{{ $proveedor->id }}"
                                                                                    data-empresa="{{ $proveedor->nombre }}">Seleccionar</button>
                                                                            </td>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                {{ $proveedor->nombre }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!---Modal para la búsqueda de proveedores--->

                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input type="date" name="fecha_compra"
                                                        value="{{ old('fecha_compra', $compra->fecha_compra) }}" class="form-control">
                                                    @error('fecha_compra')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="comprobante">Comprobante</label>
                                                    <input type="text" name="comprobante"
                                                        value="{{ old('comprobante', $compra->numero_compra) }}" class="form-control">
                                                    @error('comprobante')
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
                                                        <select class="form-control select2" name="sucursal_id">
                                                            <option value="" enabled>Seleccionar Sucursal</option>
                                                            @foreach ($sucursales as $sucursal)
                                                                <option value="{{ $sucursal->id }}" {{ old('sucursal_id', $compra->sucursal_id) == $sucursal->id ? 'selected' : '' }}>
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
                                                    <button type="submit" class="btn btn-success btn-block"><i
                                                            class="bi bi-save"></i> Actualizar compra</button>
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

    <script>
        //Función para que al apretar el botón "seleccionar" se ingrese el nombre del proveedor dentro del input
        $('.btn-seleccionar-proveedor').click(function() {
            var id_proveedor = $(this).data('id')
            var empresa = $(this).data('empresa')
            $('#nombre_proveedor').val(empresa)
            $('#id_proveedor').val(id_proveedor)
            $('#proveedorModal').modal('hide');
            $('#proveedorModal').on('hidden.bs.modal', function() {
                $('#nombre_proveedor').focus()
            });

            //alert(id_proveedor)
        })
    </script>
@endsection
