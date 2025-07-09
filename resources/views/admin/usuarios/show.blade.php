@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Datos del usuario {{$usuario -> name}}</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"> Datos registrados</h3>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre Usuario</label>
                            <p>{{$usuario -> name}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Email</label>
                            <p>{{$usuario -> email}}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{url('admin/usuarios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>


                        </div>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
        </div>

    </div>

</div>

@endsection