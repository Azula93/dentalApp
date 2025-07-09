@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Datos de {{$secretaria -> nombres}} {{$secretaria -> apellidos}}</h1>
</div>
<hr>


<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"> Datos registrados</h3>
        </div>

        <div class="card-body">

            <div class="row ">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nombres</label>
                        <p>{{$secretaria -> nombres}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <p>{{$secretaria -> apellidos}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Cédula</label>
                        <p>{{$secretaria -> cc}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Télefono</label>
                        <p>{{$secretaria -> telefono}}</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <p>{{$secretaria -> direccion}}</p>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Email</label>
                        <p>{{ $secretaria->user ->email}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{url('admin/secretarias')}}"
                            class="btn btn-secondary  m-3"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection