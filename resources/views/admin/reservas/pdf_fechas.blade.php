<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Reservas</title>
    <style>
        /* --- Fuentes y Estilos Base --- */
        @font-face {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            /* Asegúrate de que esta ruta sea correcta para tu generador de PDF (ej. DomPDF) */
            src: url("{{ public_path('fonts/Nunito-VariableFont_wght.ttf') }}");
        }

        body {
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        /* --- Estructura del Encabezado --- */
        .report-header {
            width: 100%;
            border-bottom: 2px solid #3498db;
            /* Línea azul para separar */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .company-info {
            width: 70%;
            vertical-align: top;
            text-align: left;
        }

        .company-info h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 16px;
        }

        .company-info p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }

        .logo-container {
            width: 30%;
            text-align: right;
            vertical-align: top;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            /* Mantenemos el logo circular */
        }

        /* --- Información del Reporte --- */
        .report-title {
            text-align: center;
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .report-dates {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        /* --- Estilos de la Tabla de Datos (Reutilizados y Mejorados) --- */
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th {
            background-color: #3498db;
            color: #ffffff;
            padding: 12px 15px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #3498db;
        }

        .report-table td {
            padding: 10px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #f2f9ff;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <table class="report-header">
        <tr>
            <td class="company-info">
                <h3>{{ $configuracion->nombre }}</h3>
                <p>{{ $configuracion->direccion }}</p>
                <p>Tel: {{ $configuracion->telefono }}</p>
                <p>Email: {{ $configuracion->email }}</p>
            </td>
            <td class="logo-container">
                <img src="{{ url('storage/'.$configuracion->logo) }}" alt="Logotipo" class="logo">
            </td>
        </tr>
    </table>

    <h2 class="report-title">Listado de Reservas</h2>
    <p class="report-dates">Reporte generado desde: {{ $fecha_inicio }} hasta: {{ $fecha_fin }}</p>

    <table class="report-table">
        <thead>
            <tr>
                <th class="text-center">Nro</th>
                <th>Doctor</th>
                <th>Especialidad</th>
                <th class="text-center">Fecha reserva</th>
                <th class="text-center">Hora reserva</th>
            </tr>
        </thead>
        <tbody>
            @php $contador = 1; @endphp
            @foreach ($eventos as $evento)
            <tr>
                <td class="text-center">{{ $contador++ }}</td>
                <td>{{ $evento->doctor->nombres }} {{ $evento->doctor->apellidos }}</td>
                <td>{{ $evento->doctor->especialidad }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>