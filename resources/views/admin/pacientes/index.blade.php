@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3 ">Lista de Pacientes</h1>
</div>
<hr>

<div class="table-responsive row">
    @hasanyrole('admin|colaborador')
    <div class="col-md-12 mb-3">
        <a href="{{url('admin/pacientes/create')}}" class="btn btn-primary">Registar Paciente</a>
    </div>
    @endhasanyrole

    <table id="example1" border="1" class="table table-striped table-bordered table-lg">
        <thead>
            <tr>
                <th class="text-center">Número</th>
                <th class="text-center">Número historia</th>
                <th class="text-center">Nombre paciente</th>
                <th class="text-center"># Documento</th>
                <th class="text-center">Email</th>
                <!-- <th class="text-center">Télefono</th> -->
                <!-- <th class="text-center">Fecha nto</th> -->
                <th class="text-center">Sexo</th>
                <!-- <th class="text-center">EPS</th> -->
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach($pacientes as $paciente)
            <tr>
                <td class="text-center">{{ $contador++}}</td>
                <td class="text-center">{{ $paciente->numero_historia}}</td>
                <td class="text-center">{{ $paciente->nombres}} {{ $paciente->apellidos }}</td>
                <td class="text-center">{{ $paciente->di}}</td>
                <td class="text-center">{{ $paciente->email}}</td>
                <!-- <td class="text-center">{{ $paciente->celular}}</td> -->
                <!-- <td class="text-center">{{ $paciente->fecha_nacimiento}}</td> -->
                <td class="text-center">{{ $paciente->sexo}}</td>
                <!-- <td class="text-center">{{ $paciente->eps}}</td> -->

                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="{{url('admin/pacientes/'.$paciente->id)}}" type="button" class="btn btn-sm"
                            data-toggle="tooltip"
                            title="Ver datos Paciente"
                            data-placement="top"
                            style="background-color: #00BCD4; color: white;">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ url('admin/pacientes/'.$paciente->id.'/edit') }}"
                            type="button" class="btn  btn-sm"
                            data-toggle="tooltip"
                            title="Editar Paciente"
                            data-placement="top"
                            style="background-color:#FFC107">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>

                        <a href="{{ route('admin.pacientes.anamnesis.edit', $paciente) }}"
                            type="button" class="btn btn-sm" style="background-color: #FF5722;"
                            data-toggle="tooltip"
                            title="Anamnesis"
                            data-placement="top"><i class="fa-solid fa-a"></i></a>

                        <a
                            href="{{ route('admin.pacientes.antecedentes-medicos.edit', $paciente) }}"
                            class="btn btn-sm" style="background-color: #3F51B5;"
                            data-toggle="tooltip"
                            title="Antecedentes Médicos"
                            data-placement="top">
                            <i class="fa-solid fa-file-medical"></i>
                        </a>

                        <a
                            href="{{ route('admin.pacientes.odontograma.edit', $paciente) }}"
                            class="btn  btn-sm" style="background-color: #03A9F4;"
                            data-toggle="tooltip"
                            title="Odontograma"
                            data-placement="top">
                            <i class="fa-solid fa-tooth"></i>
                        </a>

                        <a
                            href="{{ route('admin.pacientes.valoracion.edit', $paciente) }}"
                            class="btn  btn-sm" style="background-color: #4CAF50;"
                            data-toggle="tooltip"
                            title="Valoración"
                            data-placement="top">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </a>

                        <a
                            href="{{ route('admin.pacientes.diagnostico-hc.update', $paciente) }}"
                            class="btn  btn-sm" style="background-color:	#E91E63;"
                            data-toggle="tooltip"
                            title="Diagnóstico HC"
                            data-placement="top">
                            <i class="fa-solid fa-stethoscope"></i>
                        </a>

                        <a
                            href="{{ route('admin.pacientes.examenendodontico.update', $paciente) }}"
                            class="btn  btn-sm" style="background-color:#009688;"
                            data-toggle="tooltip"
                            title="Examen Endodontico y Periodontal"
                            data-placement="bottom">
                            <i class="fa-solid fa-file-medical-alt"></i>
                        </a>

                        <a
                            href="{{ route('admin.pacientes.plan-tratamiento.edit', $paciente) }}"
                            class="btn  btn-sm" style="background-color:#9C27B0;"
                            data-toggle="tooltip"
                            title="Plan de Tratamiento"
                            data-placement="top">
                            <i class="fa-solid fa-file-medical"></i>
                        </a>

                        <a href="{{ url('admin/pacientes/'.$paciente->id.'/confirm-delete')}}"
                            type="button" class="btn btn-sm"
                            data-toggle="tooltip"
                            title="Eliminar Paciente"
                            data-placement="top"
                            style="background-color: #F44336;"><i class="fa-solid fa-trash-alt"></i>
                        </a>
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Pacientes",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Pacientes",
                    "infoFiltered": "(Filtrado de _MAX_ total Pacientes)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Pacientes",
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

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</div>
@endsection