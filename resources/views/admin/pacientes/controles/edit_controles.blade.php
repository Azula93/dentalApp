@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">Modificar información de Control</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Modifica los datos del control</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.pacientes.controles.update_controles', $control) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paciente_id">Nombre Paciente </label>
                                <select name="paciente_id" id="paciente_id" class="form-control" required>
                                    <option value="">-- Seleccione paciente --</option>
                                    @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ old('paciente_id', $control->paciente_id) == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->apellidos }} {{ $paciente->nombres }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @hasanyrole('admin|secretaria')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_id">Nombre Doctor</label>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <option value="">-- Seleccione doctor --</option>
                                    @foreach ($doctores as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id', $control->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->nombres }} {{ $doctor->apellidos }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endhasanyrole



                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_consulta">Fecha Consulta </label>
                                <input
                                    type="date"
                                    name="fecha_consulta"
                                    id="fecha_consulta"
                                    class="form-control"
                                    value="{{ $control->fecha_consulta }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle_editor">Descripción </label>

                                <textarea id="detalle_editor" rows="6" class="form-control">{{ $control->detalle }}</textarea>

                                {{-- Campo real que se envía (required) --}}
                                <input type="hidden" name="detalle" id="detalle_hidden" required>
                            </div>

                            <script type="importmap">
                                {
    "imports": {
        "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
        "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
    }
}
</script>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('/admin/pacientes/controles') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Regresar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-wrench"></i> Actualizar Datos Control
                            </button>
                        </div>
                    </div>
                    @push('scripts')
                    <script type="module">
                        import {
                            ClassicEditor,
                            Essentials,
                            Bold,
                            Italic,
                            Font,
                            Paragraph
                        } from 'ckeditor5';

                        let editorInstance;
                        ClassicEditor
                            .create(document.querySelector('#detalle_editor'), {
                                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                                toolbar: {
                                    items: [
                                        'undo', 'redo', '|',
                                        'italic', 'fontSize', 'fontFamily',
                                        'fontColor', 'fontBackgroundColor'
                                    ]
                                }
                            })
                            .then(editor => editorInstance = editor)
                            .catch(err => console.error(err));

                        // Copiar al hidden antes de enviar
                        document.getElementById('formulario').addEventListener('submit', () => {
                            document.getElementById('detalle_hidden').value = editorInstance.getData();
                        });
                    </script>
                    @endpush

                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection