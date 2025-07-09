@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3 ">Lista de Colaboradores</h1>
</div>
<hr>

<div class="table-responsive row">
    <div class="col-md-12 mb-3 ">
        <a href="{{url('admin/secretarias/create')}}" class="btn btn-primary"><i class="fa-solid fa-id-card"></i> Registar Colaborador</a>
    </div>

    <table id="example1" border="1" class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th class="text-center">Número</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">C.C</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Fecha nacimiento</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Email</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach($secretarias as $secretaria)
            <tr>
                <td class="text-center">{{ $contador++}}</td>
                <td class="text-center">{{ $secretaria->nombres}}</td>
                <td class="text-center">{{ $secretaria->apellidos}}</td>
                <td class="text-center">{{ $secretaria->cc }}</td>
                <td class="text-center">{{ $secretaria->telefono}}</td>
                <td class="text-center">{{ $secretaria->fecha_nacimiento}}</td>
                <td class="text-center">{{ $secretaria->direccion}}</td>
                <td class="text-center">{{ $secretaria->user ->email}}</td>


                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="{{url('admin/secretarias/'.$secretaria->id)}}" type="button" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>

                        <a href="{{ url('admin/secretarias/'.$secretaria->id.'/edit') }}"
                            type="button" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>

                        <a href="{{ url('admin/secretarias/'.$secretaria->id.'/confirm-delete')}}"
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
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Secretarias",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Secretarias",
                    "infoFiltered": "(Filtrado de _MAX_ total Secretarias)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Secretarias",
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

</div>
@endsection