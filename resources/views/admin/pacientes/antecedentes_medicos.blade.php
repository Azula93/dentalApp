@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- TÍTULO --}}
    <h1 class="text-center mb-5 display-6 fw-semibold">
        <i class="fa-solid fa-notes-medical me-2 text-primary"></i>
        Antecedentes médicos de <br>{{ $anteMed->paciente->nombres }} {{ $anteMed->paciente->apellidos }}
    </h1>

    <form action="{{ route('admin.pacientes.antecedentes-medicos.update', $paciente->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ====== PERSONALES ====== --}}
        <div class="card shadow-sm mb-4 border-primary-subtle">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fa-solid fa-user-md me-2"></i> Antecedentes Médicos Personales
                </h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @php
                    $personales = [
                    'alergias' => 'Alergias',
                    'trastornos_coagulacion' => 'Trastornos de la coagulación',
                    'enf_respiratorias' => 'Enfermedades respiratorias',
                    'alteraciones_cardiacas' => 'Alteraciones cardíacas',
                    'fiebre_reumatica' => 'Fiebre reumática',
                    'cirugias' => 'Cirugías previas',
                    'enf_renal' => 'Enfermedades renales',
                    'hepatitis' => 'Hepatitis',
                    'trastornos_gastricos' => 'Trastornos gástricos',
                    'hipertension' => 'Hipertensión',
                    'diabetes' => 'Diabetes',
                    'hospitalizaciones' => 'Hospitalizaciones',
                    'tto_farmacologico_actual' => 'Tratamiento farmacológico actual',
                    'tto_medico_actual' => 'Tratamiento médico actual',
                    'vih_sida' => 'VIH/SIDA',
                    'cancer' => 'Cáncer',
                    'fuma' => 'Fuma',
                    'embarazo' => 'Embarazo',
                    'otra_patologia' => 'Otra patología',
                    ];
                    @endphp

                    @foreach ($personales as $field => $label)
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="hidden" name="{{ $field }}" value="0">
                        <div class="form-check">
                            <input type="checkbox" name="{{ $field }}" id="{{ $field }}" class="form-check-input"
                                value="1" {{ old($field, $anteMed->$field) ? 'checked' : '' }}>
                            <label class="form-check-label ms-1" for="{{ $field }}">{{ $label }}</label>
                        </div>
                    </div>
                    @endforeach

                    {{-- Otra patología --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="editor_patologiaPersonal">
                            <i class="fa-solid fa-circle-info me-1 text-primary"></i>
                            Si marcaste “Otra patología”, especifícala:
                        </label>
                        <textarea name="antecedentes_personales_otro"
                            id="editor_patologiaPersonal"
                            class="form-control"
                            rows="4">{{ old('antecedentes_personales_otro', $anteMed->antecedentes_personales_otro ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== FAMILIARES ====== --}}
        <div class="card shadow-sm mb-4 border-success-subtle">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="fa-solid fa-people-group me-2"></i> Antecedentes Médicos Familiares
                </h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @php
                    $familiares = [
                    'fam_cardiovasculares' => 'Cardiovasculares',
                    'fam_oncologicos' => 'Oncológicos',
                    'fam_endocrinos' => 'Endocrinos',
                    'fam_psiquiatricos' => 'Psiquiátricos',
                    'fam_hematologicos' => 'Hematológicos',
                    'fam_neurologicos' => 'Neurológicos',
                    'fam_autoinmunes' => 'Autoinmunes',
                    'fam_otros' => 'Otros',
                    ];
                    @endphp

                    @foreach ($familiares as $field => $label)
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="hidden" name="{{ $field }}" value="0">
                        <div class="form-check">
                            <input type="checkbox" name="{{ $field }}" id="{{ $field }}" class="form-check-input"
                                value="1" {{ old($field, $anteMed->$field) ? 'checked' : '' }}>
                            <label class="form-check-label ms-1" for="{{ $field }}">{{ $label }}</label>
                        </div>
                    </div>
                    @endforeach

                    {{-- Otros --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="editor_patologiaFamiliar">
                            <i class="fa-solid fa-circle-info me-1 text-success"></i>
                            Si marcaste “Otros”, especifícalo:
                        </label>
                        <textarea name="antecedentes_familiares_otro"
                            id="editor_patologiaFamiliar"
                            class="form-control"
                            rows="4">{{ old('antecedentes_familiares_otro', $anteMed->antecedentes_familiares_otro ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== OBSERVACIONES ====== --}}
        <div class="card shadow-sm mb-5 border-warning-subtle">
            <div class="card-header bg-warning">
                <h4 class="mb-0">
                    <i class="fa-solid fa-comment-medical me-2"></i>Observaciones Generales
                </h4>
            </div>
            <div class="card-body">
                <textarea name="observaciones"
                    id="editor_obsGenerales"
                    class="form-control"
                    rows="4">{{ old('observaciones', $anteMed->observaciones ?? '') }}</textarea>
            </div>
        </div>

        {{-- ====== BOTONES ====== --}}
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <a href="{{ route('admin.pacientes.index', $anteMed) }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Regresar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-cloud-arrow-up me-1"></i> Guardar datos
            </button>
        </div>

    </form>
</div>

{{-- =========== CKEDITOR =========== --}}
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

    const editors = [
        '#editor_patologiaPersonal',
        '#editor_patologiaFamiliar',
        '#editor_obsGenerales'
    ];

    editors.forEach(selector =>
        ClassicEditor.create(document.querySelector(selector), {
            plugins: [Essentials, Bold, Italic, Font, Paragraph],
            toolbar: {
                items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor']
            }
        })
    );
</script>
@endsection