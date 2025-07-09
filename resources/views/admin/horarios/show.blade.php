@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Datos Horario</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-10">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> Datos registrados</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Doctor</label>
                            <p>{{$horario -> doctor -> nombres. " ". $horario -> doctor ->apellidos . " - ". $horario -> doctor ->especialidad}}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Consultorio</label>
                            <p>{{$horario ->consultorio -> nombre . " - ". $horario ->consultorio ->direccion }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Día</label>
                            <p>{{$horario -> dia}}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora incio</label>
                            <p>{{$horario -> hora_inicio}}</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora Fin</label>
                            <p>{{ $horario->hora_fin}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group ">
                            <a href="{{url('admin/horarios')}}"
                                class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection