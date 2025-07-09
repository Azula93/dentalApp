@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <h1 class="mt-3 text-center ">Editar Datos del Consultorio <br> {{$consultorio -> nombre}}</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Editar datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/consultorios', $consultorio->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre Consultorio</label>
                                <input type="text" value="{{$consultorio -> nombre}}" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" value="{{$consultorio -> direccion}}" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                                @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Télefono</label>
                                <input type="text" value="{{$consultorio -> telefono}}" class="form-control" name="telefono" id="telefono" placeholder="Télefono" maxlength="10" required>
                                @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ $consultorio->email}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Horario atención</label>
                                <input type="text" value="{{$consultorio -> horario_atencion}}" class="form-control" name="horario_atencion" id="horario_atencion" placeholder="horario atención" required>
                                @error('horario_atencion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_consultorio">Tipo Consultorio</label>
                                <select class="form-control" name="tipo_consultorio" id="tipo_consultorio" required>
                                    <option value="">Seleccione...</option>
                                    <option value="privado" {{ old('tipo_consultorio', $consultorio->tipo_consultorio) === 'privado' ? 'selected' : '' }}>Privado</option>
                                    <option value="publico" {{ old('tipo_consultorio', $consultorio->tipo_consultorio) === 'publico' ? 'selected' : '' }}>Público</option>
                                </select>
                                @error('tipo_consultorio')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad</label>
                                <input type="text" value="{{$consultorio -> especialidad}}" class="form-control" name="especialidad" id="especialidad" placeholder="Dirección" required>
                                @error('especialidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" value="{{$consultorio -> ciudad}}">
                                @error('ciudad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group">
                                <label for="">Capacidad</label>
                                <input type="number" class="form-control" name="capacidad" id="capacidad" placeholder="Capacidad" value="{{$consultorio -> capacidad}}">
                                @error('capacidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="">Seleccione...</option>
                                    <option value="activo" {{ old('estado', $consultorio->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado', $consultorio->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicación" value="{{$consultorio -> ubicacion}}">
                                @error('ubicacion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <input type="text" class="form-control" name="observaciones" id="observaciones" placeholder="observaciones" value="{{$consultorio -> observaciones}}">
                                @error('observaciones')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{url('admin/consultorios')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-repeat"></i> Actualizar datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection