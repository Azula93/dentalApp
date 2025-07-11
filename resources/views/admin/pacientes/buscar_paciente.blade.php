@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-4 p-3">
        <h1>Ver Ficha del Paciente</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Buscar Paciente</h3>
                </div>
                <div class="card-body">
                    <form action=" {{route('admin.pacientes.buscar_paciente')}} " method="get">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Documento de Identidad</label>
                                    <input type="text" class="form-control" name="di" id="di" placeholder="Ingrese el documento de identidad del paciente" value="{{ request()->get('documento') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div style="height: 30px;"></div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa-solid fa-magnifying-glass"></i> Buscar Paciente
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @if(request()->filled('di'))
                    @if($paciente)
                    <h4 class="mb-3"></h4>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light py-3">
                            <h5 class="mb-0">
                                <i class="fa-solid fa-user-circle me-2 text-primary"></i>
                                Información del paciente
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Nombre Completo</span>
                                <span>{{ $paciente->nombres }} {{ $paciente->apellidos }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Documento de identidad</span>
                                <span class="text-muted">{{ $paciente->di }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">EPS</span>
                                <span class="text-muted">{{ $paciente->eps }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="text-end mb-5">
                        <a href="{{ route('admin.pacientes.imprimir_hc', $paciente) }}" target="_blank" class="btn btn-warning shadow-sm">
                            <i class="fa-solid fa-file-pdf me-1"></i>
                            Generar Historia Clínica
                        </a>

                        @else
                        <div class="alert alert-warning">
                            <strong>¡Atención!</strong> No se encontró ningún paciente con el documento de identidad proporcionado.
                            Por favor, verifique el número de documento e intente nuevamente.
                        </div>
                        @endif
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection