@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3 text-danger">Eliminar Horario</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Confirmar eliminación</h3>
            </div>

            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Doctor</label>
                            <p>{{ $horario->doctor->nombres }} {{ $horario->doctor->apellidos }} &mdash; {{ $horario->doctor->especialidad }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Consultorio</label>
                            <p>{{ $horario->consultorio->nombre }} &mdash; {{ $horario->consultorio->direccion }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Día</label>
                            <p>{{ ucfirst($horario->dia) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hora inicio</label>
                            <p>{{ $horario->hora_inicio }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hora fin</label>
                            <p>{{ $horario->hora_fin }}</p>
                        </div>
                    </div>
                </div>

                {{-- Formulario de confirmación --}}
                <form action="{{ route('admin.horarios.destroy', $horario->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Regresar
                        </a>

                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash me-1"></i> Eliminar Horario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection