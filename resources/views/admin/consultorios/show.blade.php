@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Datos del consultorio {{$consultorio -> nombre}}</h1>
</div>
<hr>


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
                        <p>{{$consultorio -> nombre}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Dirección</label>
                        <p>{{$consultorio -> direccion}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <p>{{$consultorio -> telefono}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Email</label>
                        <p>{{$consultorio -> email}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Horario de atención</label>
                        <p>{{$consultorio -> horario_atencion}}</p>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Tipo de consultorio</label>
                        <p>{{ $consultorio->tipo_consultorio}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Especialidad</label>
                        <p>{{ $consultorio->especialidad}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Ciudad</label>
                        <p>{{ $consultorio->ciudad}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Capacidad</label>
                        <p>{{ $consultorio->capacidad}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Estado</label>
                        <p>{{ $consultorio->estado}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <p>{{ $consultorio->observaciones}}</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Ubicación</label>
                        <p>{{ $consultorio->ubicacion}}</p>
                    </div>
                </div>
            </div>


            <div class="row ">
                <div class="col-md-6 ">
                    <div class="form-group ">
                        <a href="{{url('admin/consultorios')}}"
                            class="btn btn-secondary "><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection