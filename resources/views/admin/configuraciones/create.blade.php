@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Configuraciones</h1>
</div>
<hr>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.configs.store') }}" method="POST" id="formulario" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre Consultorio</label> <b>*</b>
                                <input type="text" value="{{old('nombre')}}" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Dirección</label> <b>*</b>
                                <input type="address" value="{{old('direccion')}}" class="form-control" name="direccion" id="direccion" placeholder="direccion" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Telefono</label> <b>*</b>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="{{old('telefono')}}" required maxlength="10">
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="custom-file col-md-4 m-4">
                            <div class="form-group ">
                                <label class="custom-file-label" for="logo">Selecciona tu Logo</label>
                                <input type="file" class="custom-file-input" name="logo" id="logo" placeholder="logo" required>
                                <!-- previsualiza imagen/logo cargada por el usuario -->
                                <center>
                                    <output id="list">

                                    </output>
                                </center>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        bsCustomFileInput.init();
                                    });
                                </script>
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
                                <!-- /previsualiza imagen/logo cargada por el usuario -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap gap-2">
            <a href="{{url('admin/configs')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-gear"></i> Configurar</button>
        </div>
        </form>
    </div>
</div>
</div>

@endsection