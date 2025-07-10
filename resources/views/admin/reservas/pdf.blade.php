<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="{{ asset('css/bootstrap.min.css') }}">

    <!-- <style>
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
    </style> -->

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
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-a">
        <title>Listado de Reservas</title>
        <style>
            /* Estilos generales para el cuerpo del documento */
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                color: #333;
            }

            /* Estilo para el título principal */
            .report-title {
                text-align: center;
                color: #2c3e50;
                font-size: 18px;
                padding-bottom: 10px;
                border-bottom: 2px solid #3498db;
                margin-bottom: 20px;
                /* Reemplaza al <br> */
            }

            /* Estilos principales para la tabla */
            .report-table {
                width: 100%;
                /* Ocupa todo el espacio disponible */
                border-collapse: collapse;
                /* Une los bordes de las celdas */
                margin-bottom: 20px;
            }

            /* Estilos para las celdas del encabezado (th) */
            .report-table th {
                background-color: #3498db;
                /* Un azul profesional */
                color: #ffffff;
                /* Texto blanco */
                padding: 12px 15px;
                /* Espaciado interno (vertical y horizontal) */
                text-align: left;
                /* Alineación a la izquierda para mejor lectura */
                font-weight: bold;
                border: 1px solid #3498db;
            }

            /* Estilos para las celdas de datos (td) */
            .report-table td {
                padding: 10px 15px;
                border: 1px solid #ddd;
                /* Borde sutil para cada celda */
                text-align: left;
            }

            /* Estilos para las filas pares (efecto cebra) */
            .report-table tbody tr:nth-child(even) {
                background-color: #f2f9ff;
                /* Un color de fondo muy suave para filas pares */
            }

            /* Clase de utilidad para centrar texto donde sea necesario */
            .text-center {
                text-align: center;
            }
        </style>
    </head>

    <body>

        <h2 class="report-title">Listado de reservas</h2>

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
                <?php $contador = 1; ?>
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
</body>

</html>