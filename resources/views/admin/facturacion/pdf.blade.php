<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura {{ $factura->numero_recibo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 60px;
        }

        .company-info {
            margin-bottom: 30px;
        }

        .client-info,
        .invoice-info {
            width: 48%;
            display: inline-block;
            vertical-align: top;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .details-table th {
            background-color: #f2f2f2;
        }

        .totals {
            margin-top: 10px;
            width: 100%;
        }

        .totals td {
            padding: 5px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Recibo de Caja</h1>
    <div>
        <img src="data:image/png;base64,{{$qrCodeBase64}}" alt="Codigo QR" style="width: 80px; height: 80px; position: absolute; top: 20px; right: 20px;" />
    </div>
    <div class="header">
        @if($config->logo_url)
        <img src="{{ public_path($config->logo_url) }}" class="logo" alt="Logo">
        @endif
        <h2>{{ $config->nombre_empresa }}</h2>
        <p>{{ $config->direccion }} | {{ $config->telefono }} | {{ $config->email }}</p>
    </div>

    <div class="company-info">
        <div class="client-info">
            <p><b>Ciudad:</b> Cali</p>

            <p><b>Historia Clínica:</b> {{ $factura->paciente->numero_historia }}</p>
            <p><b>Documento:</b> {{ $factura->paciente->di }}</p>
        </div>
        <div class="invoice-info">
            <h4>Factura # {{ $factura->numero_recibo }}</h4>
            <p><b>Fecha de pago:</b> {{ \Carbon\Carbon::parse($factura->fecha_pago)->format('d/m/Y') }}</p>
        </div>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th style="text-align: left;">Recibí de:</th>
                <th style="text-align: left;">La suma de:</th>
                <th style="text-align: left;">Por concepto de:</th>
                <th style="text-align: left;">Metodo de pago:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">{{ $factura->paciente->nombres}} {{ $factura->paciente->apellidos}}</td>
                <td style="text-align: center;">{{ number_format($factura->monto, 3) }}</td>
                <td style="text-align: center;">{!! $factura->descripcion !!}</td>
                <td style="text-align: center;">{{ ($factura->metodo_pago) }}</td>

            </tr>

        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td style="text-align: right; width: 80%;"><strong>Total:</strong></td>
            <td style="text-align: right;"><strong>{{ number_format($factura->monto, 3) }}</strong></td>
        </tr>
    </table>

    <br><br><br><br>
    <table>
        <tr>
            <td width="210px" style="text-align: center; font-size: 10px;">
                <p>
                    _______________________________<br>
                    Firma Paciente o Responsable
                </p>
            </td>

            <td width="210px"></td>

            <td width="210px" style="text-align: center; font-size: 10px;">
                <p>
                    _______________________________<br>
                    Firma Ortodoncista
                </p>
            </td>

        </tr>
    </table>


    <div style="text-align: center; font-size: 7pt;">
        <p>Este recibo es válido como comprobante de pago.</p>
        <p>Fecha de emisión: {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</p>
    </div>
    <!-- *************************** -->
    <hr>
    <!-- *************************** -->
    <h1 style="text-align: center;">Recibo de Caja</h1>
    <div>
        <img src="data:image/png;base64,{{$qrCodeBase64}}" alt="Codigo QR" style="width: 80px; height: 80px; position: absolute; top: 20px; right: 20px;" />
    </div>
    <div class="header">
        @if($config->logo_url)
        <img src="{{ public_path($config->logo_url) }}" class="logo" alt="Logo">
        @endif
        <h2>{{ $config->nombre_empresa }}</h2>
        <p>{{ $config->direccion }} | {{ $config->telefono }} | {{ $config->email }}</p>
    </div>

    <div class="company-info">
        <div class="client-info">
            <p><b>Ciudad:</b> Cali</p>

            <p><b>Historia Clínica:</b> {{ $factura->paciente->numero_historia }}</p>
            <p><b>Documento:</b> {{ $factura->paciente->di }}</p>
        </div>
        <div class="invoice-info">
            <h4>Factura # {{ $factura->numero_recibo }}</h4>
            <p><b>Fecha de pago:</b> {{ \Carbon\Carbon::parse($factura->fecha_pago)->format('d/m/Y') }}</p>
        </div>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th style="text-align: left;">Recibí de:</th>
                <th style="text-align: left;">La suma de:</th>
                <th style="text-align: left;">Por concepto de:</th>
                <th style="text-align: left;">Metodo de pago:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">{{ $factura->paciente->nombres}} {{ $factura->paciente->apellidos}}</td>
                <td style="text-align: center;">{{ number_format($factura->monto, 3) }}</td>
                <td style="text-align: center;">{!! $factura->descripcion !!}</td>
                <td style="text-align: center;">{{ ($factura->metodo_pago) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td style="text-align: right; width: 80%;"><strong>Total:</strong></td>
            <td style="text-align: right;"><strong>{{ number_format($factura->monto, 3) }}</strong></td>
        </tr>
    </table>

    <br><br><br>

    <table>
        <tr>
            <td width="210px" style="text-align: center; font-size: 10px;">
                <p>
                    _______________________________<br>
                    Firma Paciente o Responsable
                </p>
            </td>

            <td width="210px"></td>

            <td width="210px" style="text-align: center; font-size: 10px;">
                <p>
                    _______________________________<br>
                    Firma Ortodoncista
                </p>
            </td>

        </tr>
    </table>
    <div style="text-align: center; font-size: 7pt;">
        <p>Este recibo es válido como comprobante de pago.</p>
        <p>Fecha de emisión: {{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</p>
    </div>
</body>

</html>