@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Perfil del Doctor
        <span class="text-danger">*{{$doctor -> nombres}} {{$doctor -> apellidos}}*</span>
    </h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Eliminar registro</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/doctores', $doctor->id)}}" method="POST" id="formulario">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" value="{{$doctor -> nombres}}" class="form-control" name="nombres" id="nombres" placeholder="Nombre" disabled>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" value="{{ $doctor->apellidos}}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" disabled>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ $doctor->user ->email}}" class="form-control" name="email" id="email" placeholder="Email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/doctores')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar Doctor</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection