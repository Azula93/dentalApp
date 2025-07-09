@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Eliminar Consultorio <span class="text-danger">*{{$consultorio -> nombre}}*</span></h1>
</div>
<hr>

<div class="container-fluid">
    <div class="col-md-6 offset-md-3">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Eliminar datos del consultorio</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/consultorios', $consultorio->id)}}" method="POST" id="formulario">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Consultorio</label>
                                <input type="text" value="{{$consultorio -> nombre}}" class="form-control" name="nombre" id="nombre" placeholder="Nombre Consultorio" disabled>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" value="{{ $consultorio->direccion}}" class="form-control" name="direccion" id="direccion" placeholder="Dirección" disabled>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <input type="text" value="{{ $consultorio->telefono}}" class="form-control" name="telefono" id="telefono" placeholder="Dirección" disabled>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ $consultorio->email}}" class="form-control" name="email" id="email" placeholder="Email" disabled>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/consultorios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar consultorio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection