@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3 ">Cita reservadas</h1>
</div>
<hr>

<div class="table-responsive row">
    <table id="example1" border="1" class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Doctor</th>
                <th class="text-center">Especialidad</th>
                <th class="text-center">Fecha reserva</th>
                <th class="text-center">Hora reserva</th>
                <th class="text-center">Consultorio</th>
                <th class="text-center">Fecha y hora del registro</th>
                <th class="text-center">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php $contador = 1; ?>
            @foreach($eventos as $evento)
            <tr>
                <td class="text-center">{{ $contador++}}</td>
                <td class="text-center">{{ $evento->doctor->nombres. " ".$evento->doctor->apellidos }}</td>
                <td class="text-center">{{ $evento->doctor->especialidad}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>
                <td class="text-center">{{ $evento->consultorio->nombre}}</td>
                <td class="text-center">{{ $evento->created_at}}</td>

                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <form
                            action="{{ url('/admin/eventos/destroy', $evento->id) }}"
                            method="POST"
                            id="formulario{{ $evento->id }}"
                            onsubmit="return preguntar(event, {{ $evento->id }});">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>



                        <script>
                            function preguntar(event, id) {
                                // Evitamos que el formulario se envíe inmediatamente
                                event.preventDefault();

                                Swal.fire({
                                    title: "Estas seguro de elminar tu reserva?",
                                    text: "No podrás revertir esto!",
                                    icon: "warning",
                                    showDenyButton: false,
                                    showCancelButton: true,
                                    confirmButtonText: "Sí, eliminar",
                                    cancelButtonText: 'Cancelar',
                                }).then((result) => {

                                    if (result.isConfirmed) {
                                        document.getElementById('formulario' + id).submit();
                                    }
                                });
                            }
                        </script>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{url('/admin')}}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#example1").DataTable({
                "pageLength": 10,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ reservas",
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
                        text: 'Reportes',
                        orientation: 'landscape',
                        buttons: [{
                            text: 'Copiar',
                            extend: 'copy',
                        }, {
                            extend: 'pdf'
                        }, {
                            extend: 'csv'
                        }, {
                            extend: 'excel'
                        }, {
                            text: 'Imprimir',
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