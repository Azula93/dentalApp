@extends('layouts.admin')
@php
/* alias opcionales — elige uno */

$v = $modelo; // ← alias breve para todo el formulario
@endphp
@section('content')
<div class="container p-3 justify-content-center">
    {{-- Título de la página --}}
    <h1 class="mb-4 text-center">Valoración Ortodoncia y Ortopedia Dentofacial <br> Paciente: {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.pacientes.valoracion.update', $paciente) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Ortodoncia previa 🆗 --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Ortodoncia Previa</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Ortodoncia Previa</label><br>

                        {{-- envía 0 si el usuario no selecciona nada --}}
                        <input type="hidden" name="ortodoncia_previa" value="0">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="radio"
                                name="ortodoncia_previa"
                                id="ortodoncia_si"
                                value="1"
                                {{ old('ortodoncia_previa', $modelo->ortodoncia_previa) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="ortodoncia_si">Sí</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="radio"
                                name="ortodoncia_previa"
                                id="ortodoncia_no"
                                value="0"
                                {{ old('ortodoncia_previa', $modelo->ortodoncia_previa) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="ortodoncia_no">No</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tiene aparatología</label><br>

                        {{-- envía 0 si el usuario no selecciona nada --}}
                        <input type="hidden" name="tiene_aparatologia" value="0">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="radio"
                                name="tiene_aparatologia"
                                id="tiene_aparatologia"
                                value="1"
                                {{ old('tiene_aparatologia', $modelo->tiene_aparatologia) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="tiene_aparatologia">Sí</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                type="radio"
                                name="tiene_aparatologia"
                                id="ortodoncia_no"
                                value="0"
                                {{ old('tiene_aparatologia', $modelo->tiene_aparatologia) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="ortodoncia_no">No</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tiempo_aparatologia" class="form-label">Tiempo Aparatología</label>
                        <input type="text"
                            class="form-control"
                            id="tiempo_aparatologia"
                            name="tiempo_aparatologia"
                            value="{{ old('tiempo_aparatologia', $modelo->tiempo_aparatologia) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ─────────────────────────  EXAMEN FACIAL 🆗  ───────────────────────── --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Examen Facial</div>
            <div class="card-body">
                {{-- TIPO FACIAL: Perfil --}}
                <div class="row gy-2 mb-3">
                    <div class="col-12 fw-bold border-bottom"><strong>Tipo Facial</strong></div>

                    <div class="col-md-4 m-3">
                        <label class="form-label"><strong>Perfil</strong></label><br>
                        @foreach(['convexo'=>'Convexo','recto'=>'Recto','concavo'=>'Cóncavo'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="perfil_facial" id="perfil_{{ $val }}"
                                value="{{ $val }}"
                                {{ old('perfil_facial', $modelo->perfil_facial) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="perfil_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                    </div>

                    {{-- TIPO ESQUELÉTICO (SNA / SNB / ANB) --}}
                    <div class="col-12 fw-bold  m-2"><strong>Tipo Esquelético</strong></div>
                    <table class="table t mb-0 text-center align-middle">
                        <thead>
                            <tr>
                                <th class="align-middle"></th>
                                <th class="align-middle">SNA</th>
                                <th class="align-middle">SNB</th>
                                <th class="align-middle">ANB</th>
                                <th class="align-middle">CLASE I (mm)</th>
                                <th class="align-middle">CLASE II (mm)</th>
                                <th class="align-middle">CLASE III (mm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-end fw-bold">Valor</td>
                                <td>
                                    <input type="number" name="sna" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('sna', $modelo->sna ?? '') }}">
                                </td>
                                <td>
                                    <input type="number" name="snb" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('snb', $modelo->snb ?? '') }}">
                                </td>
                                <td>
                                    <input type="number" name="anb" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('anb', $modelo->anb ?? '') }}">
                                </td>
                                <td>
                                    <input type="number" name="clase1_mm" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('clase1_mm', $modelo->clase1_mm ?? '') }}">
                                </td>
                                <td>
                                    <input type="number" name="clase2_mm" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('clase2_mm', $modelo->clase2_mm ?? '') }}">
                                </td>
                                <td>
                                    <input type="number" name="clase3_mm" class="form-control form-control-sm text-center"
                                        step="0.1" min="0"
                                        value="{{ old('clase3_mm', $modelo->clase3_mm ?? '') }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- ASIMETRÍA FACIAL --}}
                <div class="row gy-2 mb-3">
                    <div class="col-12 fw-bold border-bottom m-2"><strong>Asimetría Facial</strong></div>
                    {{-- Desvío mandibular Sí/No --}}
                    <div class="col-md-4 border-right mr-5">
                        <label class="form-label">Desvío Mandibular</label><br>
                        <input type="hidden" name="desvio_mandibular" value="0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input " type="radio"
                                name="desvio_mandibular" id="desv_si" value="1"
                                {{ old('desvio_mandibular', $modelo->desvio_mandibular) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="desv_si">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="desvio_mandibular" id="desv_no" value="0"
                                {{ old('desvio_mandibular', $modelo->desvio_mandibular) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="desv_no">No</label>
                        </div>
                    </div>

                    {{-- Lado del desvío --}}
                    <div class="col-md-6 ">
                        <label class="form-label"><strong>Lado</strong></label>
                        <div class="d-flex gap-4">
                            {{-- Derecha --}}
                            <div>
                                <div class="form-check mb-1 mr-2">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="desvio_lado_der"
                                        name="desvio_lado_der"
                                        value="1"
                                        {{ old('desvio_lado_der', $modelo->desvio_lado_der ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="desvio_lado_der">
                                        Derecha
                                    </label>
                                </div>
                                <div class="input-group input-group-sm mr-2">
                                    <span class="input-group-text px-3 py-1 rounded-pill mr-1">mm</span>
                                    <input type="number"
                                        step="0.1" min="0"
                                        class="form-control"
                                        id="desvio_mm_der"
                                        name="desvio_mm_der"
                                        value="{{ old('desvio_mm_der', $modelo->desvio_mm_der ?? '') }}"
                                        placeholder="Milímetros">
                                </div>
                            </div>

                            {{-- Izquierda --}}
                            <div>
                                <div class="form-check mb-1 ml-3">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="desvio_lado_izq"
                                        name="desvio_lado_izq"
                                        value="1"
                                        {{ old('desvio_lado_izq', $modelo->desvio_lado_izq ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="desvio_lado_izq">
                                        Izquierda
                                    </label>
                                </div>
                                <div class="input-group input-group-sm ml-3">
                                    <span class="input-group-text px-3 py-1 rounded-pill mr-1">mm</span>
                                    <input type="number"
                                        step="0.1" min="0"
                                        class="form-control"
                                        id="desvio_mm_izq"
                                        name="desvio_mm_izq"
                                        value="{{ old('desvio_mm_izq', $modelo->desvio_mm_izq ?? '') }}"
                                        placeholder="Milímetros">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tipo de cara --}}
                <div class="row">
                    <div class="col-md-12 m-2 p-1 mb-4 border-top">
                        <label class="form-label">Tipo de Cara</label><br>
                        @foreach(['mesoprosopo'=>'Mesoprosopo','euriprosopo'=>'Euriprosopo','leptoprosopo'=>'Leptoprosopo'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="tipo_cara" id="cara_{{ $val }}" value="{{ $val }}"
                                {{ old('tipo_cara', $modelo->tipo_cara) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="cara_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Labios --}}
                <div class="row gy-2">
                    <div class="col-12 fw-bold border-bottom "><strong>Labios</strong></div>
                    @foreach([['labio_superior','Labio Superior'],['labio_inferior','Labio Inferior']] as [$campo,$etq])
                    <div class="col-md-12 m-2 p-2">
                        <label class="form-label p-2">{{ $etq }}</label><br>
                        @foreach(['normal'=>'Normal','proquelia'=>'Proquelia','retroquelia'=>'Retroquelia','fisura'=>'Fisura'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="{{ $campo }}" id="{{ $campo }}_{{ $val }}" value="{{ $val }}"
                                {{ old($campo, $modelo->$campo) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $campo }}_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ─────────────────────────  EXAMEN INTRAORAL  ───────────────────────── --}}
        @php
        $denticiones = [
        'temporal' => 'Dentición Temporal',
        'mixta' => 'Dentición Mixta',
        'permanente' => 'Dentición Permanente',
        ];
        $niveles = [
        '' => '--',
        'leve' => 'Leve',
        'moderado' => 'Moderado',
        'severo' => 'Severo',
        ];
        @endphp
        {{-- Tabla Examen Intraoral 🆗--}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Examen Intraoral</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center"></th>
                            <th colspan="2" class="align-middle text-center">Apiñamiento</th>
                            <th colspan="2" class="align-middle text-center">Diastemas</th>
                        </tr>
                        <tr>
                            <th class="text-center">Sup.</th>
                            <th class="text-center">Inf.</th>
                            <th class="text-center">Sup.</th>
                            <th class="text-center">Inf.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start">Valor</td>
                            <td>
                                <select name="api_sup" class="form-select form-select-sm">
                                    @foreach($niveles as $k => $op)
                                    <option value="{{ $k }}" {{ old('api_sup', $modelo->api_sup ?? '') === $k ? 'selected' : '' }}>
                                        {{ $op }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="api_inf" class="form-select form-select-sm">
                                    @foreach($niveles as $k => $op)
                                    <option value="{{ $k }}" {{ old('api_inf', $modelo->api_inf ?? '') === $k ? 'selected' : '' }}>
                                        {{ $op }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="dias_sup" class="form-select form-select-sm">
                                    @foreach($niveles as $k => $op)
                                    <option value="{{ $k }}" {{ old('dias_sup', $modelo->dias_sup ?? '') === $k ? 'selected' : '' }}>
                                        {{ $op }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="dias_inf" class="form-select form-select-sm">
                                    @foreach($niveles as $k => $op)
                                    <option value="{{ $k }}" {{ old('dias_inf', $modelo->dias_inf ?? '') === $k ? 'selected' : '' }}>
                                        {{ $op }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        {{-- Radios dentición --}}
                        <div class="row">
                            <div class="col-md-12 m-2 d-flex justify-content-center">
                                <label class="form-label m-2 "><strong>Tipo de Dentición:</strong></label>
                                <div>
                                    @foreach($denticiones as $valor => $label)
                                    <div class="form-check form-check-inline p-2 mr-5">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="denticion"
                                            id="denticion_{{ $valor }}"
                                            value="{{ $valor }}"
                                            {{ old('denticion', $modelo->denticion ?? '') === $valor ? 'checked' : '' }}>
                                        <label class="form-check-label" for="denticion_{{ $valor }}">{{ $label }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>

                {{-- Agenesia --}}
                <div class="row m-2 pb-4">
                    <div class="col-md-4 border-right ml-2">
                        <label class="form-label"><strong>Agenesia</strong></label><br>
                        <input type="hidden" name="agenesia" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="agenesia" id="ag_{{ $val }}" value="{{ $val }}"
                                {{ old('agenesia', $modelo->agenesia) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="ag_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                        <input type="text" name="agenesia_cual" class="form-control form-control-sm mt-1"
                            placeholder="¿Cuál?"
                            value="{{ old('agenesia_cual', $modelo->agenesia_cual) }}">
                    </div>

                    {{-- Hipoplasia --}}
                    <div class="col-md-4 border-right ml-3">
                        <label class="form-label"><strong>Hipoplasia</strong></label><br>
                        <input type="hidden" name="hipoplasia" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="hipoplasia" id="hip_{{ $val }}" value="{{ $val }}"
                                {{ old('hipoplasia', $modelo->hipoplasia) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="hip_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                        <input type="text" name="hipoplasia_cual" class="form-control form-control-sm mt-1"
                            placeholder="¿Cuál?"
                            value="{{ old('hipoplasia_cual', $modelo->hipoplasia_cual) }}">
                    </div>

                    {{-- Pigmentaciones --}}
                    <div class="col-md-2 ml-4">
                        <label class="form-label"><strong>Pigmentaciones</strong></label><br>
                        <input type="hidden" name="pigmentaciones" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="pigmentaciones" id="pig_{{ $val }}" value="{{ $val }}"
                                {{ old('pigmentaciones', $modelo->pigmentaciones) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="pig_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Dientes en erupción y ausentes --}}
                <div class="row m-2 p-2 border-top ">
                    <div class="col-md-6 border-right">
                        <label for=""><strong>Dientes en erupcion</strong></label>
                        <input type="text"
                            class="form-control "
                            id="dientes_erupcion"
                            name="dientes_erupcion"
                            value="{{ old('dientes_erupcion', $modelo->dientes_erupcion) }}">
                    </div>

                    <div class="col-md-6">
                        <label for=""><strong>Dientes ausentes</strong></label>
                        <input type="text"
                            class="form-control"
                            id="dientes_ausentes"
                            name="dientes_ausentes"
                            value="{{ old('dientes_ausentes', $modelo->dientes_ausentes) }}">
                    </div>
                </div>

                {{-- Mordida Cruzada --}}
                <div class="row m-2 p-2 border-top ">
                    <div class="col-md-6 border-right">
                        <label class="form-label m-2"><strong>Mordida Cruzada</strong></label><br>
                        <input type="hidden" name="mordida_cruzada" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline m-2">
                            <input class="form-check-input" type="radio"
                                name="mordida_cruzada" id="mc_{{ $val }}" value="{{ $val }}"
                                {{ old('mordida_cruzada', $modelo->mordida_cruzada) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="mc_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach

                        <div class="mt-2">
                            <label class="form-label m-2"><strong>Tipo</strong></label><br>
                            @foreach(['anterior'=>'Anterior','posterior'=>'Posterior'] as $val=>$txt)
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio"
                                    name="mordida_cruzada_tipo" id="mct_{{ $val }}" value="{{ $val }}"
                                    {{ old('mordida_cruzada_tipo', $modelo->mordida_cruzada_tipo) == $val ? 'checked' : '' }}>
                                <label class="form-check-label" for="mct_{{ $val }}">{{ $txt }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-1">
                            <label class="form-label m-2"><strong>Lado</strong></label><br>
                            @foreach(['unilateral'=>'Unilateral','bilateral'=>'Bilateral'] as $val=>$txt)
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio"
                                    name="mordida_cruzada_lado" id="mcl_{{ $val }}" value="{{ $val }}"
                                    {{ old('mordida_cruzada_lado', $modelo->mordida_cruzada_lado) == $val ? 'checked' : '' }}>
                                <label class="form-check-label" for="mcl_{{ $val }}">{{ $txt }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Mordida Abierta --}}
                    <div class="col-md-6 pb-3">
                        <label class="form-label m-2"><strong>Mordida Abierta</strong></label><br>
                        <input type="hidden" name="mordida_abierta" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline m-2">
                            <input class="form-check-input" type="radio"
                                name="mordida_abierta" id="ma_{{ $val }}" value="{{ $val }}"
                                {{ old('mordida_abierta', $modelo->mordida_abierta) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="ma_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach

                        <div class="mt-2">
                            <label class="form-label m-2"><strong>Tipo</strong></label><br>
                            @foreach(['anterior'=>'Anterior','posterior'=>'Posterior'] as $val=>$txt)
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio"
                                    name="mordida_abierta_tipo" id="mat_{{ $val }}" value="{{ $val }}"
                                    {{ old('mordida_abierta_tipo', $modelo->mordida_abierta_tipo) == $val ? 'checked' : '' }}>
                                <label class="form-check-label" for="mat_{{ $val }}">{{ $txt }}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-1">
                            <label class="form-label m-2"><strong>Lado</strong></label><br>
                            @foreach(['unilateral'=>'Unilateral','bilateral'=>'Bilateral'] as $val=>$txt)
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio"
                                    name="mordida_abierta_lado" id="mal_{{ $val }}" value="{{ $val }}"
                                    {{ old('mordida_abierta_lado', $modelo->mordida_abierta_lado) == $val ? 'checked' : '' }}>
                                <label class="form-check-label" for="mal_{{ $val }}">{{ $txt }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class=" m-2 p-2 border-top pb-4">
                    <div class="row m-2 pb-4">
                        {{-- Rotación --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><strong>Rotación</strong></label>
                            <input type="text"
                                name="rotacion"
                                class="form-control form-control-sm mb-2"
                                placeholder="Rotación"
                                value="{{ old('rotacion', $modelo->rotacion ?? '') }}">
                        </div>
                        {{-- Intrusión --}}
                        <div class="col-md-4">
                            <label class="form-label"><strong>Intrusión</strong></label>
                            <input type="text"
                                name="intrusion"
                                class="form-control form-control-sm"
                                placeholder="Intrusión"
                                value="{{ old('intrusion', $modelo->intrusion ?? '') }}">
                        </div>
                        {{-- Extrusión --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><strong>Extrusión</strong></label>
                            <input type="text"
                                name="extrusion"
                                class="form-control form-control-sm mb-2"
                                placeholder="Extrusión"
                                value="{{ old('extrusion', $modelo->extrusion ?? '') }}">
                        </div>
                    </div>
                    <div class="row m-2 pb-4">
                        {{-- Transposición --}}
                        {{-- Gresión --}}
                        <div class="col-md-4">
                            <label class="form-label"><strong>Gresión</strong></label>
                            <input type="text"
                                name="gresion"
                                class="form-control form-control-sm"
                                placeholder="Gresión"
                                value="{{ old('gresion', $modelo->gresion ?? '') }}">
                        </div>

                        {{-- Versión --}}
                        <div class="col-md-4">
                            <label class="form-label"><strong>Versión</strong></label>
                            <input type="text"
                                name="version"
                                class="form-control form-control-sm"
                                placeholder="Versión"
                                value="{{ old('version', $modelo->version ?? '') }}">
                        </div>

                        {{-- Migración --}}
                        <div class="col-md-4">
                            <label class="form-label"><strong>Migración</strong></label>
                            <input type="text"
                                name="migracion"
                                class="form-control form-control-sm"
                                placeholder="Migración"
                                value="{{ old('migracion', $modelo->migracion ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- Retención --}}
                <div class="row m-2 pb-4">
                    <div class="col-md-12">
                        <label class="form-label"><strong>Retención</strong></label><br>
                        <input type="hidden" name="retencion" value="0">
                        @foreach([1=>'Sí',0=>'No'] as $val=>$txt)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="retencion" id="ret_{{ $val }}" value="{{ $val }}"
                                {{ old('retencion', $modelo->retencion) == $val ? 'checked' : '' }}>
                            <label class="form-check-label" for="ret_{{ $val }}">{{ $txt }}</label>
                        </div>
                        @endforeach
                        <input type="text" name="retencion_cual" class="form-control form-control-sm mt-1"
                            placeholder="¿Cuál?"
                            value="{{ old('retencion_cual', $modelo->retencion_cual) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ───────────────────  CLASIFICACIÓN DE ANGLE, OVERJET, OVERBITE  🆗─────────────────── --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                Clasificación de Angle y Canina
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-striped">
                    <table class="table table-bordered text-center mb-0">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2">Relación</th>
                                <th scope="col" colspan="3">Derecha</th>
                                <th scope="col" colspan="3">Izquierda</th>
                            </tr>
                            <tr></tr>
                            <tr>
                                <th>Clase</th>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="fw-bold text-start">Canina</th>
                                @foreach(['der', 'izq'] as $lado)
                                @foreach([1, 2, 3] as $clase)
                                <td>
                                    <input type="number"
                                        name="canina_{{ $lado }}_clase{{ $clase }}"
                                        class="form-control form-control-sm text-center"
                                        min="0"
                                        value="{{ old('canina_' . $lado . '_clase' . $clase, $modelo->{'canina_' . $lado . '_clase' . $clase} ?? '') }}">
                                </td>
                                @endforeach
                                @endforeach
                            </tr>

                            <tr>
                                <th class="fw-bold text-start">Molar</th>
                                @foreach(['der', 'izq'] as $lado)
                                @foreach([1, 2, 3] as $clase)
                                <td>
                                    <input type="number"
                                        name="molar_{{ $lado }}_clase{{ $clase }}"
                                        class="form-control form-control-sm text-center"
                                        min="0"
                                        value="{{ old('molar_' . $lado . '_clase' . $clase, $modelo->{'molar_' . $lado . '_clase' . $clase} ?? '') }}">
                                </td>
                                @endforeach
                                @endforeach
                            </tr>
                            @php
                            $overjet_tipos = [
                            'normal' => 'NORMAL (2 a 3 mm)',
                            'aumentado' => 'AUMENTADO',
                            'borde' => 'BORDE A BORDE',
                            'invertido' => 'INVERTIDO',
                            ];
                            $overbite_tipos = [
                            'mordida_abierta' => 'MORDIDA ABIERTA',
                            'corona_clinica' => 'CORONA CLÍNICA (A)',
                            'sobremordida' => 'SOBREMORDIDA',
                            ];
                            // Para igualar el número de filas en ambas columnas
                            $max_filas = max(count($overjet_tipos), count($overbite_tipos));
                            $overjet_labels = array_values($overjet_tipos);
                            $overjet_keys = array_keys($overjet_tipos);
                            $overbite_labels = array_values($overbite_tipos);
                            $overbite_keys = array_keys($overbite_tipos);
                            @endphp

                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Sobre mordida horizontal <br>(Overjet)</th>
                                        <th colspan="2" class="text-center">Sobre mordida vertical <br>(Overbite)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < $max_filas; $i++)
                                        <tr>
                                        {{-- Overjet --}}
                                        <th class="text-start" style="width: 220px;">
                                            {{ $overjet_labels[$i] ?? '' }}
                                        </th>
                                        <td style="width: 140px;">
                                            @if(isset($overjet_keys[$i]))
                                            <div class="d-flex align-items-center">
                                                <input
                                                    type="number"
                                                    step="0.1"
                                                    min="0"
                                                    class="form-control form-control-sm text-center mx-2"
                                                    name="overjet_{{ $overjet_keys[$i] }}"
                                                    value="{{ old('overjet_' . $overjet_keys[$i], $modelo->{'overjet_' . $overjet_keys[$i]} ?? '') }}"
                                                    style="max-width: 80px;">
                                                <span>mm</span>
                                            </div>
                                            @endif
                                        </td>
                                        {{-- Overbite --}}
                                        <th class="text-start" style="width: 220px;">
                                            {{ $overbite_labels[$i] ?? '' }}
                                        </th>
                                        <td style="width: 140px;">
                                            @if(isset($overbite_keys[$i]))
                                            <div class="d-flex align-items-center">
                                                <input
                                                    type="number"
                                                    step="0.1"
                                                    min="0"
                                                    class="form-control form-control-sm text-center mx-2"
                                                    name="overbite_{{ $overbite_keys[$i] }}"
                                                    value="{{ old('overbite_' . $overbite_keys[$i], $modelo->{'overbite_' . $overbite_keys[$i]} ?? '') }}"
                                                    style="max-width: 80px;">
                                                <span>mm</span>
                                            </div>
                                            @endif
                                        </td>
                                        </tr>
                                        @endfor
                                </tbody>
                            </table>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ───────  INCLINACIÓN MOLAR  --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between">
                <span>Inclinación Molar&nbsp;VL</span>
                <span>Desviación Línea Media Dentaria</span>
                <span>Plano Terminal</span>
            </div>
            <div class="card-body p-0">
                {{-- ── Tabla inclinación molar VL ── --}}
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th colspan="9" class="border-right">DERECHA</th>
                                <th colspan="9">IZQUIERDA</th>
                            </tr>
                            <tr>
                                @for ($i = 0; $i < 2; $i++)
                                    <th>+</th>
                                    <th>N</th>
                                    <th>-</th>
                                    <th>+</th>
                                    <th>N</th>
                                    <th>-</th>
                                    <th>+</th>
                                    <th>N</th>
                                    <th class="border-right">-</th>
                                    @endfor
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ♦♦♦ Fila 1  (arcada superior) ♦♦♦ ------------------------------------}}
                            <tr>@foreach([8,7,6,8,7,6] as $d) <td colspan="3">{{ $d }}</td> @endforeach</tr>
                            <tr>
                                {{-- Derecha superior --}}
                                @foreach([8,7,6] as $d)
                                @foreach(['+','N','-'] as $s)
                                <td>
                                    <input type="radio"
                                        name="fila1_derecha_{{ $d }}"
                                        value="{{ $s }}"
                                        {{ old("fila1_derecha_$d", $modelo?->{"fila1_derecha_$d"}) == $s ? 'checked' : '' }}>
                                </td>
                                @endforeach
                                @endforeach

                                {{-- Izquierda superior --}}
                                @foreach([6,7,8] as $d) {{-- espejo --}}
                                @foreach(['+','N','-'] as $s)
                                <td>
                                    <input type="radio"
                                        name="fila1_izquierda_{{ $d }}"
                                        value="{{ $s }}"
                                        {{ old("fila1_izquierda_$d", $modelo?->{"fila1_izquierda_$d"}) == $s ? 'checked' : '' }}>
                                </td>
                                @endforeach
                                @endforeach
                            </tr>

                            {{-- ♦♦♦ Fila 2  (arcada inferior) ♦♦♦ ------------------------------------}}
                            <tr>@foreach([8,7,6,8,7,6] as $d) <td colspan="3">{{ $d }}</td> @endforeach</tr>
                            <tr>
                                {{-- Derecha inferior --}}
                                @foreach([8,7,6] as $d)
                                @foreach(['+','N','-'] as $s)
                                <td>
                                    <input type="radio"
                                        name="fila2_derecha_{{ $d }}"
                                        value="{{ $s }}"
                                        {{ old("fila2_derecha_$d", $modelo?->{"fila2_derecha_$d"}) == $s ? 'checked' : '' }}>
                                </td>
                                @endforeach
                                @endforeach

                                {{-- Izquierda inferior --}}
                                @foreach([6,7,8] as $d)
                                @foreach(['+','N','-'] as $s)
                                <td>
                                    <input type="radio"
                                        name="fila2_izquierda_{{ $d }}"
                                        value="{{ $s }}"
                                        {{ old("fila2_izquierda_$d", $modelo?->{"fila2_izquierda_$d"}) == $s ? 'checked' : '' }}>
                                </td>
                                @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                @for ($i = 0; $i < 2; $i++)
                                    <th>+</th>
                                    <th>N</th>
                                    <th>-</th>
                                    <th>+</th>
                                    <th>N</th>
                                    <th>-</th>
                                    <th>+</th>
                                    <th>N</th>
                                    <th>-</th>
                                    @endfor
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- ── DESVIACION LINEA MEDIA ── --}}
                <div class="row g-3 p-3">
                    <div class="col-md-6 border-right ">
                        {{-- Desviación Línea Media Dentaria --}}
                        <h6 class="fw-bold mb-4 border-bottom p-3"><strong>Desviación Línea Media Dentaria</strong></h6>
                        @foreach(['sup'=>'Superior','inf'=>'Inferior'] as $arc=>$etq)
                        <div class="mb-2 row align-items-center">
                            <label class="col-auto"><strong>{{ $etq }}</strong></label>
                            <div class="col-auto">
                                <label class="me-1">D</label>
                                <input type="number" step="0.1" min="0" name="midline_{{ $arc }}_derecha"
                                    class="form-control form-control-sm d-inline-block" style="width:80px"
                                    value="{{ old('midline_'.$arc.'_derecha', $modelo->{'midline_'.$arc.'_derecha'} ?? '') }}">
                                <span class="ms-1">mm</span>
                            </div>
                            <div class="col-auto">
                                <label class="me-1">I</label>
                                <input type="number" step="0.1" min="0" name="midline_{{ $arc }}_izquierda"
                                    class="form-control form-control-sm d-inline-block" style="width:80px"
                                    value="{{ old('midline_'.$arc.'_izquierda', $modelo->{'midline_'.$arc.'_izquierda'} ?? '') }}">
                                <span class="ms-1">mm</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Plano terminal --}}
                    <div class="col-md-6">
                        <h6 class="fw-bold border-bottom mb-3 p-3"><strong>Plano Terminal (dentición temporal)</strong></h6>
                        @foreach(['plano_mesial_mm'=>'Mesial','plano_distal_mm'=>'Distal','plano_neutro_mm'=>'Neutro'] as $campo=>$etq)
                        <div class="m-3">
                            <label class="m-2"><strong>{{ $etq }}</strong></label>
                            <input type="number" step="0.1" min="0" name="{{ $campo }}"
                                class="form-control form-control-sm d-inline-block" style="width:100px"
                                value="{{ old($campo, $modelo->$campo) }}"> mm
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        {{-- ─────────────────────────  EXAMEN RADIOGRÁFICO  ───────────────────────── --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Examen Radiográfico</div>
            <div class="card-body p-0">

                <div class="card-body p-0">
                    @php
                    $hallazgos = [
                    [
                    'name' => 'perdida_osea',
                    'label' => 'Pérdida ósea',
                    'vertical' => 'perdida_osea_vertical_mm',
                    'horizontal' => 'perdida_osea_horizontal_mm'
                    ],
                    [
                    'name' => 'dilaceracion_radicular',
                    'label' => 'Dilaceración radicular',
                    'cual' => 'dilaceracion_cual'
                    ],
                    [
                    'name' => 'reabsorcion_radicular',
                    'label' => 'Reabsorción radicular',
                    'cual' => 'reabsorcion_cual'
                    ],
                    [
                    'name' => 'rarefaccion',
                    'label' => 'Rarefacción',
                    'zona' => 'rarefaccion_zona'
                    ],
                    [
                    'name' => 'conductos_radicular',
                    'label' => 'Conductos radicular',
                    'cual' => 'conductos_cual'
                    ],
                    [
                    'name' => 'longitud_radicular_disminuida',
                    'label' => 'Longitud radicular disminuida',
                    'cual' => 'longitud_cual'
                    ],
                    [
                    'name' => 'retenedor_intrarradicular',
                    'label' => 'Retenedor intrarradicular',
                    'cual' => 'retenedor_cual'
                    ],
                    [
                    'name' => 'implante',
                    'label' => 'Implante',
                    'zona' => 'implante_zona'
                    ]
                    ];
                    @endphp

                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Hallazgo</th>
                                <th>SÍ</th>
                                <th>NO</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hallazgos as $h)
                            <tr>
                                <td>{{ $h['label'] }}</td>
                                <td class="text-center">
                                    <input type="hidden" name="{{ $h['name'] }}" value="0">
                                    <input type="radio" name="{{ $h['name'] }}" value="1"
                                        {{ old($h['name'], $modelo->{$h['name']}) == 1 ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="{{ $h['name'] }}" value="0"
                                        {{ old($h['name'], $modelo->{$h['name']}) == 0 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @if(isset($h['vertical']) || isset($h['horizontal']))
                                    <div class="mb-1">
                                        <input type="number" step="0.1" min="0"
                                            name="{{ $h['vertical'] }}"
                                            class="form-control mb-1"
                                            placeholder="Vertical (mm)"
                                            value="{{ old($h['vertical'], $modelo->{$h['vertical']} ?? '') }}">
                                    </div>
                                    <div>
                                        <input type="number" step="0.1" min="0"
                                            name="{{ $h['horizontal'] }}"
                                            class="form-control"
                                            placeholder="Horizontal (mm)"
                                            value="{{ old($h['horizontal'], $modelo->{$h['horizontal']} ?? '') }}">
                                    </div>
                                    @elseif(isset($h['cual']))
                                    <input type="text"
                                        name="{{ $h['cual'] }}"
                                        class="form-control"
                                        placeholder="¿Cuál?"
                                        value="{{ old($h['cual'], $modelo->{$h['cual']} ?? '') }}">
                                    @elseif(isset($h['zona']))
                                    <input type="text"
                                        name="{{ $h['zona'] }}"
                                        class="form-control"
                                        placeholder="Zona"
                                        value="{{ old($h['zona'], $modelo->{$h['zona']} ?? '') }}">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>

                {{-- Observaciones --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="editor_obsRadio" class="form-label">Observaciones:</label>

                        <textarea name="observ_radiografico"
                            id="editor_obsRadio"
                            class="form-control"
                            rows="10"
                            style="width: 100%;">
                        {{ old('observ_radiografico', $modelo->observ_radiografico ?? '') }}
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2">
                <a href="{{ route('admin.pacientes.show', $paciente) }}" class="btn btn-secondary m-2"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                <button type="submit" class="btn btn-success  m-2"><i class="fa-solid fa-cloud"></i> Guardar Valoración</button>
            </div>
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