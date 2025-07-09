@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Registrar Horario</h1>
</div>
<hr>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body row">
                <div class="col-md-12">
                    <form action="{{ url('admin/horarios/create') }}" method="POST" id="formulario">
                        @csrf
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="consultorio_id">Consultorios Disponibles</label>
                                <select class="form-control" name="consultorio_id" id="consultorio_select" required>
                                    <option value="">Seleccione Consultorio...</option>
                                    @foreach($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}" {{ old('consultorio_id') == $consultorio->id ? 'selected' : '' }}>
                                        {{ $consultorio->nombre }} - {{ $consultorio->direccion }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('consultorio_id') <span class="text-danger">{{ $message }}</span> @enderror

                                <script>
                                    $('#consultorio_select').on('change', function() {
                                        var consultorioId = $('#consultorio_select').val();
                                        var url = "{{ route('admin.horarios.cargar_datos_consultorio', ':id') }}";
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
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="doctor_id">Doctores Disponibles <b>*</b></label>
                                <select class="form-control" name="doctor_id" id="doctor_id" required>
                                    <option value="">Seleccione Doctor...</option>
                                    @foreach($doctores as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>


                            <div class="col-md-12 mb-3">
                                <label for="dia">Día de la semana <b>*</b></label>
                                <select class="form-control" name="dia" id="dia" required>
                                    <option value="">Seleccione...</option>
                                    @foreach(['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $day)
                                    <option value="{{ $day }}" {{ old('dia') == $day ? 'selected' : '' }}>{{ ucfirst($day) }}</option>
                                    @endforeach
                                </select>
                                @error('dia') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="hora_inicio">Hora de inicio <b>*</b></label>
                                <input type="time" class="form-control" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" required>
                                @error('hora_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="hora_fin">Hora finalización <b>*</b></label>
                                <input type="time" class="form-control" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}" required>
                                @error('hora_fin') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>


                        <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                            <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-calendar-plus"></i> Agregar Horario</button>
                        </div>

                    </form>
                </div>

                <!-- CALENDARIO -->
                <div class="row m-4 col-md-12 ">
                    <div id="consultorio_info">
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection