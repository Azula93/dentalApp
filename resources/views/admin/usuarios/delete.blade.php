@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Usuario <span class="text-danger">*{{$usuario -> name}}*</span> </h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">

        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Eliminar datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/usuarios', $usuario->id)}}" method="POST" id="formulario">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Usuario</label>
                                <input type="text" value="{{$usuario -> name}}" class="form-control" name="name" id="name" placeholder="Nombre Usuario" disabled>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{$usuario -> email}}" class="form-control" name="email" id="email" placeholder="Email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/usuarios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Eliminar usuario</button>

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