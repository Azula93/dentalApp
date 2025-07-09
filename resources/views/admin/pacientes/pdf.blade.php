{{-- resources/views/admin/pacientes/pdf.blade.php --}}

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ficha del Paciente</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1,
        h5 {
            text-align: center;
            color: #333;
            margin: 0 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        .section-title {
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 6px;
            margin-top: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            width: 50%;
            padding: 6px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <h1>Ficha del Paciente: {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>

    {{-- DATOS PERSONALES --}}
    <div class="section-title">Datos Personales</div>
    <table>
        <tbody>
            <tr>
                <td><strong># Historia:</strong> {{ $paciente->numero_historia }}</td>
                <td><strong>Documento:</strong> {{ $paciente->di }}</td>
            </tr>
            <tr>
                <td><strong>Edad:</strong> {{ $paciente->edad }}</td>
                <td><strong>Fecha Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</td>
            </tr>
            <tr>
                <td><strong>Estado Civil:</strong> {{ $paciente->estado_civil }}</td>
                <td><strong>Sexo:</strong> {{ $paciente->sexo }}</td>
            </tr>
            <tr>
                <td><strong>Ocupación:</strong> {{ $paciente->ocupacion }}</td>
                <td><strong>Dirección:</strong> {{ $paciente->direccion_residencia }}</td>
            </tr>
            <tr>
                <td><strong>Teléfono Oficina:</strong> {{ $paciente->telefono_oficina }}</td>
                <td><strong>Celular:</strong> {{ $paciente->celular }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> {{ $paciente->email }}</td>
                <td><strong>EPS:</strong> {{ $paciente->eps }}</td>
            </tr>
            <tr>
                <td><strong>Tipo Vinculación:</strong> {{ $paciente->tipo_vinculacion }}</td>
                <td><strong>Urgencias:</strong> {{ $paciente->servicio_urgencias }}</td>
            </tr>
            <tr>
                <td><strong>Última Visita Odontólogo:</strong> {{ $paciente->ultima_visita_odontologo }}</td>
                <td><strong>Último Tratamiento:</strong> {{ $paciente->ultimo_tratamiento }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>¿Cómo se enteró?:</strong> {{ $paciente->como_se_entero }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Tipo de Sangre:</strong> {{ $paciente->tipo_sangre }}</td>
            </tr>
        </tbody>
    </table>

    {{-- DATOS ACUDIENTE --}}
    <div class="section-title">Datos del Acudiente</div>
    <table>
        <tbody>
            <tr>
                <td><strong>Nombre:</strong> {{ $paciente->acudiente }}</td>
                <td><strong>Parentesco:</strong> {{ $paciente->parentesco }}</td>
            </tr>
            <tr>
                <td><strong>Ocupación:</strong> {{ $paciente->ocupacion_acudiente }}</td>
                <td><strong>Correo:</strong> {{ $paciente->correo_acudiente }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Celular:</strong> {{ $paciente->celular_acudiente }}</td>
            </tr>
        </tbody>
    </table>

    {{-- ANAMNESIS --}}
    <div class="section-title p-2">Anamnesis</div>
    <table class="table table-bordered">
        <tr>
            <th>Motivo de Consulta</th>
            <td>{!! optional($paciente->anamnesis)->motivo_consulta ?? 'No registrado' !!}</td>
        </tr>
        <tr>
            <th>Historia de enfermedad actual</th>
            <td>{!! optional($paciente->anamnesis)->historia_enfermedad_actual ?? 'No registrado' !!}</td>
        </tr>
    </table>

    {{-- ANTECEDENTES MÉDICOS --}}
    @php
    $anteMed = optional($paciente->antecedentesMedicos);
    $checks = [
    ['alergias', 'Alergias'],
    ['fiebre_reumatica', 'Fiebre Reumática'],
    ['trastornos_gastricos', 'Trastornos gástricos'],
    ['tto_farmacologico_actual', 'Tratamiento farmacológico'],
    ['fuma', 'Fuma'],
    ['trastornos_coagulacion', 'Trastornos de coagulación'],
    ['cirugias', 'Cirugías'],
    ['hipertension', 'Hipertensión'],
    ['tto_medico_actual', 'Tratamiento médico actual'],
    ['embarazo', 'Embarazo'],
    ['enf_respiratorias', 'Enfermedades respiratorias'],
    ['enf_renal', 'Enfermedad renal'],
    ['diabetes', 'Diabetes'],
    ['vih_sida', 'VIH/SIDA'],
    ['alteraciones_cardiacas', 'Alteraciones cardiacas'],
    ['hepatitis', 'Hepatitis'],
    ['hospitalizaciones', 'Hospitalizaciones'],
    ['cancer', 'Cáncer'],
    ['otra_patologia', 'Otra patología']
    ];
    @endphp

    <div class="section-title p-2">Antecedentes Médicos Personales</div>
    <table class="table table-bordered">
        <tbody>
            @foreach($checks as [$campo, $label])
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $anteMed->$campo ? 'Sí' : 'No' }}</td>
            </tr>
            @endforeach
            @if($anteMed->antecedentes_personales_otro)
            <tr>
                <td colspan="2"><strong>Otro:</strong> {!! $anteMed->antecedentes_personales_otro !!}</td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- ANTECEDENTES FAMILIARES --}}
    @php
    $familiares = [
    ['fam_cardiovasculares', 'Cardiovasculares'],
    ['fam_oncologicos', 'Oncológicos'],
    ['fam_endocrinos', 'Endócrinos'],
    ['fam_psiquiatricos', 'Psiquiátricos'],
    ['fam_hematologicos', 'Hematológicos'],
    ['fam_neurologicos', 'Neurológicos'],
    ['fam_autoinmunes', 'Autoinmunes'],
    ['fam_otros', 'Otros']
    ];
    @endphp

    <div class="section-title p-2">Antecedentes Médicos Familiares</div>
    <table class="table table-bordered">
        <tbody>
            @foreach($familiares as [$campo, $label])
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $anteMed->$campo ? 'Sí' : 'No' }}</td>
            </tr>
            @endforeach
            @if($anteMed->antecedentes_familiares_otro)
            <tr>
                <td colspan="2"><strong>Otros:</strong> {!! $anteMed->antecedentes_familiares_otro !!}</td>
            </tr>
            @endif
            @if($anteMed->observaciones)
            <tr>
                <td colspan="2"><strong>Observaciones:</strong> {!! $anteMed->observaciones !!}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div style="page-break-inside: avoid;">
        {{-- ANTECEDENTES ODONTOLÓGICOS --}}
        {{-- Información General y Examen Estomatológico --}}
        <div class="section-title">
            Información General y Examen Estomatológico
        </div>
        <table width="100%" border="1" cellspacing="0" cellpadding="6" style="font-size: 12px; text-align: center;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th>Tejido</th>
                    <th>Estado</th>
                    <th>Tejido</th>
                    <th>Estado</th>
                    <th>Hallazgo Articular</th>
                    <th>Sí / No</th>
                </tr>
            </thead>
            <tbody>
                @php
                $fila = [
                ['campo'=>'labios', 'label1'=>'Labios', 'campo2'=>'piso_boca', 'label2'=>'Piso de Boca', 'campo3'=>'ruido_articular', 'label3'=>'Ruido Articular'],
                ['campo'=>'carrillos', 'label1'=>'Carrillos', 'campo2'=>'glandulas_salivares', 'label2'=>'Glándulas Salivales','campo3'=>'dolor_articular', 'label3'=>'Dolor Articular'],
                ['campo'=>'paladar_duro', 'label1'=>'Paladar Duro', 'campo2'=>'orofaringe', 'label2'=>'Orofaringe', 'campo3'=>'dolor_muscular', 'label3'=>'Dolor Muscular'],
                ['campo'=>'lengua', 'label1'=>'Lengua', 'campo2'=>null, 'label2'=>null, 'campo3'=>'alteraciones_movimiento', 'label3'=>'Alteraciones en Movimiento'],
                ];
                $odo = $paciente->odontograma ?? null;
                $badge = fn($v, $ok = 'Normal', $bad = 'Anormal') =>
                $v === 'normal' ? "<span>$ok</span>" :
                ($v === 'anormal' ? "<span>$bad</span>" : "N/A");
                $siNo = fn($v) =>
                $v === 'normal' ? "<span>No</span>" :
                ($v === 'anormal' ? "<span>Sí</span>" : "N/A");
                @endphp

                @foreach($fila as $f)
                <tr>
                    <td style="text-align: left;">{{ $f['label1'] }}</td>
                    <td>{!! $badge(optional($odo)->{$f['campo']} ?? null) !!}</td>
                    <td style="text-align: left;">{{ $f['label2'] ?? '—' }}</td>
                    <td>
                        {!! $f['campo2'] ? $badge(optional($odo)->{$f['campo2']} ?? null) : 'N/A' !!}
                    </td>
                    <td style="text-align: left;">{{ $f['label3'] }}</td>
                    <td>{!! $siNo(optional($odo)->{$f['campo3']} ?? null) !!}</td>
                </tr>
                @endforeach

                {{-- Última visita al odontólogo --}}
                <tr>
                    <td colspan="2" style="text-align: left;"><strong>Última visita al odontólogo:</strong></td>
                    <td colspan="4">
                        @php
                        $fecha = optional($odo)->ultima_visita_odontologo;
                        @endphp
                        {{ $fecha ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : 'N/A' }}
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- Observaciones --}}
        @if(!empty($odo->observaciones_estomatologico))
        <div style="margin-top: 10px;">
            <strong>Observaciones:</strong><br>
            <p>{!! $odo->observaciones_estomatologico !!}</p>
        </div>
        @endif
    </div>
    {{-- Antecedentes Odontológicos --}}
    @php
    $odo = $paciente->odontograma ?? null;
    $higieneMap = ['B' => 'Bueno', 'R' => 'Regular', 'M' => 'Malo'];
    @endphp
    <div style="page-break-inside: avoid;">
        @if($odo)
        <div class="section-title">
            Antecedentes Odontológicos
        </div>

        <table width="100%" border="1" cellspacing="0" cellpadding="6" style="font-size: 12px;">
            <tr>
                <td><strong>1. Higiene Oral</strong></td>
                <td>{{ $higieneMap[$odo->higiene_oral] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>2. Seda Dental</strong></td>
                <td>{{ $odo->seda_dental ? 'Sí' : 'No' }}</td>
            </tr>
            <tr>
                <td><strong>3. Sangrado Gingival y Cálculos</strong></td>
                <td>{{ $odo->sangrado_gingival ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>4. Odontalgia</strong></td>
                <td>
                    {{ $odo->odontalgia ? 'Sí' : 'No' }}
                    @if($odo->odontalgia && $odo->odontalgia_cual)
                    <br><em><strong>¿Cuál?:</strong></em> {{ $odo->odontalgia_cual }}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>5. Frecuencia de Cepillado</strong></td>
                <td>{{ $odo->frecuencia_cepillado ?? 'N/A' }}</td>
            </tr>
        </table>
        @else
        <h4 style="background-color:rgb(207, 198, 203); color: white; padding: 8px; color: #333; text-align: center;">
            No se encontraron antecedentes odontológicos registrados.
        </h4>
        @endif
    </div>

    {{-- Odontograma --}}
    @php
    // Obtén el odontograma del paciente
    $odontograma = $paciente->odontograma;

    // Normalizar y filtrar valores vacíos
    $normalizar = fn(array $arr): array => array_map(fn($v) =>
    is_string($v)
    ? array_values(array_filter(explode(',', $v), fn($i) => $i !== ''))
    : $v
    , $arr);
    $inicial = $normalizar($odontograma->initial ?? []);
    $normalizar($odontograma->initial ?? []);
    $final = $normalizar($odontograma->final ?? []);

    // Mapas
    $herramientas = [
    'amalgama' => 'Amalgama',
    'resina' => 'Resina',
    'diente_ausente' => 'Diente Ausente',
    'endodoncia' => 'Endodoncia',
    'corona' => 'Corona',
    'exodoncia' => 'Exodoncia',
    'caries' => 'Caries',
    'necesidad_endodoncia' => 'Necesidad de Endodoncia',
    'no_erupcionado' => 'No Erupcionado',
    ];

    $cuadrantes = [
    'sup_izq' => array_merge(range(18,11,-1), range(55,51,-1)),
    'sup_der' => array_merge(range(21,28), range(61,65)),
    'inf_izq' => array_merge(range(85,81,-1), range(48,41,-1)),
    'inf_der' => array_merge(range(71,75), range(31,38)),
    ];
    $labels = [
    'sup_izq' => 'Superior Derecho',
    'sup_der' => 'Superior Izquierdo',
    'inf_izq' => 'Inferior Derecho',
    'inf_der' => 'Inferior Izquierdo',
    ];
    @endphp

    <style>
        table.teeth {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        table.teeth th,
        table.teeth td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
            text-align: left;
        }

        table.teeth th {
            background: #f0f0f0;
        }

        .observaciones {
            font-size: 10px;
            margin-top: 1rem;
        }
    </style>

    <h4>Odontograma Inicial</h4>
    <table class="teeth">
        <thead>
            <tr>
                <th>Cuadrante</th>
                <th>Diente</th>
                <th>Hallazgos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuadrantes as $key => $dientes)
            @foreach($dientes as $diente)
            @php $marks = $inicial[$diente] ?? []; @endphp
            <tr>
                <td>{{ $labels[$key] }}</td>
                <td>{{ $diente }}</td>
                <td>
                    @if(count($marks))
                    @foreach($marks as $idx => $m)
                    {{ $herramientas[$m] ?? $m }}@if($idx < count($marks)-1), @endif
                        @endforeach
                        @else
                        —
                        @endif
                        </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <h4>Odontograma Final</h4>
    <table class="teeth">
        <thead>
            <tr>
                <th>Cuadrante</th>
                <th>Diente</th>
                <th>Hallazgos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuadrantes as $key => $dientes)
            @foreach($dientes as $diente)
            @php $marks = $final[$diente] ?? []; @endphp
            <tr>
                <td>{{ $labels[$key] }}</td>
                <td>{{ $diente }}</td>
                <td>
                    @if(count($marks))
                    @foreach($marks as $idx => $m)
                    {{ $herramientas[$m] ?? $m }}@if($idx < count($marks)-1), @endif
                        @endforeach
                        @else
                        —
                        @endif
                        </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="observaciones">
        <h4>Observaciones del Odontograma</h4>
        <p>{!! nl2br(e($odontograma->observaciones_odontograma ?? '— Sin observaciones —')) !!}</p>
    </div>


    {{-- /ODONTOGRAMA --}}

    {{-- VALORACION --}}
    @if($paciente->valoracion)
    @php
    $v = $paciente->valoracion;
    $niveles = ['leve' => 'Leve', 'moderado'=> 'Moderado', 'severo' => 'Severo'];
    $denticiones = ['temporal' => 'Dentición Temporal','mixta' => 'Dentición Mixta','permanente' => 'Dentición Permanente'];
    $siNo = fn($val) => $val ? 'Sí' : 'No';
    $fmt = fn($val) => ($val === null || $val === '') ? '—' : $val;
    @endphp

    <!-- VALORACIÓN ORTODONCIA -->
    <div class="section-title">Valoración Ortodoncia</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th colspan="2" style="background:#f2f2f2;">Ortodoncia Previa</th>
        </tr>
        <tr>
            <td>Ortodoncia previa</td>
            <td>{{ $siNo($v->ortodoncia_previa) }}</td>
        </tr>
        <tr>
            <td>Tiene aparatología</td>
            <td>{{ $siNo($v->tiene_aparatologia) }}</td>
        </tr>
        <tr>
            <td>Tiempo aparatología</td>
            <td>{{ $fmt($v->tiempo_aparatologia) }}</td>
        </tr>
    </table>
    <!-- /VALORACIÓN ORTODONCIA -->

    <!-- EXAMEN FACIAL -->
    <div class="section-title">Examen Facial</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <td>Perfil facial</td>
            <td>{{ ucfirst($fmt($v->perfil_facial)) }}</td>
            <td>SNA</td>
            <td>{{ $fmt($v->sna) }}</td>
        </tr>
        <tr>
            <td>SNB</td>
            <td>{{ $fmt($v->snb) }}</td>
            <td>ANB</td>
            <td>{{ $fmt($v->anb) }}</td>
        </tr>
        <tr>
            <td>Desvío mandibular</td>
            <td>{{ $siNo($v->desvio_mandibular) }}</td>
            <td>Tipo de cara</td>
            <td>{{ ucfirst($fmt($v->tipo_cara)) }}</td>
        </tr>
        <tr>
            <td>Lado derecho</td>
            <td>{{ $v->desvio_lado_der ? "Sí (" . $fmt($v->desvio_mm_der) . " mm)" : '—' }}</td>
            <td>Lado izquierdo</td>
            <td>{{ $v->desvio_lado_izq ? "Sí (" . $fmt($v->desvio_mm_izq) . " mm)" : '—' }}</td>
        </tr>
        <tr>
            <td>Labio superior</td>
            <td>{{ ucfirst($fmt($v->labio_superior)) }}</td>
            <td>Labio inferior</td>
            <td>{{ ucfirst($fmt($v->labio_inferior)) }}</td>
        </tr>
    </table>
    <!-- /EXAMEN FACIAL -->

    <!-- EXAMEN INTRAORAL -->
    <div class="section-title">Examen Intraoral</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th></th>
                <th>Apiñamiento Sup</th>
                <th>Inf</th>
                <th>Diastemas Sup</th>
                <th>Inf</th>
            </tr>
        </thead>
        <tr>
            <td>Valor</td>
            <td>{{ $niveles[$v->api_sup ?? ''] }}</td>
            <td>{{ $niveles[$v->api_inf ?? ''] }}</td>
            <td>{{ $niveles[$v->dias_sup ?? ''] }}</td>
            <td>{{ $niveles[$v->dias_inf ?? ''] }}</td>
        </tr>
    </table>

    <p><strong>Tipo de dentición:</strong> {{ $denticiones[$v->denticion ?? ''] ?? '—' }}</p>

    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Agenesia</th>
            <th>¿Cuál?</th>
            <th>Hipoplasia</th>
            <th>¿Cuál?</th>
            <th>Pigmentaciones</th>
        </tr>
        <tr>
            <td>{{ $siNo($v->agenesia) }}</td>
            <td>{{ $fmt($v->agenesia_cual) }}</td>
            <td>{{ $siNo($v->hipoplasia) }}</td>
            <td>{{ $fmt($v->hipoplasia_cual) }}</td>
            <td>{{ $siNo($v->pigmentaciones) }}</td>
        </tr>
    </table>

    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Dientes en erupción</th>
            <th>Dientes ausentes</th>
        </tr>
        <tr>
            <td>{{ $fmt($v->dientes_erupcion) }}</td>
            <td>{{ $fmt($v->dientes_ausentes) }}</td>
        </tr>
    </table>

    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th colspan="3">Mordida Cruzada</th>
            <th colspan="3">Mordida Abierta</th>
        </tr>
        <tr>
            <td>¿Tiene?</td>
            <td>Tipo</td>
            <td>Lado</td>
            <td>¿Tiene?</td>
            <td>Tipo</td>
            <td>Lado</td>
        </tr>
        <tr>
            <td>{{ $siNo($v->mordida_cruzada) }}</td>
            <td>{{ ucfirst($fmt($v->mordida_cruzada_tipo)) }}</td>
            <td>{{ ucfirst($fmt($v->mordida_cruzada_lado)) }}</td>
            <td>{{ $siNo($v->mordida_abierta) }}</td>
            <td>{{ ucfirst($fmt($v->mordida_abierta_tipo)) }}</td>
            <td>{{ ucfirst($fmt($v->mordida_abierta_lado)) }}</td>
        </tr>
    </table>

    <div style="page-break-inside: avoid;">
        <table width="100%" border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Rotación</th>
                <th>Intrusión</th>
                <th>Extrusión</th>
                <th>Gresión</th>
                <th>Versión</th>
                <th>Migración</th>
            </tr>
            <tr>
                <td>{{ $fmt($v->rotacion) }}</td>
                <td>{{ $fmt($v->intrusion) }}</td>
                <td>{{ $fmt($v->extrusion) }}</td>
                <td>{{ $fmt($v->gresion) }}</td>
                <td>{{ $fmt($v->version) }}</td>
                <td>{{ $fmt($v->migracion) }}</td>
            </tr>
        </table>
    </div>
    <p><strong>Retención:</strong> {{ $siNo($v->retencion) }}{{ $v->retencion_cual ? ' — '.$fmt($v->retencion_cual) : '' }}</p>
    @endif

    <!-- EXAMEN ENDODONTICO -->
    <div class="section-title">Examen Endodontico</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="6" style="margin-bottom: 20px;">

        <tr>
            <td>Fecha Examen</td>

        </tr>
    </table>

    @php
    // Mapeo Procedimiento → columna BD (superior)
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

    // Arcada inferior
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

    // Helper para mostrar guion cuando no hay dato
    $val = fn($campo) => $campo ? nl2br(e($campo)) : '—';
    @endphp

    {{-- ============ Arcada superior ============ --}}
    <div style="font-weight:bold; margin-bottom:4px;">Examen Endodontico Arcada superior</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="6" style="margin-bottom: 15px;">
        <thead style="background-color:#f2f2f2;">
            <tr>
                <th style="width:35%; text-align:left;">Procedimiento</th>
                <th>Observación</th>

            </tr>
        </thead>
        <tbody>
            @foreach($sup as $etq => $col)
            <tr>
                <td style="text-align:left;">{{ $etq }}</td>
                <td>{!! $val($examen->$col ?? null) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ============ Arcada inferior ============ --}}
    <div style="font-weight:bold; margin-bottom:4px;">Examen Endodontico Arcada inferior</div>
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
        <thead style="background-color:#f2f2f2;">
            <tr>
                <th style="width:35%; text-align:left;">Procedimiento</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>

            @foreach($inf as $etq => $col)
            <tr>
                <td style="text-align:left;">{{ $etq }}</td>
                <td>{!! $val($examen->$col ?? null) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- EXAMEN PERIODONTAL -->
    <div class="section-title">Examen periodontal</div>
    @php
    $per = $paciente->examenperiodontals;
    $sup = [
    'OTROS'=>'otros','CÁLCULOS'=>'calculos_superior','SENSIBILIDAD'=>'sensibilidad_superior',
    'TRAUMA'=>'trauma_superior','FURCA'=>'furca_superior','BOLSA'=>'bolsa_superior',
    'MOVILIDAD'=>'movilidad_superior','EXUDADO'=>'exudado_superior','HEMORRAGIA'=>'hemorragia_superior',
    'AGRANDAMIENTO G.'=>'agrandamientoG_superior','RETRACCIÓN'=>'retraccion_superior',
    'BIOTIPO'=>'biotipo_superior','PRONÓSTICO'=>'pronostico_superior',
    ];
    $inf = [
    'OTROS'=>'otros_inferior','CÁLCULOS'=>'calculos_inferior','SENSIBILIDAD'=>'sensibilidad_inferior',
    'TRAUMA'=>'trauma_inferior','FURCA'=>'furca_inferior','BOLSA'=>'bolsa_inferior',
    'MOVILIDAD'=>'movilidad_inferior','EXUDADO'=>'exudado_inferior','HEMORRAGIA'=>'hemorragia_inferior',
    'AGRANDAMIENTO G.'=>'agrandamientoG_inferior','RETRACCIÓN'=>'retraccion_inferior',
    'BIOTIPO'=>'biotipo_inferior','PRONÓSTICO'=>'pronostico_inferior',
    ];
    $val = fn($v)=> $v ? nl2br(e($v)) : '—';
    @endphp

    {{-- Arcada superior --}}
    <strong>Arcada superior</strong>
    <table width="100%" border="1" cellspacing="0" cellpadding="6" style="margin-bottom: 12px;">
        <thead style="background:#f2f2f2;">
            <tr>
                <th width="30%" align="left">Procedimiento</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sup as $lab=>$col)
            <tr>
                <td align="left">{{ $lab }}</td>
                <td>{!! $val($per->$col ?? null) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Arcada inferior --}}
    <strong>Arcada inferior</strong>
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
        <thead style="background:#f2f2f2;">
            <tr>
                <th width="30%" align="left">Procedimiento</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inf as $lab=>$col)
            <tr>
                <td align="left">{{ $lab }}</td>
                <td>{!! $val($per->$col ?? null) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- /EXAMEN ENDODONTICO -->

    <!-- Diagnóstico  -->
    <div class="section-title ">
        Diagnostico HC
    </div>

    @if($paciente->diagnosticoHcs->isEmpty())
    <p style="padding:10px; color: #6c757d;">No hay diagnósticos cargados.</p>
    @else
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <thead style="background-color:#f2f2f2;">
            <tr>
                <th>Procedimiento</th>
                <th>Diagnóstico</th>
                <th>Solución</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paciente->diagnosticoHcs as $d)
            <tr>
                <td>{{ $d->procedimiento }}</td>
                <td>{{ $d->diagnostico ?: '—' }}</td>
                <td>{{ $d->solucion ?: '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h3 class="mt-4">Controles</h3>

    @forelse($paciente->controles as $control)
    <div style="margin-bottom: 1rem;">
        <strong>Fecha consulta:</strong> {{ $control->fecha_consulta }}<br>
        <strong>Doctor:</strong>
        {{ $control->doctor->nombres }} {{ $control->doctor->apellidos }}<br>
        <strong>Descripción:</strong><br>
        {!! nl2br(strip_tags($control->detalle)) !!}
    </div>
    @empty
    <p>Este paciente aún no tiene controles registrados.</p>
    @endforelse


    <div style="margin-top: 50px;">
        <table width="100%">
            <tr>
                <td width="50%" style="text-align: center;">
                    _______________________________<br>
                    Firma Profesional<br>

                </td>
                <td width="50%" style="text-align: center;">
                    <img src="#" width="80" alt="Sello Clínica">
                </td>
            </tr>
        </table>
    </div>


</body>

</html>