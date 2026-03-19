@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Productos/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="productos-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Sucursal</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_productos_sucursales = 1; ?>
                                    @foreach ($productos_sucursales as $producto_sucursal)
                                        <tr>
                                            <td>{{ $contador_productos_sucursales++ }}</td>
                                            <td>{{ $producto_sucursal->producto->codigo }}</td>
                                            <td>{{ $producto_sucursal->producto->nombre }}</td>
                                            <td>{{ $producto_sucursal->producto->precio }}</td>
                                            <td>{{ $producto_sucursal->stock }}</td>
                                            <td>{{ $producto_sucursal->sucursal->nombre }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $("#productos-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Productos",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscador:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                });
            </script>
        @endsection
