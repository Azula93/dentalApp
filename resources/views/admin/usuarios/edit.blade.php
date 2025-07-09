@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Editar datos {{$usuario -> name}} </h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" id="formulario">

                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Usuario</label> <b>*</b>
                                <input type="text" value="{{$usuario -> name}}" class="form-control" name="name" id="name" placeholder="Nombre Usuario" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email</label> <b>*</b>
                                <input type="email" value="{{$usuario -> email}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Repetir Contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir Contraseña">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Tipo de usuario</label><b> *</b>
                        <select name="role" id="role" class="custom-select" required>
                            <option value="">-- Selecciona rol --</option>
                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}"
                                {{ (old('role') ?? $usuario->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-success"> <i class="fa-solid fa-arrows-rotate"></i> Actualizar datos </button>

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