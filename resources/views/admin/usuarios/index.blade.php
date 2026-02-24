@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Usuarios/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="usuarios-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_usuarios = 1; ?>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $contador_usuarios++ }}</td>
                                            <td>{{ $usuario->name }}</td>
                                            {{-- El implode sirve para mostrar de manera correcta el nombre del rol ya que con el "pluck" me lo muestra como si fuere una cadena json --}}
                                            <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $usuario->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $usuario->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $usuario->id }} (event){
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
                                                            var form = $('#miFormulario{{ $usuario->id }}')
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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                        "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Usuarios",
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
