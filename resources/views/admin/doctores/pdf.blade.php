<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <<link rel="stylesheet"
        href="{{ asset('css/bootstrap.min.css') }}">
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
    <h2 style="text-align: center;"><u>Listado del personal medico</u></h2>
    <br>
    <table class="table table-bordered table-striped table-sm">
        <thead
            <style>
            @font-face {
            font-family: "Nunito", sans-serif;
            font-style: normal;
            font-weight: 400;
            src: url("{{ public_path('fonts/Nunito-VariableFont_wght') }}") format('truetype');
            }


            /* Aplica la fuente a todo el PDF */
            body, table, h1, h2, h3, h4, h5, h6, p {
            font-family: "Nunito", sans-serif;
            }
            </style>
            >
            <tr style="background-color: #e7e7e7;">
                <th style="text-align: center;">Nro</th>
                <th style="text-align: center;">Nombre Completo</th>
                <th style="text-align: center;">Telefono</th>
                <th style="text-align: center;">Especialidad</th>
                <th style="text-align: center;">Dirección</th>
                <th style="text-align: center;">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach ($doctores as $doctor)
            <tr>
                <td style="text-align: center;">{{ $contador ++ }}</td>
                <td style="text-align: center;">{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                <td style="text-align: center;">{{ $doctor->telefono }}</td>
                <td style="text-align: center;">{{ $doctor->especialidad }}</td>
                <td style="text-align: center;">{{ $doctor->direccion }}</td>
                <td style="text-align: center;">{{ $doctor->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>