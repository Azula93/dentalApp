@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Registar Colaborador</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.secretarias.create') }}" method="POST" id="formulario">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombres</label> <b>*</b>
                                <input type="text" value="{{old('nombres')}}" class="form-control" name="nombres" id="nombres" placeholder="Nombres" required>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">apellidos</label> <b>*</b>
                                <input type="apellidos" value="{{old('apellidos')}}" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos" required>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Cédula</label> <b>*</b>
                                <input type="text" class="form-control" name="cc" id="cc" placeholder="Cédula" required maxlength="10">
                                @error('cc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Telefono</label> <b>*</b>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" maxlength="10" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Dirección</label> <b>*</b>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Fecha Nacimiento</label> <b>*</b>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                                    @error('fecha_nacimiento')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Verificación Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir Contraseña" required>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/secretarias')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-id-card"></i> Registrar Colaborador</button>

                            </div>
                        </div>
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>

    </div>

</div>

@endsection