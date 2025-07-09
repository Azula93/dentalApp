@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <h1 class="mt-3 text-center">Datos del Doctor <br> {{$doctor -> nombres}} {{$doctor -> apellidos}}</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> Datos registrados</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Nombres</label>
                            <p>{{$doctor -> nombres}}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <p>{{$doctor -> apellidos}}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Cédula</label>
                            <p>{{$doctor -> cedula}}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <p>{{$doctor -> telefono}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Especialidad</label>
                            <p>{{ $doctor->especialidad}}</p>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Dirección</label>
                            <p>{{$doctor -> direccion}}</p>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <p>{{ $doctor->email}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group ">
                            <a href="{{url('admin/doctores')}}"
                                class="btn btn-secondary "><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection