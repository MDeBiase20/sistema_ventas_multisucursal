@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Proveedores/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.proveedores.create') }}" class="btn btn-primary">Crear Proveedor</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="proveedores-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Cuit</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_proveedores = 1; ?>
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $contador_proveedores++ }}</td>
                                            <td>{{ $proveedor->nombre }}</td>
                                            <td>{{ $proveedor->direccion }}</td>
                                            <td>{{ $proveedor->email }}</td>
                                            <td>{{ $proveedor->telefono }}</td>
                                            <td>{{ $proveedor->cuit }}</td>
                                            <td>
                                                <a href="{{ route('admin.proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $proveedor->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $proveedor->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $proveedor->id }} (event){
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
                                                            var form = $('#miFormulario{{ $proveedor->id }}')
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
                $("#proveedores-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                        "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Proveedores",
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
