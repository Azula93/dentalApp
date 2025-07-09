<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Control {{ $control->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        /* tu @font-face ... */
        body,
        table,
        h1,
        h2,
        p {
            font-family: "Nunito", sans-serif;
            font-size: 12pt;
        }

        .section {
            margin-bottom: 1rem;
        }

        .section h4 {
            margin-bottom: .5rem;
        }
    </style>
</head>

<body>
    {{-- Encabezado --}}
    <table width="100%">
        <tr>
            <td>
                <strong>{{ $configuracion->nombre }}</strong><br>
                {{ $configuracion->direccion }}<br>
                Tel: {{ $configuracion->telefono }} — {{ $configuracion->email }}
            </td>
            <td align="right">
                <img src="{{ public_path('storage/'.$configuracion->logo) }}"
                    width="80" height="80" style="border-radius:50%;">
            </td>
        </tr>
    </table>

    <h2 class="text-center"><u>Control #{{ $control->id }}</u></h2>

    {{-- Sección de datos presentada en tabla --}}
    <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse; font-size: 12pt;">
        {{-- Encabezado: Datos del Paciente --}}
        <tr style="background-color: #f2f2f2;">
            <th colspan="2" style="text-align: center; border: 1px solid #ccc; ">Datos del Paciente</th>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; width: 30%;"><strong>Nombre completo</strong></td>
            <td style="border: 1px solid #ccc;">
                {{ $control->paciente->apellidos }} {{ $control->paciente->nombres }}
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Documento Identidad</strong></td>
            <td style="border: 1px solid #ccc;">{{ $control->paciente->di }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Fecha nacimiento</strong></td>
            <td style="border: 1px solid #ccc;">
                {{ \Carbon\Carbon::parse($control->paciente->fecha_nacimiento)->format('d/m/Y') }}
            </td>
        </tr>

        {{-- Encabezado: Datos del Doctor --}}
        <tr style="background-color: #f2f2f2;">
            <th colspan="2" style="text-align: center; border: 1px solid #ccc;">Datos del Doctor</th>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Nombre completo</strong></td>
            <td style="border: 1px solid #ccc;">
                {{ $control->doctor->nombres }} {{ $control->doctor->apellidos }}
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Especialidad</strong></td>
            <td style="border: 1px solid #ccc;">{{ $control->doctor->especialidad }}</td>
        </tr>

        {{-- Encabezado: Registro de Control --}}
        <tr style="background-color: #f2f2f2;">
            <th colspan="2" style="text-align: center; border: 1px solid #ccc;">Registro de Control</th>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc;"><strong>Fecha de consulta</strong></td>
            <td style="border: 1px solid #ccc;">
                {{ \Carbon\Carbon::parse($control->fecha_consulta)->format('d/m/Y') }}
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; vertical-align: top;"><strong>Detalle del control</strong></td>
            <td style="border: 1px solid #ccc;">
                {!! ($control->detalle) !!}
            </td>
        </tr>
    </table>





</body>

</html>