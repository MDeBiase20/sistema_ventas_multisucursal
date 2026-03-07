@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Clientes/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">Crear Cliente</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="clientes-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre y Apellido</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_clientes = 1; ?>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $contador_clientes++ }}</td>
                                            <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                                            <td>{{ $cliente->email }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>{{ $cliente->direccion }}</td>
                                            <td>
                                                <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $cliente->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $cliente->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $cliente->id }} (event){
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
                                                            var form = $('#miFormulario{{ $cliente->id }}')
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
                $("#clientes-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                        "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Clientes",
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
