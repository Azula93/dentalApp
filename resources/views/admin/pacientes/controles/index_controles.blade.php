@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="mt-3">Todos los controles de pacientes</h1>
    </div>
    <hr>

    <div class="table-responsive">
        <div class="mb-3">
            <a href="{{ url('/admin/pacientes/controles/create') }}" class="btn btn-primary">
                Crear control
            </a>
        </div>

        <table id="example1" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Paciente</th>
                    <th class="text-center">Fecha Consulta</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($controles as $control)
                @if(! auth()->user()->doctor || $control->doctor_id == auth()->user()->doctor->id)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        {{ $control->paciente->apellidos }} {{ $control->paciente->nombres }}
                    </td>
                    <td class="text-center">{{ $control->fecha_consulta }}</td>
                    <td class="text-center">
                        {!! Str::limit(
                        strip_tags($control->detalle),
                        100,
                        ' <a href="' .
                route('admin.pacientes.controles.show_controles', $control) .
                '">...ver más</a>'
                        ) !!}

                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.pacientes.controles.show_controles', $control) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pacientes.controles.edit_controles', $control) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/pacientes/controles/pdf_controles', $control->id) }}" class="btn btn-success btn-sm"
                                target="_blank"
                                rel="noopener noreferrer">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            <a
                                href="{{ route('admin.pacientes.controles.confirm-delete_controles', $control->id) }}"
                                class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando_START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [{
                    extend: 'collection',
                    text: 'Reportes',
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
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush