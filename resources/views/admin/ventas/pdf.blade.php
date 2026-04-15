<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10pt;
            color: #333;
        }

        .header, .info, .detalle, .footer {
            width: 100%;
            margin-bottom: 10px;
        }

        .header td {
            vertical-align: top;
        }

        .titulo {
            text-align: center;
            font-size: 18pt;
            font-weight: bold;
        }

        .subtitulo {
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
        }

        .box {
            border: 1px solid #999;
            padding: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #eaeaea;
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
        }

        .table td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }

        .total {
            font-size: 12pt;
            font-weight: bold;
            background: #f5f5f5;
        }

        .right {
            text-align: right;
        }

        .gracias {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }

        hr {
            border: 1px dashed #999;
            margin: 20px 0;
        }
    </style>
</head>

<body>

    {{-- ================= ORIGINAL ================= --}}
    <table class="header">
        <tr>
            <td width="30%">
                <img src="{{ public_path('storage/' . $empresa->logo) }}" width="90" alt="Logo">
            </td>

            <td width="40%" class="titulo">
                FACTURA
            </td>

            <td width="30%" class="right">
                <b>CUIT:</b> {{ $empresa->cuit }}<br>
                <b>N°:</b> {{ $venta->numero_venta }}<br>
                <span class="subtitulo">ORIGINAL</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>{{ $empresa->nombre }}</b><br>
                {{ $empresa->direccion }},
                {{ $empresa->departamento->name }},
                {{ $empresa->pais->name }}<br>
                Tel: {{ $empresa->telefono }}<br>
                {{ $empresa->email }}
            </td>
        </tr>
    </table>

    <div class="box info">
        <table width="100%">
            <tr>
                <td><b>Fecha:</b> {{ $venta->fecha_venta }}</td>
                <td class="right"><b>Cliente:</b> {{ optional($venta->cliente)->nombre ?? 'S/N' }}</td>
            </tr>
            <tr>
                <td><b>Sucursal:</b> {{ $venta->sucursal->nombre }}</td>
            </tr>
        </table>
    </div>

    <table class="table detalle">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>
                        {{ $venta->empresa->moneda->symbol }}
                        {{ number_format($detalle->producto->precio, 2, ',', '.') }}
                    </td>
                    <td>
                        {{ $venta->empresa->moneda->symbol }}
                        {{ number_format($detalle->cantidad * $detalle->producto->precio, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="3" class="right">TOTAL</td>
                <td>
                    {{ $venta->empresa->moneda->symbol }}
                    {{ number_format($venta->total_venta, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="gracias">
        Gracias por su compra
    </div>

    <hr>

    {{-- ================= DUPLICADO ================= --}}
    <table class="header">
        <tr>
            <td width="30%">
                <img src="{{ public_path('storage/' . $empresa->logo) }}" width="90" alt="Logo">
            </td>

            <td width="40%" class="titulo">
                FACTURA
            </td>

            <td width="30%" class="right">
                <b>CUIT:</b> {{ $empresa->cuit }}<br>
                <b>N°:</b> {{ $venta->numero_venta }}<br>
                <span class="subtitulo">DUPLICADO</span>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <b>{{ $empresa->nombre }}</b><br>
                {{ $empresa->direccion }},
                {{ $empresa->departamento->name }},
                {{ $empresa->pais->name }}<br>
                Tel: {{ $empresa->telefono }}<br>
                {{ $empresa->email }}
            </td>
        </tr>
    </table>

    <div class="box info">
        <table width="100%">
            <tr>
                <td><b>Fecha:</b> {{ $venta->fecha_venta }}</td>
                <td class="right"><b>Cliente:</b> {{ optional($venta->cliente)->nombre ?? 'S/N' }}</td>
            </tr>
            <tr>
                <td><b>Sucursal:</b> {{ $venta->sucursal->nombre }}</td>
            </tr>
        </table>
    </div>

    <table class="table detalle">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>
                        {{ $venta->empresa->moneda->symbol }}
                        {{ number_format($detalle->producto->precio, 2, ',', '.') }}
                    </td>
                    <td>
                        {{ $venta->empresa->moneda->symbol }}
                        {{ number_format($detalle->cantidad * $detalle->producto->precio, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="3" class="right">TOTAL</td>
                <td>
                    {{ $venta->empresa->moneda->symbol }}
                    {{ number_format($venta->total_venta, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="gracias">
        Gracias por su compra
    </div>

</body>
</html>