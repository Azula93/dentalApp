@extends('layouts.admin')
@section('content')
<h1 class=" p-3 text-center">Anamnesis del paciente {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>

<form action="{{ route('admin.pacientes.anamnesis.update', $paciente) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Motivo Consulta</label> <b>*</b>
                <textarea name="motivo_consulta" id="editor_motivo" class="form-control" cols="30" rows="10" style="width: 100%;">{{ old('motivo_consulta', $anamnesis->motivo_consulta ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Historia de enfermedad actual</label> <b>*</b>
                <textarea name="historia_enfermedad_actual" id="editor_historia" class="form-control" cols="30" rows="10" style="width: 100%;">{{ old('historia_enfermedad_actual', $anamnesis->historia_enfermedad_actual ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row p-3">
        <a href="{{url('admin/pacientes')}}" class="btn btn-secondary m-2"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
        <button type="submit" class="btn btn-success m-2"><i class="fa-solid fa-cloud"></i> Guardar Anamnesis</button>
    </div>

</form>

<!-- SCRIPTS DE CKEDITOR -->
<script type="importmap">
    {
        "imports": {
            "ckeditor5":"https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
            "ckeditor5/":"https://cdn.ckeditor.com/ckeditor5/42.0.1/"
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

    ClassicEditor.create(document.querySelector('#editor_motivo'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: {
            items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        },
    });

    ClassicEditor.create(document.querySelector('#editor_historia'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: {
            items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        },
    });
</script>
<!-- /SCRIPTS DE CKEDITOR -->
@endsection