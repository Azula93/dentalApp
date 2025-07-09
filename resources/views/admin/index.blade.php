@extends('layouts.admin')
@section('content')
<div class="row ">
  <h1 class="mt-3"> <b>Bienvenido:</b> {{Auth::user()->name}} </h1>
</div>
<hr>
<div class="row">
  <!-- @ can : restringe el acceso dependiendo de los roles asignados -->
  @can('admin.usuarios.index')
  <!-- usuarios -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box  " style="background-color: rgb(111, 66, 193);">
      <div class="inner">
        <h3> {{$totalUsers}} </h3>
        <p>Usuarios</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-users"></i>
      </div>
      <a href="{{url('admin/usuarios')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /usuarios -->
  @endcan

  @can('admin.secretarias.index')
  <!-- secretarias -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3> {{$totalsecretarias}} </h3>
        <p>Auxiliar Administrativo</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-user-nurse"></i>
      </div>
      <a href="{{url('admin/secretarias')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /secretarias -->
  @endcan

  @can('admin.pacientes.index')
  <!-- PACIENTES -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3> {{$totalpacientes}} </h3>
        <p>Pacientes</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-hospital-user"></i>
      </div>
      <a href="{{url('admin/pacientes')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /PACIENTES -->
  @endcan

  @can('admin.consultorios.index')
  <!-- Consultorios -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3> {{$totalconsultorios}} </h3>
        <p>Consultorios</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-house-medical"></i>
      </div>
      <a href="{{url('admin/consultorios')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /Consultorios -->
  @endcan

  @can('admin.doctores.index')
  <!-- doctores -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3> {{$totaldoctores}} </h3>
        <p>Doctores</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-user-doctor"></i>
      </div>
      <a href="{{url('admin/doctores')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
  <!-- /doctores -->

  @can('admin.horarios.index')
  <!-- horarios -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3> {{$totalhorarios}} </h3>
        <p>Horarios</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-calendar-days"></i>
      </div>
      <a href="{{url('admin/horarios')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /horarios -->
  @endcan

  <!-- reservas -->
  <div class="col-lg-3 col-6">
    <div class="small-box" style=" background-color: rgb(232, 62, 140)" ;>
      <div class=" inner">
        <h3> {{$totalEventos}} </h3>
        <p>Reservas</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-handshake-angle"></i>
      </div>
      <a href="{{url('admin/eventos')}} " class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /reservas -->
</div>

@can('cargar_datos_consultorio')
<!-- VISTA DE LOS HORARIOS PARA EL USUARIO CUANDO ESTA REGISTRADO -->
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
<!-- /VISTA DE LOS HORARIOS PARA EL USUARIO CUANDO ESTA REGISTRADO -->

<div class="row">
  <div class="col-md-12">
    <div class="card card-outline card-warning">
      <div class="card-header">
        <h3 class="card-title">Calendario de reserva de citas</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="doctor_id">Ver calendario de Doctores</label>
            <select class="form-control" name="doctor_id" id="doctor_select" required>
              {{-- Opción placeholder --}}
              <option value=""
                disabled
                {{ old('doctor_id') ? '' : 'selected' }}>
                Seleccione un doctor
              </option>
              @foreach($doctores as $doctor)
              <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->nombres }} - {{ $doctor->apellidos }} - {{ $doctor->especialidad }}
              </option>
              @endforeach
            </select>
            <script>
              $('#doctor_select').on('change', function() {
                var doctorId = $('#doctor_select').val();

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                  initialView: 'dayGridMonth',
                  locale: 'es',
                  events: []
                });

                if (doctorId) {
                  $.ajax({
                    url: "{{ url('/cargar_reserva_doctores/') }}" + '/' + doctorId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                      calendar.addEventSource(data);
                    },
                    error: function() {
                      alert('Error al cargar los horarios del consultorio seleccionado.');
                    }
                  })
                } else {
                  $('#doctor_info').html('');
                }
                calendar.render();
              });
            </script>
            @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
        </div>

        <!-- MODAL RESERVAR CITAS -->
        <div class="row">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary m-2 btn-lg" data-toggle="modal" data-target="#staticBackdrop">
            <i class="fa-solid fa-calendar-day"></i> Reservar Cita
          </button>

          <a href="{{url('/admin/ver_reservas',Auth::user()->id)}}" class="btn btn-success m-2 btn-lg"><i class="fa-solid fa-calendar-check"></i> Ver la cita reservada</a>

          <!-- Modal -->
          <form action="{{url('/admin/eventos/create')}}" method="POST">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reserva tu cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <!-- NOMBRE DOCTOR -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Doctor</label>
                          <select name="doctor_id" id="doctor_id" class="form-control">
                            @foreach($doctores as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->nombres. " ". $doctor->apellidos }} - {{ $doctor->especialidad }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <!-- fecha -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Fecha Cita</label>
                          <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="fecha_reserva" name="fecha_reserva" required>
                          @push('scripts')
                          <script>
                            document.addEventListener('DOMContentLoaded', function() {
                              const fechaReservaInput = document.getElementById('fecha_reserva');

                              //Escuchar el evento de cambio en el campo de fecha reserva
                              fechaReservaInput.addEventListener('change', function() {
                                let selectedDate = this.value; //Obtener la Fecha seleccionada
                                //Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                let today = new Date().toISOString().slice(0, 10);
                                //Verificar si la fecha seleccionada es anterior a la fecha actual
                                if (selectedDate < today) {
                                  //Si es así, establecer la fecha seleccionada en null
                                  this.value = null;
                                  Swal.fire({
                                    icon: 'warning',
                                    title: 'Fecha inválida',
                                    text: 'Por favor ingrese una fecha igual o posterior a la fecha actual.',
                                    confirmButtonText: 'Entendido'
                                  });

                                }
                              });
                            });
                          </script>
                          @endpush
                        </div>
                      </div>

                      <!-- HORA -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="hora_reserva">Hora Cita</label>
                          <input type="time" class="form-control" id="hora_reserva" name="hora_reserva" required>
                          @error('hora_reserva')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          @if ((($message = Session::get('hora_reserva'))))
                          <script>
                            document.addEventListener('DOMContentLoaded', function() {
                              $('#staticBackdrop').modal('show');

                            });
                          </script>
                          <span class="text-danger">{{ $message }}</span>
                          @endif

                        </div>
                      </div>

                      @push('scripts')
                      <script>
                        document.addEventListener('DOMContentLoaded', function() {
                          const horaReservaInput = document.getElementById('hora_reserva');

                          horaReservaInput.addEventListener('change', function() {
                            let selectedTime = this.value;
                            if (selectedTime) {
                              // Asegurarse de que los minutos queden en ":00"
                              selectedTime = selectedTime.split(':');
                              selectedTime = selectedTime[0] + ':00';
                              this.value = selectedTime;
                            }

                            // Verificar que esté dentro del rango 08:00 - 18:00
                            if (selectedTime < '08:00' || selectedTime > '18:00') {
                              this.value = null;

                              // Mostrar SweetAlert en lugar de alert nativo
                              Swal.fire({
                                icon: 'warning',
                                title: 'Horario inválido',
                                text: 'Por favor ingrese un horario entre las 08:00 de la mañana y 18:00 de la tarde',
                                confirmButtonText: 'Entendido'
                              });
                            }
                          });
                        });
                      </script>
                      @endpush


                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Reservar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- modal -->

        <!-- LLAMADA A FULL CALENDAR -->
        <div id='calendar'></div>
      </div>
    </div>
  </div>
</div>
@endcan

@if(Auth::check() && Auth::user()->doctor)
<!-- dashboard doctores -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h3 class="card-title">Calendario de reservas</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="consultorio_id">Mis citas agendadas</label>
            <table id="example1" border="1" class="table table-striped table-bordered table-sm">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Nombre Paciente</th>
                  <th class="text-center">Fecha reserva</th>
                  <th class="text-center">Hora reserva</th>
                </tr>
              </thead>
              <tbody>
                <?php $contador = 1; ?>
                @foreach($eventos as $evento)
                @if(Auth::user()->doctor->id == $evento->doctor_id)
                <tr>
                  <td class="text-center">{{ $contador++}}</td>
                  <td class="text-center">{{ $evento->user -> name}}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="{{url('/#')}}" class="btn btn-secondary">Regresar</a>
                </div>
              </div>
            </div>

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
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection