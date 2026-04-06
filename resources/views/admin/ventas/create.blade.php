@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registro de Ventas</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ventas.store') }}" method="post" id="formulario_venta">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cantidad">Cántidad</label>
                                                    <input type="number" id="cantidad"
                                                        style="text-align: center; background-color:#f0e2c0" min="1"
                                                        name="cantidad" value="1" class="form-control" required>
                                                    @error('cantidad')
                                                        <small style="color:red;"> {{ $message }} </small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Código</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('codigo', $producto->codigo ?? '') }}" name="codigo"
                                                        id="codigo" placeholder="Ingrese el código del producto">

                                                    @error('codigo')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-upc-scan"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div style="height: 25px"></div>

                                                    <!-- Button trigger modal -->
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-success" style="width: 200px"
                                                            data-bs-toggle="modal" data-bs-target="#ModalProducts">
                                                            <i class="bi bi-search"></i>
                                                        </button>
                                                    </div>

                                                    <!---Modal para la búsqueda de productos--->

                                                    <div class="modal fade" id="ModalProducts" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Seleccione un producto</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <table id="products-table"
                                                                        class="table  table-responsive table-sm table-striped table-hover table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="text-align:center;">#</th>
                                                                                <th style="text-align:center;">Nombre</th>
                                                                                <th style="text-align:center;">Código</th>
                                                                                <th style="text-align:center;">Stock</th>
                                                                                <th style="text-align:center;">Acciones</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody style="text-align:center;">
                                                                            <?php
                                                                                $contador_productos = 0;
                                                                                foreach($productos as $producto){
                                                                                    $id_producto = $producto['id_producto'];
                                                                                    $contador_productos++;
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $contador_productos; ?></td>
                                                                                <td><?php echo $producto->producto->nombre; ?></td>
                                                                                <td><?php echo $producto->producto->codigo; ?></td>
                                                                                @if($producto->stock > 0)
                                                                                    <td style="background-color:rgb(154, 230, 154); color: black;"><?php echo $producto->stock; ?></td>
                                                                                @else
                                                                                    <td style="color:rgb(238, 119, 119); color: black;"><?php echo $producto->stock; ?></td>
                                                                                @endif
                                                                                <td>
                                                                                    <button type="button"
                                                                                        data-id="<?php echo $producto->producto->codigo; ?>"
                                                                                        class="btn btn-info btn-sm btn-seleccionar">Seleccionar
                                                                                    </button>
                                                                                </td>

                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                            </tr>
                                                                        </tbody>

                                                                    </table>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!---Modal para la búsqueda de productos--->


                                                </div>
                                            </div>

                                        </div>
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
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $contador = 1;
                                                    $total_cantidad = 0;
                                                    $total_venta = 0; ?>

                                                    @foreach ($tmp_ventas as $tmp_venta)
                                                        <tr>
                                                            <td style="text-align: center">{{ $contador++ }}</td>
                                                            <td style="text-align: center">
                                                                {{ $tmp_venta->producto->codigo }}</td>
                                                            <td style="text-align: center">{{ $tmp_venta->cantidad }}
                                                            </td>
                                                            <td style="text-align: center">
                                                                {{ $tmp_venta->producto->nombre }}</td>
                                                            <td style="text-align: center">
                                                                {{ $tmp_venta->producto->precio }}</td>
                                                            <td style="text-align: center">
                                                                {{ $total = $tmp_venta->producto->precio * $tmp_venta->cantidad }}
                                                            </td>
                                                            <td style="text-align: center">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-btn"
                                                                    data-id="{{ $tmp_venta->id }}"><i
                                                                        class="bi bi-trash3-fill"></i></button>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $total_cantidad += $tmp_venta->cantidad;
                                                            $total_venta += $total;
                                                        @endphp
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <td style="text-align: right" colspan="2"><b>Total cántidad</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>

                                                        <td style="text-align: right" colspan="2"><b>Precio Total</b>
                                                        </td>
                                                        <td style="text-align: center"><b>{{ $total_venta }}</b></td>
                                                        <td colspan="1"></td>
                                                    </tr>
                                                </tfoot>

                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    data-bs-toggle="modal" data-bs-target="#clienteModal">
                                                    Buscar Cliente
                                                </button>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" id="nombre_cliente" class="form-control" readonly>
                                                <input type="text" id="id_cliente" class="form-control"
                                                    name="cliente_id" hidden>
                                            </div>

                                            <!-- Modal para la búsqueda de clientes-->
                                            <div class="modal fade" id="clienteModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-l">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Listado de
                                                                clientes</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="table_clientes"
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
                                                                            Cliente
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $contador_clientes = 1; ?>
                                                                    @foreach ($clientes as $cliente)
                                                                        <tr>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                {{ $contador_clientes++ }}</td>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                <button type="button"
                                                                                    class="btn btn-info btn-sm btn-seleccionar-cliente"
                                                                                    data-id="{{ $cliente->id }}"
                                                                                    data-cliente="{{ $cliente->nombre }}">Seleccionar</button>
                                                                            </td>
                                                                            <td
                                                                                style="text-align: center; vertical-align:middle">
                                                                                {{ $cliente->nombre }}
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input type="date" name="fecha_venta"
                                                        value="{{ old('fecha_venta') }}" class="form-control">
                                                    @error('fecha_venta')
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
                                                    <button type="submit" class="btn btn-primary btn-block"><i
                                                            class="bi bi-save"></i> Registrar venta</button>
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
        //Función para que al apretar el botón "seleccionar" se ingrese el nombre del cliente dentro del input
        $('.btn-seleccionar-cliente').click(function() {
            var id_cliente = $(this).data('id')
            var nombre_cliente = $(this).data('cliente')
            $('#nombre_cliente').val(nombre_cliente)
            $('#id_cliente').val(id_cliente)
            $('#clienteModal').modal('hide');
            $('#clienteModal').on('hidden.bs.modal', function() {
                $('#nombre_cliente').focus()
            });

            //alert(id_proveedor)
        })

        //Función para que al apretar el botón "seleccionar" se ingrese el código del producto dentro del input
        $('.btn-seleccionar').click(function() {

            var codigo = $(this).data('id');

            $('#codigo').val(codigo);

            $('#ModalProducts').modal('hide');

            setTimeout(function() {
                $('#codigo').focus();
                $('#codigo').trigger($.Event('keypress', {
                    which: 13
                }));
            }, 300);

        });

        //Script para que al presionar la tecla "Enter" dentro del input del código se ejecute la función de agregar el producto a la tabla temporal
        $('#formulario_venta').on('keypress', function(e) {
            if (e.which == 13) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            }
        });

        //Código AJAX para agregar los productos a la tabla temporal
        $('#codigo').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.ventas-temporales.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: $('#codigo').val(),
                        cantidad: $('#cantidad').val()
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function(xhr) {
                        let response = JSON.parse(xhr.responseText);
                        alert(response.error);
                    }
                });
            }
        });

        //Código AJAX para eliminar los productos de la tabla temporal
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.ventas-temporales.destroy', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error al eliminar el producto de la compra temporal');
                }
            });
        });
    </script>
@endsection
