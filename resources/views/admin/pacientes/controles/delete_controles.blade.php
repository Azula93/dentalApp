@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">
        Eliminar datos de Control del paciente:
        <span class="text-primary">
            {{ $control->paciente->nombres }} {{ $control->paciente->apellidos }}
        </span>
    </h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Deseas Eliminar este registro? </h3>
            </div>
            <form action="{{  url('admin/pacientes/controles', $control->id) }}" method="POST" id="formulario">
                @csrf
                @method('DELETE')
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/pacientes/controles')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Eliminar Registro</button>
                            </div>
                        </div>
                    </div>

                </div>


        </div>
    </div>
</div>
@endsection