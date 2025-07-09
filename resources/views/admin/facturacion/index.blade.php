@extends('layouts.admin')
@section('content')

<div class="row">
    <h1 class="mt-3 ">Facturación</h1>
</div>
<hr>

<div class="table-responsive row">
    <div class="col-md-12 mb-3">
        <a href="{{url('admin/facturacion/create')}}" class="btn btn-success"><i class="fa-solid fa-dollar-sign"></i> Registrar Pago</a>
    </div>

    <table id="example1" border="1" class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre Paciente</th>
                <th class="text-center">Fecha de emisión</th>
                <th class="text-center">Fecha de Pago</th>
                <!-- <th class="text-center">Subtotal</th> -->
                <th class="text-center">Total a pagar</th>
                <th class="text-center">Método de pago</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach($facturas as $factura)
            <tr>
                <td class="text-center"> {{$contador++}} </td>
                <td class="text-center">{{ $factura->paciente->nombres }} {{ $factura->paciente->apellidos }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($factura->fecha_pago)->format('d/m/Y') }}</td>
                <!-- <td class="text-center">{{ number_format($factura->subtotal, 3) }}</td> -->
                <td class="text-center">{{ number_format($factura->monto ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $factura->metodo_pago }}</td>
                <td class="text-center">
                    @if($factura->estado == 'pagado')
                    <span class="badge bg-success">Pagado</span>
                    @elseif($factura->estado == 'pendiente')
                    <span class="badge bg-warning text-dark">Pendiente</span>
                    @else
                    <span class="badge bg-danger">Anulado</span>
                    @endif
                </td>
                <td class="text-center">{!! $factura->descripcion !!}</td>

                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="{{url('admin/facturacion/'.$factura->id)}}" type="button" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>

                        <a href="{{ url('admin/facturacion/'.$factura->id.'/edit') }}"
                            type="button" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i>
                        </a>

                        <a href="{{ url('admin/facturacion/pdf/'.$factura->id.'') }}"
                            type="button" target="_blank"
                            rel="noopener noreferrer" class="btn btn-primary btn-sm"><i class="fa-solid fa-print"></i>
                        </a>


                        <a href="{{ url('admin/facturacion/'.$factura->id.'/confirm-delete')}}"
                            type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 10,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando_START_ a _END_ de _TOTAL_ reservas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                    "infoFiltered": "(Filtrado de _MAX_ total reservas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ reservas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-info btn-sm btn-block',
                        text: '<i class="fa-solid fa-folder-open"></i> Reportes',
                        orientation: 'landscape',
                        buttons: [{
                            text: '<button class="btn btn-secondary btn-sm btn-block "><i class="fa-solid fa-copy"></i> Copy</button>',
                            extend: 'copy',
                        }, {
                            text: '<button class="btn btn-danger btn-sm btn-block "><i class="fa-solid fa-file-pdf"></i> PDF</button>',
                            extend: 'pdf'
                        }, {
                            text: '<button class="btn btn-info btn-sm btn-block "><i class="fa-solid fa-file-csv"></i> CSV</button>',
                            extend: 'csv'
                        }, {
                            text: '<button class="btn btn-success btn-sm btn-block "><i class="fa-solid fa-file-excel"></i> Excel</button>',
                            extend: 'excel'
                        }, {
                            text: '<button class="btn btn-warning btn-sm btn-block "><i class="fa-solid fa-print"></i> Imprimir</button>',
                            extend: 'print'
                        }]
                    },
                    {
                        extend: 'colvis',
                        className: 'btn btn-info btn-sm btn-block',
                        text: '<i class="fa-solid fa-table-columns"></i> Visor de columnas',
                        collectionLayout: 'fixed three-column'
                    }
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formulario');
        const inputs = document.querySelectorAll('.cop-format');

        // función de formateo: toma sólo dígitos y mete puntos cada 3
        const formatMiles = str => {
            const digits = str.replace(/\D/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // 1) formatea el valor que ya vino en el input
        inputs.forEach(input => {
            input.value = formatMiles(input.value);
        });

        // 2) formatea mientras escribes y mantiene el cursor al final
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                input.value = formatMiles(input.value);
                input.setSelectionRange(input.value.length, input.value.length);
            });
        });

        // 3) antes de enviar, quita TODO lo que no sea dígito
        form.addEventListener('submit', () => {
            inputs.forEach(input => {
                input.value = input.value.replace(/\D/g, '');
            });
        });
    });
</script>
@endsection