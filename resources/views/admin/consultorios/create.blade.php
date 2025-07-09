@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Registar Consultorio</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.consultorios.create') }}" method="POST" id="formulario">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del Consultorio</label> <b>*</b>
                                <input type="text" value="{{old('nombre')}}" class="form-control" name="nombre" id="nombre" placeholder="Nombre Consultorio" required>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Dirección</label> <b>*</b>
                                <input type="direccion" value="{{old('direccion')}}" class="form-control" name="direccion" id="direccion" placeholder="direccion" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Teléfono</label> <b>*</b>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="telefono" maxlength="10" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Horario atención</label> <b>*</b>
                                <input type="text" class="form-control" name="horario_atencion" id="horario_atencion" placeholder="Horario atención" required>
                                @error('horario_atencion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado_civil">Tipo de consultorio</label>
                                <select class="form-control" name="tipo_consultorio" id="tipo_consultorio">
                                    <option value="">Seleccione...</option>
                                    <option value="privado">Privado</option>
                                    <option value="publico">Público</option>
                                </select>
                                @error('tipo_consultorio')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad</label> <b>*</b>
                                <input type="especialidad" value="{{old('especialidad')}}" class="form-control" name="especialidad" id="especialidad" placeholder="especialidad" required>
                                @error('especialidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Ciudad</label> <b>*</b>
                                <input type="ciudad" class="form-control" name="ciudad" id="ciudad" placeholder="ciudad" required>
                                @error('ciudad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Capacidad</label> <b>*</b>
                                <input type="number" class="form-control" name="capacidad" id="capacidad" placeholder="Capacidad" maxlength="4" required>
                                @error('capacidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado_civil">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="">Seleccione...</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                                @error('estado')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <input type="observaciones" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones">
                                @error('observaciones')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="">Ubicación</label> <b>*</b>
                                <input type="ubicacion" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicación" required>
                                @error('ubicacion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/consultorios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-clipboard-check"></i> Registrar Consultorio</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection