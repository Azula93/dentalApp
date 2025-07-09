<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        @font-face {
            font-family: "Nunito", sans-serif;
            font-style: normal;
            font-weight: 400;
            src: url("{{ public_path('fonts/Nunito-VariableFont_wght') }}") format('truetype');
        }


        /* Aplica la fuente a todo el PDF */
        body,
        table,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: "Nunito", sans-serif;
        }
    </style>

    <title>Reporte PDF</title>
</head>

<body>
    <table style="font-size: 8pt;">
        <tr>
            <td class="text-center">
                {{ $configuracion->nombre}}
                {{ $configuracion->direccion}}
                {{ $configuracion->telefono}}
                {{ $configuracion->email}}
            </td>
            <td width="400px"></td>
            <td>
                <img src="{{ url('storage/'.$configuracion->logo)}} " alt="logotipo" width="80px" height="80px"
                    style="border-radius: 50%;">
            </td>
        </tr>
    </table>
    <br>
    <h2 style="text-align: center;"><u>Listado de reservas</u></h2>
    <br>
    <p>Reporte generado desde: {{ $fecha_inicio }} hasta: {{ $fecha_fin }}</p>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr style="background-color: #e7e7e7;">
                <th style="text-align: center;">Nro</th>
                <th style="text-align: center;">Doctor</th>
                <th style="text-align: center;">Especialidad</th>
                <th style="text-align: center;">Fecha reserva</th>
                <th style="text-align: center;">Hora reserva</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach ($eventos as $evento)
            <tr>
                <td style="text-align: center;">{{ $contador ++ }}</td>
                <td style="text-align: center;">{{ $evento->doctor->nombres }} {{ $evento->doctor->apellidos }}</td>
                <td style="text-align: center;">{{ $evento->doctor->especialidad }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($evento->start)->format('H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>