@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Compras/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div style="text-align: right">
                            <a href="{{ route('admin.compras.create') }}" class="btn btn-primary">Crear Compra</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="compras-table">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>#</th>
                                        <th>Número de Factura</th>
                                        <th>Fecha</th>
                                        <th>Sucursal</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    <?php $contador_compras = 1; ?>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ $contador_compras++ }}</td>
                                            <td>{{ $compra->numero_compra ?? 'N/A' }}</td>
                                            <td>{{ $compra->fecha_compra ?? 'N/A' }}</td>
                                            <td>{{ $compra->sucursal->nombre ?? 'N/A' }}</td>
                                            <td>{{ $compra->total_compra ?? 'N/A' }}</td>
                                            <td>
                                                @if($compra->estado === 'activa')
                                                    <span class="badge bg-success">Activa</span>
                                                @elseif($compra->estado === 'anulada')
                                                    <span class="badge bg-danger">Anulada</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($compra->estado) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.compras.show', $compra->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('admin.compras.edit', $compra->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                    @if($compra->estado === 'activa')
                                                        <form action="{{ route('admin.compras.anular', $compra->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $compra->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $compra->id }}(event)">Anular</button>
                                                        </form>

                                                        <script>
                                                            function preguntar{{ $compra->id }} (event){
                                                                event.preventDefault()
                                                                Swal.fire({
                                                                title: "¿Estás seguro de anular esta compra?",
                                                                icon: "question",
                                                                showDenyButton: true,
                                                                showCancelButton: false,
                                                                confirmButtonText: "Anular",
                                                                denyButtonText: `No anular`
                                                                }).then((result) => {
                                                                /* Read more about isConfirmed, isDenied below */
                                                                if (result.isConfirmed) {
                                                                    var form = $('#miFormulario{{ $compra->id }}')
                                                                    form.submit()
                                                                }
                                                                });
                                                            }
                                                            
                                                        </script>
                                                    @endif
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
                $("#compras-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                        "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Compras",
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
