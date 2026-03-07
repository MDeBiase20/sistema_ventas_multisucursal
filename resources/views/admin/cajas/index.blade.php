@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Cajas/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.cajas.create') }}" class="btn btn-primary">Crear Caja</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="cajas-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha de Apertura</th>
                                        <th>Monto Inicial</th>
                                        <th>Fecha de Cierre</th>
                                        <th>Monto Final</th>
                                        <th>Sucursal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_cajas = 1; ?>
                                    @foreach ($cajas as $caja)
                                        <tr>
                                            <td>{{ $contador_cajas++ }}</td>
                                            <td>{{ $caja->fecha_apertura }}</td>
                                            <td>{{ $caja->monto_inicial }}</td>
                                            <td>{{ $caja->fecha_cierre }}</td>
                                            <td>{{ $caja->monto_final }}</td>
                                            <td>{{ $caja->sucursal->nombre }}</td>
                                            <td>
                                                <a href="{{ route('admin.cajas.show', $caja->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('admin.cajas.edit', $caja->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <a href="{{ route('admin.cajas.cerrar', $caja->id) }}" class="btn btn-sm btn-warning">Cierre</a>
                                                <a href="{{ route('admin.cajas.ingresos-egresos', $caja->id) }}" class="btn btn-sm btn-secondary">Ingreso-Egreso</a>
                                                <form action="{{ route('admin.cajas.destroy', $caja->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $caja->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $caja->id }}(event)">Eliminar</button>
                                                </form>

                                                <script>
                                                    function preguntar{{ $caja->id }} (event){
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
                                                            var form = $('#miFormulario{{ $caja->id }}')
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
                $("#cajas-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Cajas",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Cajas",
                        "infoFiltered": "(Filtrado de _MAX_ total Cajas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Cajas",
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
