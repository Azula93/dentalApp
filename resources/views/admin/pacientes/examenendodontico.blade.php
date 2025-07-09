@extends('layouts.admin')

@section('content')
@php
// Mapeos etiqueta → columna
$sup = [
'OTROS' => 'otros_superior',
'MOVILIDAD' => 'movilidad_superior',
'PALPACIÓN' => 'palpacion_superior',
'PERCUSIÓN' => 'percusion_superior',
'FÍSTULA' => 'fistula_superior',
'REACCIÓN AL CALOR' => 'calor_superior',
'REACCIÓN AL FRÍO' => 'frio_superior',
'REACCIÓN ELECTRICIDAD' => 'electricidad_superior',
'CAMBIO DE COLOR' => 'color_superior',
'PRUEBA CAVITARIA' => 'cavitaria_superior',
'TRAUMA OCLUSAL' => 'trauma_superior',
'PRONÓSTICO INICIAL' => 'pronostico_superior',
];

$inf = [
'OTROS' => 'otros_inferior',
'MOVILIDAD' => 'movilidad_inferior',
'PALPACIÓN' => 'palpacion_inferior',
'PERCUSIÓN' => 'percusion_inferior',
'FÍSTULA' => 'fistula_inferior',
'REACCIÓN AL CALOR' => 'calor_inferior',
'REACCIÓN AL FRÍO' => 'frio_inferior',
'REACCIÓN ELECTRICIDAD' => 'electricidad_inferior',
'CAMBIO DE COLOR' => 'color_inferior',
'PRUEBA CAVITARIA' => 'cavitaria_inferior',
'TRAUMA OCLUSAL' => 'trauma_inferior',
'PRONÓSTICO INICIAL' => 'pronostico_inferior',
];
@endphp

<div class="container-fluid">
    <h1 class="p-3 text-center ">
        Exámen Endodóntico <br>
        {{ $paciente->nombres }} {{ $paciente->apellidos }}
    </h1>

    <form method="POST" action="{{ route('admin.pacientes.examenendodontico.update', $paciente) }}">
        @csrf
        @method('PUT')

        {{-- === Fecha del examen === --}}
        <div class="row mb-4">
            <label for="fecha" class="col-md-2 col-form-label fw-semibold">Fecha</label>
            <div class="col-md-4">
                <input type="date"
                    id="fecha"
                    name="fecha"
                    class="form-control"
                    value="{{ old('fecha', optional($examenendodontico)->fecha?->format('Y-m-d')) }}"
                    required>
            </div>
        </div>

        {{-- === Bloque SUPERIOR === --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header text-white" style="background:#6f5fc9;">
                <h5 class="mb-0">ARCADA SUPERIOR</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($sup as $label => $col)
                        <tr>
                            <td style="width:25%" class="fw-semibold">{{ $label }}</td>
                            <td>
                                <textarea name="{{ $col }}"
                                    class="form-control"
                                    rows="2">{{ old($col, $examenendodontico->$col ?? '') }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- === Bloque INFERIOR === --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header text-white" style="background:#6f5fc9;">
                <h5 class="mb-0">ARCADA INFERIOR</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($inf as $label => $col)
                        <tr>
                            <td style="width:25%" class="fw-semibold">{{ $label }}</td>
                            <td>
                                <textarea name="{{ $col }}"
                                    class="form-control"
                                    rows="2">{{ old($col, $examenendodontico->$col ?? '') }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <a href="{{ route('admin.pacientes.show', $paciente->id) }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
            <button class="btn btn-primary">
                <i class="fa-solid fa-cloud"></i> Guardar examen endodóntico
            </button>
        </div>
    </form>

    <hr class="m-4 ">

    @php
    // Etiquetas ↔ columna BD
    $sup = [
    'OTROS' => 'otros',
    'CÁLCULOS' => 'calculos_superior',
    'SENSIBILIDAD' => 'sensibilidad_superior',
    'TRAUMA' => 'trauma_superior',
    'FURCA' => 'furca_superior',
    'BOLSA' => 'bolsa_superior',
    'MOVILIDAD' => 'movilidad_superior',
    'EXUDADO' => 'exudado_superior',
    'HEMORRAGIA' => 'hemorragia_superior',
    'AGRANDAMIENTO G.' => 'agrandamientoG_superior',
    'RETRACCIÓN' => 'retraccion_superior',
    'BIOTIPO' => 'biotipo_superior',
    'PRONÓSTICO' => 'pronostico_superior',
    ];
    $inf = [
    'OTROS' => 'otros_inferior',
    'CÁLCULOS' => 'calculos_inferior',
    'SENSIBILIDAD' => 'sensibilidad_inferior',
    'TRAUMA' => 'trauma_inferior',
    'FURCA' => 'furca_inferior',
    'BOLSA' => 'bolsa_inferior',
    'MOVILIDAD' => 'movilidad_inferior',
    'EXUDADO' => 'exudado_inferior',
    'HEMORRAGIA' => 'hemorragia_inferior',
    'AGRANDAMIENTO G.' => 'agrandamientoG_inferior',
    'RETRACCIÓN' => 'retraccion_inferior',
    'BIOTIPO' => 'biotipo_inferior',
    'PRONÓSTICO' => 'pronostico_inferior',
    ];
    @endphp

    <div class="container-fluid">
        <h1 class="p-3 text-center">
            Examen periodontal <br> {{ $paciente->nombres }} {{ $paciente->apellidos }}
        </h1>

        <form method="POST" action="{{ route('admin.pacientes.examenperiodontal.update', $paciente) }}">
            @csrf
            @method('PUT')

            {{-- === Fecha del examen periodontal === --}}

            {{-- —— Arcada superior —— --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-white" style="background:#09da83;">
                    <h5 class="mb-0">ARCADA SUPERIOR</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            @foreach ($sup as $label => $col)
                            <tr>
                                <td style="width:28%" class="fw-semibold">{{ $label }}</td>
                                <td>
                                    <textarea name="{{ $col }}" class="form-control"
                                        rows="2">{{ old($col, $examenenperiodontal->$col ?? '') }}</textarea>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- —— Arcada inferior —— --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-white" style="background:#09da83;">
                    <h5 class="mb-0">ARCADA INFERIOR</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <tbody>
                            @foreach ($inf as $label => $col)
                            <tr>
                                <td style="width:28%" class="fw-semibold">{{ $label }}</td>
                                <td>
                                    <textarea name="{{ $col }}" class="form-control"
                                        rows="2">{{ old($col, $examenenperiodontal->$col ?? '') }}</textarea>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2 ">
                <a href="{{ route('admin.pacientes.show', $paciente->id) }}" class="btn btn-secondary mb-3">
                    <i class="fa-solid fa-arrow-left"></i> Regresar
                </a>
                <button class="btn btn-primary mb-3">
                    <i class="fa-solid fa-cloud"></i> Guardar examen periodontal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection