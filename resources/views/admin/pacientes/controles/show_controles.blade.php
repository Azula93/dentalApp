@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">
        Control del paciente:
        <span class="text-primary">
            {{ $control->paciente->nombres }} {{ $control->paciente->apellidos }}
        </span>
    </h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detalle del control</h3>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-md-3">Paciente</dt>
                    <dd class="col-md-9">
                        {{ $control->paciente->apellidos }} {{ $control->paciente->nombres }}
                    </dd>

                    <dt class="col-md-3">Doctor</dt>
                    <dd class="col-md-9">
                        {{ $control->doctor->nombres }} {{ $control->doctor->apellidos }}
                    </dd>

                    <dt class="col-md-3">Fecha consulta</dt>
                    <dd class="col-md-9">{{ $control->fecha_consulta }}</dd>

                    <dt class="col-md-3">Descripción</dt>
                    <dd class="col-md-9">{!! $control->detalle !!}</dd>
                </dl>
            </div>

            <div class="card-footer">
                <a href="{{ url('/admin/pacientes/controles') }}" class="btn btn-secondary">
                    Regresar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection