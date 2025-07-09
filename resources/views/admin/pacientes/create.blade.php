@extends('layouts.admin')
@section('content')
<div class="container p-2">
    <h1 class="p-4 text-center">Registrar Paciente</h1>
    <p class="lead p-2">Complete el siguiente formulario para registrar un nuevo paciente.</p>

    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Formulario de Registro</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/pacientes/create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nombres" class="form-label">Nombres</label> <b>*</b>
                        <input type="text" id="nombres" name="nombres" class="form-control"
                            value="{{ old('nombres') }}">
                        @error('nombres')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label> <b>*</b>
                        <input type="text" id="apellidos" name="apellidos" class="form-control"
                            value="{{ old('apellidos') }}">
                        @error('apellidos')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="di" class="form-label">Documento de Identidad</label><b>*</b>
                        <input type="text" id="di" name="di" class="form-control"
                            value="{{ old('di') }}" maxlength="10">
                        @error('di')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" id="edad" name="edad" class="form-control"
                            value="{{ old('edad')}}" min="1" max="99" oninput="this.value = this.value.slice(0, 2)">
                        @error('edad')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label> <b>*</b>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                            value="{{ old('fecha_nacimiento') }}">
                        @error('fecha_nacimiento')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <select class="form-control" name="estado_civil" id="estado_civil">
                                <option value="">Seleccione...</option>
                                <option value="soltero">Soltero</option>
                                <option value="casado">Casado</option>
                                <option value="union libre">Unión libre</option>
                                <option value="divorciado">Divorciado</option>
                                <option value="viudo">Viudo</option>
                            </select>
                            @error('estado_civil')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sexo">Sexo</label> <b>*</b>
                            <select class="form-control" name="sexo" id="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="M" {{ old('sexo')=='M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo')=='F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('sexo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ocupacion" class="form-label">Ocupación</label>
                        <input type="text" id="ocupacion" name="ocupacion" class="form-control"
                            value="{{ old('ocupacion') }}">
                        @error('ocupacion')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="direccion_residencia" class="form-label">Dirección de Residencia</label>
                        <input type="text" id="direccion_residencia" name="direccion_residencia" class="form-control"
                            value="{{ old('direccion_residencia') }}">
                        @error('direccion_residencia')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="telefono_oficina" class="form-label">Teléfono Oficina</label>
                        <input type="text" id="telefono_oficina" name="telefono_oficina" class="form-control"
                            value="{{ old('telefono_oficina')}}" maxlength="10">
                        @error('telefono_oficina')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="celular" class="form-label">Celular</label><b>*</b>
                        <input type="text" id="celular" name="celular" class="form-control"
                            value="{{ old('celular') }}" maxlength="10">
                        @error('celular')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label> <b>*</b>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email')}}">
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="eps" class="form-label">EPS</label> <b>*</b>
                        <input type="text" id="eps" name="eps" class="form-control"
                            value="{{ old('eps') }}">
                        @error('eps')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="tipo_vinculacion" class="form-label">Tipo de Vinculación</label>
                        <input type="text" id="tipo_vinculacion" name="tipo_vinculacion" class="form-control"
                            value="{{ old('tipo_vinculacion') }}">
                        @error('tipo_vinculacion')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="servicio_urgencias" class="form-label">Servicio de Urgencias</label> <b>*</b>
                        <input type="text" id="servicio_urgencias" name="servicio_urgencias" class="form-control"
                            value="{{ old('servicio_urgencias') }}">
                        @error('servicio_urgencias')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                        <select class="form-control" name="tipo_sangre" id="tipo_sangre" required>
                            <option value="">Seleccione...</option>
                            @foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'AB+', 'AB-'] as $tipo)
                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                        @error('tipo_sangre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ultima_visita_odontologo" class="form-label">Última Visita Odontólogo</label>
                        <input type="date" id="ultima_visita_odontologo" name="ultima_visita_odontologo" class="form-control"
                            value="{{ old('ultima_visita_odontologo') }}">
                        @error('ultima_visita_odontologo')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="ultimo_tratamiento" class="form-label">Último Tratamiento</label>
                        <input type="text" id="ultimo_tratamiento" name="ultimo_tratamiento" class="form-control"
                            value="{{ old('ultimo_tratamiento')}}">
                        @error('ultimo_tratamiento')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="acudiente" class="form-label">Nombre del Acudiente</label>
                        <input type="text" id="acudiente" name="acudiente" class="form-control"
                            value="{{ old('acudiente') }}">
                        @error('acudiente')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="parentesco" class="form-label">Parentesco con Acudiente</label>
                        <input type="text" id="parentesco" name="parentesco" class="form-control"
                            value="{{ old('parentesco')}}">
                        @error('parentesco')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="ocupacion_acudiente" class="form-label">Ocupación del Acudiente</label>
                        <input type="text" id="ocupacion_acudiente" name="ocupacion_acudiente" class="form-control"
                            value="{{ old('ocupacion_acudiente') }}">
                        @error('ocupacion_acudiente')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="correo_acudiente" class="form-label">Correo del Acudiente</label>
                        <input type="email" id="correo_acudiente" name="correo_acudiente" class="form-control"
                            value="{{ old('correo_acudiente') }}">
                        @error('correo_acudiente')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="celular_acudiente" class="form-label">Celular del Acudiente</label>
                        <input type="text" id="celular_acudiente" name="celular_acudiente" class="form-control"
                            value="{{ old('celular_acudiente') }}" maxlength="10">
                        @error('celular_acudiente')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="como_se_entero" class="form-label">¿Cómo se Enteró?</label>
                    <input type="text" id="como_se_entero" name="como_se_entero" class="form-control"
                        value="{{ old('como_se_entero') }}">
                    @error('como_se_entero')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{url('admin/pacientes')}}"
                                class="btn btn-secondary m-3 btn-lg"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                            <button type="submit" class="btn btn-success btn-lg"><i class="fa-solid fa-id-card"></i> Registrar Paciente</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection