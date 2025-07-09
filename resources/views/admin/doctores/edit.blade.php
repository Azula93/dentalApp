@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Editar datos {{$doctor -> nombres}} {{$doctor -> apellidos}}</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/doctores', $doctor->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre doctor</label> <b>*</b>
                                <input type="text" value="{{$doctor -> nombres}}" class="form-control" name="nombres" id="nombres" placeholder="Nombre" required>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Apellidos</label> <b>*</b>
                                <input type="text" value="{{$doctor -> apellidos}}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cédula</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula" value="{{$doctor -> cedula}}">
                                @error('cedula')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Télefono</label> <b>*</b>
                                <input type="text" value="{{$doctor -> telefono}}" class="form-control" name="telefono" id="telefono" placeholder="Télefono" maxlength="10" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Especialidad</label> <b>*</b>
                                <input type="text" value="{{$doctor -> especialidad}}" class="form-control" name="especialidad" id="especialidad" placeholder="Dirección" required>
                                @error('especialidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" value="{{$doctor -> direccion}}">
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{ $doctor->user->email}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="">Repetir Contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir Contraseña">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/doctores')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-repeat"></i> Actualizar datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection