@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Editar datos {{$secretaria -> nombres}} {{$secretaria -> apellidos}}</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Registrar los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/secretarias', $secretaria->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombres</label> <b>*</b>
                                <input type="text" value="{{$secretaria -> nombres}}" class="form-control" name="nombres" id="nombres" placeholder="Nombres" required>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos</label> <b>*</b>
                                <input type="text" value="{{$secretaria -> apellidos}}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Cédula</label> <b>*</b>
                                <input type="text" value="{{$secretaria -> cc}}" class="form-control" name="cc" id="cc" placeholder="Cédula" maxlength="10" required>
                                @error('cc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Télefono</label> <b>*</b>
                                <input type="number" value="{{$secretaria -> telefono}}" class="form-control" name="telefono" id="telefono" placeholder="Télefono" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Dirección</label> <b>*</b>
                                <input type="text" value="{{$secretaria -> direccion}}" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha Nacimiento</label> <b>*</b>
                                <input type="date" value="{{$secretaria -> fecha_nacimiento}}" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Dirección" required>
                                @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{ $secretaria->user ->email}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="">Repetir Contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir Contraseña">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/secretarias')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i> Actualizar datos</button>
                            </div>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection