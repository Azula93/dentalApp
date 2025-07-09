@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3 ">Listado de Horarios</h1>
</div>
<hr>

<div class="row mb-3">
    <div class="col-12">
        <a href="{{ url('admin/horarios/create') }}" class="btn btn-primary"><i class="fa-solid fa-calendar-plus"></i> Registrar Horario</a>
    </div>
</div>

<div class="row">
    <!-- Tabla 1 (8 columnas) -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Horarios Registrados</h5>
                <div class="table-responsive">
                    <table id="example1" border="1" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Doctor</th>
                                <th class="text-center">Especialidad</th>
                                <th class="text-center">Días de atención</th>
                                <th class="text-center">Hora de inicio</th>
                                <th class="text-center">Hora de finalización</th>
                                <th class="text-center">Consultorio</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach($horarios as $horario)
                            <tr>
                                <td class="text-center">{{ $contador++}}</td>
                                <td class="text-center">{{ $horario->doctor->nombres }} {{ $horario->doctor->apellidos }}</td>
                                <td class="text-center">{{ $horario->doctor->especialidad }}</td>
                                <td class="text-center">{{ $horario->dia }}</td>
                                <td class="text-center">{{ $horario->hora_inicio }}</td>
                                <td class="text-center">{{ $horario->hora_fin }}</td>
                                <td class="text-center">{{ $horario->consultorio->nombre }}</td>
                                <td class="text-center">{{ $horario->consultorio->direccion }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ url('admin/horarios/'.$horario->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ url('admin/horarios/'.$horario->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="{{ url('admin/horarios/'.$horario->id.'/confirm-delete') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Horarios de atención</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="consultorio_id">Horario de atención Consultorios</label>
                        <select class="form-control" name="consultorio_id" id="consultorio_select" required>
                            {{-- Opción placeholder --}}
                            <option value=""
                                disabled
                                {{ old('consultorio_id') ? '' : 'selected' }}>
                                Seleccione un consultorio
                            </option>

                            {{-- Consultorios traídos de la BD --}}
                            @foreach($consultorios as $consultorio)
                            <option value="{{ $consultorio->id }}"
                                {{ old('consultorio_id') == $consultorio->id ? 'selected' : '' }}>
                                {{ $consultorio->nombre }} – {{ $consultorio->direccion }}
                            </option>
                            @endforeach
                        </select>
                        @error('consultorio_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <script>
                    $('#consultorio_select').on('change', function() {
                        var consultorioId = $('#consultorio_select').val();
                        var url = "{{ route('cargar_datos_consultorio', ':id') }}";
                        url = url.replace(':id', consultorioId);
                        if (consultorioId) {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(data) {
                                    $('#consultorio_info').html(data);
                                },
                                error: function() {
                                    alert('Error al cargar los horarios del consultorio seleccionado.');
                                }
                            })
                        } else {
                            $('#consultorio_info').html('');
                        }
                    });
                </script>
                <div id="consultorio_info">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="consultorio_info">
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ horarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 horarios",
                "infoFiltered": "(Filtrado de _MAX_ total horarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ horarios",
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
@endsection