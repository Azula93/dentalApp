@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Paciente <span class="text-danger">*{{$paciente -> nombres}} {{$paciente -> apellidos}}*</span></h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Eliminar datos</h3>
            </div>
            {{-- Resumen de datos para que el usuario vea qué va a borrar --}}
            <div class="alert alert-warning ">
                <span style="display: flex; justify-content:center "><i class="fa-solid fa-triangle-exclamation me-1"></i></span>
                <span style="display: flex; justify-content:center "><strong>¡Atención!</strong></span> <br> Esta acción es irreversible. Se eliminará el paciente que se muestra a continuación.
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/pacientes', $paciente->id)}}" method="POST" id="formulario">
                    @csrf
                    @method('DELETE')
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Número Historia</label>
                                <input type="text" value="{{$paciente -> numero_historia}}" class="form-control" name="numero_historia" id="numero_historia" placeholder="Nombre Colaborador" disabled>
                                @error('numero_historia')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Paciente</label>
                                <input type="text" value="{{$paciente -> nombres}}" class="form-control" name="nombres" id="nombres" placeholder="Nombre Colaborador" disabled>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" value="{{ $paciente->apellidos}}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" disabled>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ $paciente->email}}" class="form-control" name="email" id="email" placeholder="Email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Documento</label>
                                <input type="text" value="{{ $paciente->cc}}" class="form-control" name="cc" id="cc" placeholder="Documento" disabled>
                                @error('cc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class=" d-flex justify-content-between flex-wrap gap-2">
                        <a href="{{url('admin/pacientes')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar Paciente</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection