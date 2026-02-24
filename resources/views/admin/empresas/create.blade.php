<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <- Select2 CSS and JS --> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <br>
        <h1 style="text-align: center">Registrar la empresa</h1>
        <br>

        <form action="{{ route('admin.empresas.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Nombre de la empresa</label>
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" required>
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
                                        <select class="form-control select2" name="pais_id" id="pais_id">
                                            <option value="">Seleccionar país</option>
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais['id'] }}">{{ $pais['name'] }}</option>
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
                                            <option value="">Seleccionar departamento/localidad</option>
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
                                            <option value="">Seleccionar ciudad</option>
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
                                        <input type="text" class="form-control" value="{{ old('tipo_empresa') }}" name="tipo_empresa" required>
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
                                        <input type="text" class="form-control" value="{{ old('direccion') }}" name="direccion" required>
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
                                        <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono" required>
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
                                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" required>
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
                                        <input type="text" class="form-control" value="{{ old('cuit') }}" name="cuit" required>
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
                                        <input type="number" class="form-control" value="{{ old('impuesto') }}" name="impuesto" required>
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
                                        <input type="text" class="form-control" value="{{ old('nombre_impuesto') }}" name="nombre_impuesto" required>
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
                                                <option value="{{ $moneda['id'] }}">{{ $moneda['symbol'] }}</option>
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
                                        <input type="number" class="form-control" value="{{ old('codigo_postal') }}" name="codigo_postal" required>
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
                                        <input class="form-control"  type="file" id="formFile" name="logo">
                                        @error('logo')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                        
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar empresa</button>
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

    const RUTA_ESTADOS = "{{ route('ubicaciones.estados', ':paisId') }}";
    const RUTA_CIUDADES = "{{ route('ubicaciones.ciudades', ':estadoId') }}";

    $(document).ready(function() {

        // 1. Cuando cambia el PAÍS → cargar ESTADOS
        $('#pais_id').on('change', function () {

            const paisId = $(this).val();
            const $estado = $('#estado_id');
            const $ciudad = $('#ciudad_id');

            if (!paisId) return;
            const url = RUTA_ESTADOS.replace(':paisId', paisId);

            $.get(url, function (response) {

                if (response.success) {
                    response.data.forEach(estado => {
                        $estado.append(new Option(estado.name, estado.id));
                    });
                }

                $estado.trigger('change'); // refresca Select2
            });
        });
        
        // 2. Cuando cambia el ESTADO → cargar CIUDADES
        $('#estado_id').on('change', function () {
            const estadoId = $(this).val();
            const $ciudad = $('#ciudad_id');

            if (!estadoId) return;
            const url = RUTA_CIUDADES.replace(':estadoId', estadoId);

            $.get(url, function (response) {

                if (response.success) {
                    response.data.forEach(ciudad => {
                        $ciudad.append(new Option(ciudad.name, ciudad.id));
                    });
                }

                $ciudad.trigger('change');
            });
        });
    });

</script>    

</body>

</html>