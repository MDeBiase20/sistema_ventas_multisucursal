@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Configuración de la Empresa</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.empresas.update', $empresa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Nombre de la empresa</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre', $empresa->nombre ?? '') }}" name="nombre"
                                                        required>
                                                    @error('nombre')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-buildings"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">País</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form-control" name="pais_id" id="pais_id">
                                                        @foreach ($paises as $pais)
                                                            <option value="{{ $pais->id }}"
                                                                {{ $empresa->pais_id == $pais->id ? 'selected' : '' }}>
                                                                {{ $pais->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pais_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-globe"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Departamento/Localidad</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form form-control" name="departamento_id" id="estado_id">
                                                        @foreach ($estados as $estado)
                                                            <option value="{{ $estado->id }}"
                                                                {{ $empresa->departamento_id == $estado->id ? 'selected' : '' }}>
                                                                {{ $estado->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('departamento_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-globe-americas"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Cuidad</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form form-control" name="ciudad_id" id="ciudad_id">
                                                        @foreach ($ciudades as $ciudad)
                                                            <option value="{{ $ciudad->id }}"
                                                                {{ $empresa->ciudad_id == $ciudad->id ? 'selected' : '' }}>
                                                                {{ $ciudad->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('ciudad_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-globe-americas"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Tipo de empresa</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('tipo_empresa', $empresa->tipo_empresa ?? '') }}"
                                                        name="tipo_empresa" required>
                                                    @error('tipo_empresa')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-buildings"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Dirección</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('direccion', $empresa->direccion ?? '') }}"
                                                        name="direccion" required>
                                                    @error('direccion')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-card-text"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Teléfono</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('telefono', $empresa->telefono ?? '') }}"
                                                        name="telefono" required>
                                                    @error('telefono')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-telephone"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Correo</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="email" class="form-control"
                                                        value="{{ old('email', $empresa->email ?? '') }}" name="email"
                                                        required>
                                                    @error('email')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-at"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Cuit</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('cuit', $empresa->cuit ?? '') }}" name="cuit"
                                                        required>
                                                    @error('cuit')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person-vcard"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="">Impuesto</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="number" class="form-control"
                                                        value="{{ old('impuesto', $empresa->impuesto ?? '') }}"
                                                        name="impuesto" required>
                                                    @error('impuesto')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-cash"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Nombre del Impuesto</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control"
                                                        value="{{ old('nombre_impuesto', $empresa->nombre_impuesto ?? '') }}"
                                                        name="nombre_impuesto" required>
                                                    @error('nombre_impuesto')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-journal-text"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Moneda</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <select class="form form-control" name="moneda_id" id="moneda">
                                                        <option value="">Seleccionar moneda</option>
                                                        @foreach ($monedas as $moneda)
                                                            <option value="{{ $moneda->id }}"
                                                                {{ $empresa->moneda_id == $moneda->id ? 'selected' : '' }}>
                                                                {{ $moneda->symbol }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('moneda_id')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-currency-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="">Código Postal</label>
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="number" class="form-control"
                                                        value="{{ old('codigo_postal', $empresa->codigo_postal ?? '') }}"
                                                        name="codigo_postal" required>
                                                    @error('codigo_postal')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-journal-code"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="">Logo</label>
                                                <div class="form-group">
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="logo">
                                                    @error('logo')
                                                        <small style="color: red">{{ $message }}</small>
                                                    @enderror

                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Actualizar empresa</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <!-- Scripts AJAX -->
                <script>
                    const RUTA_ESTADOS = "{{ route('ubicaciones.estados', '__ID__') }}";
                    const RUTA_CIUDADES = "{{ route('ubicaciones.ciudades', '__ID__') }}";

                    $(document).on('change', '#pais_id', function() {
                        let paisId = $(this).val();
                        console.log('País seleccionado:', paisId);

                        let $estado = $('#estado_id');
                        let $ciudad = $('#ciudad_id');

                        // Limpiar selects dependientes
                        $estado.html('<option value="">Seleccione...</option>');
                        $ciudad.html('<option value="">Seleccione...</option>');

                        if (!paisId) return;

                        let url = RUTA_ESTADOS.replace('__ID__', paisId);

                        $.getJSON(url, function(resp) {
                            if (resp.success) {
                                resp.data.forEach(e => {
                                    $estado.append(`<option value="${e.id}">${e.name}</option>`);
                                });
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.error('Error al cargar estados:', errorThrown);
                        });
                    });

                    $(document).on('change', '#estado_id', function() {
                        let estadoId = $(this).val();
                        console.log('Estado seleccionado:', estadoId);

                        let $ciudad = $('#ciudad_id');
                        $ciudad.html('<option value="">Seleccione...</option>');

                        if (!estadoId) return;

                        let url = RUTA_CIUDADES.replace('__ID__', estadoId);

                        $.getJSON(url, function(resp) {
                            if (resp.success) {
                                resp.data.forEach(c => {
                                    $ciudad.append(`<option value="${c.id}">${c.name}</option>`);
                                });
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.error('Error al cargar ciudades:', errorThrown);
                        });
                    });
                </script>

            </div>
        </div>
    </div>
    </div>
@endsection
