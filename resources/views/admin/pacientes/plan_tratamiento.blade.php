@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- Encabezado --}}
    <form action="{{ route('admin.pacientes.plan-tratamiento.update', $paciente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0 font-weight-bold">PLAN DE TRATAMIENTO</h3>
            <div class="form-group mb-0">
                <label class="font-weight-bold small text-uppercase">Historia Clínica</label>
                <input
                    type="text"
                    class="form-control form-control-sm"
                    style="max-width:150px;"
                    readonly
                    value="{{ $paciente->numero_historia ?? '—' }}">
            </div>
        </div>


        {{-- Modalidades --}}
        <div class="row mb-4">
            <div class="col-6">
                <div class="form-inline">
                    {{-- Ortodoncia Correctiva --}}
                    {{-- 1. Hidden para enviar “0” cuando no esté marcado --}}
                    <input type="hidden" name="ortodoncia_correctiva" value="0">
                    {{-- 2. Checkbox que SIEMPRE recibe el atributo checked correctamente --}}
                    <input
                        class="form-check-input mr-2"
                        type="checkbox"
                        id="orcorr"
                        name="ortodoncia_correctiva"
                        value="1"
                        {{ old('ortodoncia_correctiva', $plan->ortodoncia_correctiva ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="orcorr">Ort. Correctiva</label>

                    {{-- Compensación Ortodoncia --}}
                    <input type="hidden" name="compensacion_ortodoncia" value="0">
                    <input
                        class="form-check-input mr-2"
                        type="checkbox"
                        id="compord"
                        name="compensacion_ortodoncia"
                        value="1"
                        {{ old('compensacion_ortodoncia', $plan->compensacion_ortodoncia ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="compord">Compensación</label>
                </div>
            </div>
            <div class="col-6 text-right">
                <div class="form-inline justify-content-end">
                    {{-- Ortopedia Dentofacial --}}
                    <input type="hidden" name="ortopedia_dentofacial" value="0">
                    <input
                        class="form-check-input mr-2"
                        type="checkbox"
                        id="orteo"
                        name="ortopedia_dentofacial"
                        value="1"
                        {{ old('ortopedia_dentofacial', $plan->ortopedia_dentofacial ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="orteo">Ortopedia Dentofacial</label>

                    {{-- Cirugía Ortognática --}}
                    <input type="hidden" name="cirugia_ortognatica" value="0">
                    <input
                        class="form-check-input mr-2"
                        type="checkbox"
                        id="cirort"
                        name="cirugia_ortognatica"
                        value="1"
                        {{ old('cirugia_ortognatica', $plan->cirugia_ortognatica ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cirort">Cirugía Ortognática</label>
                </div>
            </div>
        </div>


        {{-- Objetivos --}}
        <div class="mb-4">
            <label for="editor_obsRadio" class="small font-weight-bold text-uppercase mb-2">Objetivos del Tratamiento</label>
            <div
                class="border rounded"
                style=" overflow:auto; padding:0;">
                <textarea
                    id="editor_obsRadio"
                    name="objetivos"
                    class="form-control border-0 p-2 h-100"
                    style="resize:none;">{{ old('objetivos', $plan->objetivos ?? '') }}</textarea>
            </div>
        </div>

        {{-- Exodoncias --}}
        <div class="row mb-3">
            @foreach([
            'exodoncias' => 'Exodoncias',
            'posibles_exodoncias' => 'Posibles Exodoncias',
            'sin_exodoncias' => 'Sin Exodoncias',
            ] as $field => $label)
            <div class="col-md-4">
                <label class="small font-weight-bold">{{ $label }}</label>
                <input
                    type="text"
                    name="{{ $field }}"
                    class="form-control"
                    value="{{ old($field, $plan->$field ?? '') }}">
            </div>
            @endforeach
        </div>

        {{-- Aparatología y Contención --}}
        <div class="mb-3">
            <label class="small font-weight-bold">Aparatología Complementaria</label>
            <input
                type="text"
                name="aparatologia_complementaria"
                class="form-control"
                value="{{ old('aparatologia_complementaria', $plan->aparatologia_complementaria ?? '') }}">
        </div>
        <div class="mb-4">
            <label class="small font-weight-bold">Contención</label>
            <input
                type="text"
                name="contencion"
                class="form-control"
                value="{{ old('contencion', $plan->contencion ?? '') }}">
        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-between">
            <a
                href="{{ route('admin.pacientes.show', $paciente) }}"
                class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-cloud"></i> Guardar Plan
            </button>
        </div>
    </form>
</div>

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

    ClassicEditor.create(document.querySelector('#editor_obsRadio'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: {
            items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        },
    });
</script>
<!-- /SCRIPTS DE CKEDITOR -->
@endsection