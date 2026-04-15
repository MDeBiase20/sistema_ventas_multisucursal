@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <h3>Ventas/Listado</h3>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        @if ($cajaAbierta)
                            <div style="text-align: right">
                                <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">Crear Venta</a>
                            </div>
                        @else
                            <div style="text-align: right">
                                <a href="{{ route('admin.cajas.create') }}" class="btn btn-danger">Crear Caja</a>
                            </div>
                        @endif
                        
                        <hr>
                        <div class="card-body">
                            <table class="table table-striped" id="ventas-table">
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
                                    <?php $contador_ventas = 1; ?>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td>{{ $contador_ventas++ }}</td>
                                            <td>{{ $venta->numero_venta ?? 'N/A' }}</td>
                                            <td>{{ $venta->fecha_venta ?? 'N/A' }}</td>
                                            <td>{{ $venta->sucursal->nombre ?? 'N/A' }}</td>
                                            <td>{{ $venta->total_venta ?? 'N/A' }}</td>
                                            <td>
                                                @if($venta->estado === 'confirmada')
                                                    <span class="badge bg-success">Confirmada</span>
                                                @elseif($venta->estado === 'anulada')
                                                    <span class="badge bg-danger">Anulada</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($venta->estado) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($venta->estado === 'confirmada')
                                                        <a href="{{ route('admin.ventas.show', $venta->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                        <a href="{{ route('admin.ventas.edit', $venta->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                        <a href="{{ route('admin.ventas.pdf', $venta->id) }}" class="btn btn-sm btn-warning" target="_blank">Imprimir Factura</a>
                                                        <form action="{{ route('admin.ventas.anular', $venta->id) }}" method="POST" style="display:inline;" id="miFormulario{{ $venta->id }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="preguntar{{ $venta->id }}(event)">Anular</button>
                                                        </form>

                                                        <script>
                                                            function preguntar{{ $venta->id }} (event){
                                                                event.preventDefault()
                                                                Swal.fire({
                                                                title: "¿Estás seguro de anular esta venta?",
                                                                icon: "question",
                                                                showDenyButton: true,
                                                                showCancelButton: false,
                                                                confirmButtonText: "Anular",
                                                                denyButtonText: `No anular`
                                                                }).then((result) => {
                                                                /* Read more about isConfirmed, isDenied below */
                                                                if (result.isConfirmed) {
                                                                    var form = $('#miFormulario{{ $venta->id }}')
                                                                    form.submit()
                                                                }
                                                                });
                                                            }
                                                            
                                                        </script>
                                                @else
                                                <a href="{{ route('admin.ventas.show', $venta->id) }}" class="btn btn-sm btn-info">Ver</a>
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
                $("#ventas-table").DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                        "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Ventas",
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
