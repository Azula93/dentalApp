@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Crear Usuario</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.usuarios.create') }}" method="POST" id="formulario">
                    @csrf
                    <div class="row">

                        <div class="mb-3">
                            <label for="role" class="form-label">Tipo de usuario</label><b> *</b>
                            <select
                                name="role"
                                id="role"
                                class="custom-select @error('role') is-invalid @enderror"
                                required>
                                <option value="">-- Selecciona rol --</option>
                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                <option
                                    value="{{ $role->name }}"
                                    {{ old('role') == $role->name ? 'selected' : '' }}>
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



                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre Usuario</label> <b>*</b>
                                <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="Nombre Usuario" required>
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
                                <input type="email" value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Verificación Contraseña</label> <b>*</b>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Verificación Contraseña" required>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Registrar usuario</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection