@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <h1 class="mt-3">Registar Doctor</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.doctores.create') }}" method="POST" id="formulario">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombres</label> <b>*</b>
                                <input type="text" value="{{old('nombres')}}" class="form-control" name="nombres" id="nombres" placeholder="nombres" required>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">apellidos</label> <b>*</b>
                                <input type="apellidos" value="{{old('apellidos')}}" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos" required>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cédula</label> <b>*</b>
                                <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula" required maxlength="10">
                                @error('cedula')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefono</label> <b>*</b>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="telefono" maxlength="10" pattern="\d{1,10}" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Especialidad</label> <b>*</b>
                                <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="especialidad" required>
                                @error('especialidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Dirección</label> <b>*</b>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Verificación Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir Contraseña" required>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/doctores')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Registrar Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection