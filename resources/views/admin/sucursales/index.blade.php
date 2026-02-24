@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Sucursales/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.sucursales.create') }}" class="btn btn-primary">Crear Sucursal</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="sucursales-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_sucursales = 1; ?>
                                    @foreach ($sucursales as $sucursal)
                                        <tr>
                                            <td>{{ $contador_sucursales++ }}</td>
                                            <td>{{ $sucursal->nombre }}</td>
                                            <td>{{ $sucursal->direccion }}</td>
                                            <td>{{ $sucursal->email }}</td>
                                            <td>{{ $sucursal->telefono }}</td>
                                            <td>
                                                
                                                <a href="{{ route('admin.sucursales.show', $sucursal->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('admin.sucursales.edit', $sucursal->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('admin.sucursales.destroy', $sucursal->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $sucursal->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $sucursal->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $sucursal->id }} (event){
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
                                                            var form = $('#miFormulario{{ $sucursal->id }}')
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
                $("#sucursales-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Sucursales",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Sucursales",
                        "infoFiltered": "(Filtrado de _MAX_ total Sucursales)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Sucursales",
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
