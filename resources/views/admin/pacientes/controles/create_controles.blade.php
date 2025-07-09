@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">Registar Control</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registra los datos del control</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/pacientes/controles/create') }}" method="POST" id="formulario">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paciente_id">Nombre Paciente <span class="text-danger">*</span></label>
                                <select name="paciente_id" id="paciente_id" class="form-control" required>
                                    <option value="">-- Seleccione paciente --</option>
                                    @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->apellidos }} {{ $paciente->nombres }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @hasanyrole('admin|secretaria')
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctor_id">Nombre Doctor <span class="text-danger">*</span></label>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <option value="">-- Seleccione doctor --</option>
                                    @foreach($doctores as $d)
                                    <option value="{{ $d->id }}" {{ old('doctor_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nombres }} {{ $d->apellidos }}
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
                                <label for="fecha_consulta">Fecha Consulta <span class="text-danger">*</span></label>
                                <input
                                    type="date"
                                    name="fecha_consulta"
                                    id="fecha_consulta"
                                    class="form-control"
                                    value="{{ old('fecha_consulta', now()->toDateString()) }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle_editor">Descripción <span class="text-danger">*</span></label>

                                {{-- CKEditor se monta sobre este textarea, SIN required --}}
                                <textarea id="detalle_editor" rows="6" class="form-control">{{ old('detalle') }}</textarea>

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
                                    .then(editor => {
                                        editorInstance = editor;
                                    })
                                    .catch(error => console.error(error));

                                // Copiar el contenido al input oculto antes de enviar
                                document.getElementById('formulario').addEventListener('submit', () => {
                                    document.getElementById('detalle_hidden').value = editorInstance.getData();
                                });
                            </script>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ url('/admin/pacientes/controles') }}" class="btn btn-secondary">
                                Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Registrar Control
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection