@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Editar Configuraciones</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Modifica los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/configs', $configuracion->id) }}" method="POST" id="formulario" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre Consultorio</label>
                                <input type="text" value="{{ $configuracion ->nombre }}" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="address" value="{{$configuracion ->direccion}}" class="form-control" name="direccion" id="direccion" placeholder="direccion">
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
                                <input type="text" class="form-control" name="telefono" id="telefono" value="{{$configuracion ->telefono}}" placeholder="Telefono" maxlength="10">
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{$configuracion ->email}}" class="form-control" name="email" id="email" placeholder="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- LOGO -->
                    <div class="row  align-items-center ">

                        {{-- Input file --}}
                        <div class="custom-file col-md-6">
                            <div class="">
                                <label class="custom-file-label" for="logo">Selecciona tu Logo</label>

                                <input type="file" class="custom-file-input" name="logo" id="logo" placeholder="logo">
                            </div>
                        </div>
                        {{-- Previsualización iamgen--}}
                        <div class="col-md-6">
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
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-arrows-rotate"></i> Actualizar
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo file
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = [
                        '<img class="thumb thumbnail" src="',
                        e.target.result,
                        '" width="40%" title="',
                        escape(theFile.name),
                        '"/>'
                    ].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('logo').addEventListener('change', archivo, false);
</script>
@endpush

@endsection