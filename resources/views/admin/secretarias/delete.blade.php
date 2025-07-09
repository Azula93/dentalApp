@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Colaborador <span class="text-danger">*{{$secretaria -> nombres}} {{$secretaria -> apellidos}}*</span></h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Eliminar datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/secretarias', $secretaria->id)}}" method="POST" id="formulario">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Colaborador</label>
                                <input type="text" value="{{$secretaria -> nombres}}" class="form-control" name="nombres" id="nombres" placeholder="Nombre Colaborador" disabled>
                                @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" value="{{ $secretaria->apellidos}}" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" disabled>
                                @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ $secretaria->user ->email}}" class="form-control" name="email" id="email" placeholder="Email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/secretarias')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar colaborador</button>

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