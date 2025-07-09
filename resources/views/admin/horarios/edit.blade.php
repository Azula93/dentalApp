@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Editar datos</h1>
</div>
<hr>

<div class="container-fluid">
    <div class="col-md-12">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Actualizar Datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/horarios', $horario->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_id">Doctores Disponibles</label> <b>*</b>
                                <select class="form-control" name="doctor_id" id="doctor_id" required>
                                    @foreach($doctores as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nombres}} {{ $doctor->apellidos}}
                                        - {{ $doctor->especialidad}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="consultorio_id">Consultorios Disponibles</label> <b>*</b>
                                <select class="form-control" name="consultorio_id" id="consultorio_id" required>
                                    @foreach($consultorios as $consultorio)
                                    <option value="{{ $consultorio->id }}">{{ $consultorio->nombre}} - {{ $consultorio->direccion}}</option>
                                    @endforeach
                                </select>
                                @error('consultorio_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hora inicio</label> <b>*</b>
                                <input type="time" value="{{ old('hora_inicio', \Illuminate\Support\Str::substr($horario->hora_inicio,0,5)) }}"
                                    step="60" class="form-control" name="hora_inicio" id="hora_inicio" placeholder="Hora Inicio" required>
                                @error('hora_inicio')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hora fin</label> <b>*</b>
                                <input type="time" value="{{ old('hora_fin', \Illuminate\Support\Str::substr($horario->hora_fin,0,5)) }}"
                                    step="60" class="form-control" name="hora_fin" id="hora_fin" placeholder="Hora fin" required>
                                @error('hora_fin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/horarios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-repeat"></i> Actualizar datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection