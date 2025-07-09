@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Configuraciones</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"> Deseas eliminar estos datos ?</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/configs', $configuracion->id) }}" method="POST" id="formulario" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre Consultorio</label>
                                <input type="text" value="{{ $configuracion ->nombre }}" class="form-control" name="nombre" id="nombre" placeholder="nombre" disabled>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="address" value="{{$configuracion ->direccion}}" class="form-control" name="direccion" id="direccion" placeholder="direccion" disabled>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value="{{$configuracion ->telefono}}" placeholder="Telefono" maxlength="10" disabled>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{$configuracion ->email}}" class="form-control" name="email" id="email" placeholder="email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- LOGO -->
                    {{-- Previsualización iamgen--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <output id="list">
                                <img src="{{ url('storage/'.$configuracion->logo)}} " alt="logotipo" width="90px" height="90px" style="border-radius: 50%; margin-top: 10px;">
                            </output>
                        </div>
                    </div>
                    <!-- /LOGO -->
            </div>

            <div class="row">
                <div class="col-md-12 m-3">
                    <div class="form-group">
                        <a href="{{url('admin/configs')}}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Regresar
                        </a>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection