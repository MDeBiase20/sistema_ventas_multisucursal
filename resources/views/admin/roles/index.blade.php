@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Roles/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Crear Rol</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="roles-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_roles = 1; ?>
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <td>{{ $contador_roles++ }}</td>
                                            <td>{{ $rol->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.roles.edit', $rol->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.roles.destroy', $rol->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $rol->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $rol->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $rol->id }} (event){
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
                                                            var form = $('#miFormulario{{ $rol->id }}')
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
                $("#roles-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                        "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Roles",
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
