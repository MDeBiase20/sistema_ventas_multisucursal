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
                        <div style="text-align: right">
                            <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear Producto</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="productos-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Sucursal</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_productos = 1; ?>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $contador_productos++ }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->precio }}</td>
                                            <td>{{ $producto->sucursal->nombre ?? 'N/A' }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>
                                                <a href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $producto->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $producto->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $producto->id }} (event){
                                                        event.preventDefault()
                                                        Swal.fire({
                                                        title: "¿Estás seguro de eliminar este registro de la base de datos?",
                                                        icon: "question",
                                                        showDenyButton: true,
                                                        showCancelButton: false,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `No eliminar`
                                                        }).then((result) => {
                                                        /* Read more about isConfirmed, isDenied below */
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario{{ $producto->id }}')
                                                            form.submit()
                                                        }
                                                        });
                                                    }
                                                    
                                                </script>

                                            </td>
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
