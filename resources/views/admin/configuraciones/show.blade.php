@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Configuraciones</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre Consultorio:</label>
                            <p>{{$configuracion->nombre}} </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dirección:</label>
                            <p>{{$configuracion->direccion}} </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Telefono:</label>
                            <p>{{$configuracion->telefono}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email:</label>
                            <p> {{ $configuracion->email}} </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Logo:</label>
                            <img src="{{ url('storage/'.$configuracion->logo)}} " alt="logotipo" width="50px" height="50px">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 m-3">
                    <div class="form-group">
                        <a href="{{url('admin/configs')}}" class="btn btn-secondary">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection