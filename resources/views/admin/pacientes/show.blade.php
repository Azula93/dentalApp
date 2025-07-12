@extends('layouts.admin')
@section('content')
<div class="container-fluid p-2">

    <h1 class="p-4 text-center">Ficha del Paciente: {{$paciente -> nombres}} {{$paciente -> apellidos}}</h1>

    <div class="d-flex justify-content-between flex-wrap gap-2">

        <a href="{{url('admin/pacientes')}}" class="btn btn-outline-secondary btn-lg m-3">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>

        <a href="{{ route('admin.pacientes.pdf', $paciente->id) }}" class="btn btn-success btn-lg m-3" target="_blank">
            <i class="fa fa-file-pdf"></i> Generar PDF
        </a>
    </div>


    <div class="card shadow mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <!-- DATOS PERSONALES -->
            <div class="row ">
                <div class="col-md-3 mb-3"> <strong># Historia:</strong> {{$paciente -> numero_historia}}</div>
                <div class="col-md-3 mb-3"><strong>Nombres:</strong> {{$paciente -> nombres}}</div>
                <div class="col-md-3 mb-3"><strong>Apellidos:</strong> {{$paciente -> apellidos}}</div>
                <div class="col-md-3 mb-3"><strong>Documento Identidad:</strong> {{$paciente -> di}}</div>
                <div class="col-md-3 mb-3"><strong>Edad:</strong> {{$paciente -> edad}}</div>
                <div class="col-md-3 mb-3"><strong>Fecha Nacimiento:</strong> {{$paciente -> fecha_nacimiento}}</div>
                <div class="col-md-3 mb-3"><strong>Estado Civil:</strong> {{$paciente -> estado_civil}}</div>
                <div class="col-md-3 mb-3"><strong>Sexo:</strong> {{$paciente -> sexo}}</div>
                <div class="col-md-3 mb-3"><strong>Ocupación:</strong> {{$paciente -> ocupacion}}</div>
                <div class="col-md-3 mb-3"><strong>Dirección Residencia:</strong> {{$paciente -> direccion_residencia}}</div>
                <div class="col-md-3 mb-3"><strong>Teléfono Oficina:</strong> {{$paciente -> telefono_oficina}}</div>
                <div class="col-md-3 mb-3"><strong>Teléfono Celular:</strong> {{$paciente -> celular}}</div>
                <div class="col-md-3 mb-3"><strong>Email:</strong> {{ $paciente ->email}}</div>
                <div class="col-md-3 mb-3"><strong>EPS:</strong> {{$paciente -> eps}}</div>
                <div class="col-md-3 mb-3"><strong>Tipo Vinculación:</strong> {{$paciente -> tipo_vinculacion}}</div>
                <div class="col-md-3 mb-3"><strong>Servicio de urgencias:</strong> {{$paciente -> servicio_urgencias}}</div>
                <div class="col-md-3 mb-3"><strong>Última Visita Odontologo:</strong> {{$paciente -> ultima_visita_odontologo}}</div>
                <div class="col-md-3 mb-3"><strong>Último Tratamiento:</strong> {{$paciente -> ultimo_tratamiento}}</div>
                <div class="col-md-3 mb-3"><strong>Como se enteró de nuestra clínica:</strong> {{$paciente -> como_se_entero}}</div>
                <div class="col-md-3 mb-3"><strong>Tipo de Sangre:</strong> {{$paciente -> tipo_sangre}}</div>
            </div>
        </div>
    </div>
    <!-- /Datos personales -->

    <!-- Información de Contacto de Acudiente -->
    <div class="card shadow mb-4 border-secondary">
        <div class="card-header text-white" style="background-color: #FF6F61;">
            <h5 class="mb-0"><i class="fas fa-phone-square-alt"></i> Datos Acudiente</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3"><strong>Nombre Acudiente:</strong> {{ $paciente->acudiente }}</div>
                <div class="col-md-3"><strong>Parentesco:</strong> {{$paciente -> parentesco}}</div>
                <div class="col-md-3"><strong>Ocupación Acudiente:</strong> {{$paciente -> ocupacion_acudiente}}</div>
                <div class="col-md-3"><strong>Correo Acudiente:</strong> {{$paciente -> correo_acudiente}}</div>
                <div class="col-md-3"><strong>Celular Acudiente:</strong> {{$paciente -> celular_acudiente}}</div>
            </div>
        </div>
    </div>
    <!-- /Información de Contacto de Acudiente -->

    <!-- ANAMNESIS -->
    <div class="card shadow mb-4 border-secondary">
        <div class="card-header text-white" style="background-color: #e86a92;">
            <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Anamnesis</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3"><strong>Motivo Consulta:</strong> {!!optional($paciente->anamnesis)->motivo_consulta ?? 'No registrado'!!}</div>
                <div class="col-md-3"><strong>Historia de enfermedad actual:</strong> {!!optional($paciente->anamnesis)->historia_enfermedad_actual ?? 'No registrado'!!}</div>
            </div>
        </div>
    </div>
    <!-- /ANAMNESIS -->

    <!-- ANTECEDENTES MÉDICOS PERSONALES Y FAMILIARES -->
    <div class="row gy-3">
        <div class="col-md-6">
            <div class="card shadow mb-4 border-0">
                <div class="card-header text-dark border-0" style="background-color: #0077b6;">
                    <h5 class="mb-0">
                        <i class="fas fa-user-md me-2"></i> Antecedentes Médicos Personales
                    </h5>
                </div>
                <div class="card-body p-3">
                    @php
                    $checks = [
                    ['alergias', 'Alergias', 'fa-allergies'],
                    ['fiebre_reumatica', 'Fiebre Reumática', 'fa-temperature-high'],
                    ['trastornos_gastricos', 'Trastornos gástricos', 'fa-apple-alt'],
                    ['tto_farmacologico_actual', 'Trat. Farmacológico', 'fa-pills'],
                    ['fuma', 'Fuma', 'fa-smoking'],
                    ['trastornos_coagulacion', 'Coagulación', 'fa-vial'],
                    ['cirugias', 'Cirugías', 'fa-scissors'],
                    ['hipertension', 'Hipertensión', 'fa-heartbeat'],
                    ['tto_medico_actual', 'Trat. Médico actual', 'fa-notes-medical'],
                    ['embarazo', 'Embarazo', 'fa-baby'],
                    ['enf_respiratorias', 'Respiratorias', 'fa-lungs'],
                    ['enf_renal', 'Renal', 'fa-tint'],
                    ['diabetes', 'Diabetes', 'fa-syringe'],
                    ['vih_sida', 'VIH/SIDA', 'fa-virus'],
                    ['alteraciones_cardiacas', 'Cardíacas', 'fa-heart'],
                    ['hepatitis', 'Hepatitis', 'fa-viruses'],
                    ['hospitalizaciones', 'Hospitalizaciones', 'fa-hospital'],
                    ['cancer', 'Cáncer', 'fa-ribbon'],
                    ['otra_patologia', 'Otra patología', 'fa-question'],
                    ];
                    $anteMed = optional($paciente->antecedentesMedicos);
                    @endphp

                    @if($anteMed->paciente_id ?? false)
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($checks as [$key, $label, $icon])
                        <li class="list-group-item d-flex justify-content-between align-items-center px-2">
                            <span>
                                <i class="fas {{ $icon }} me-1"></i> {{ $label }}
                            </span>
                            @if($anteMed->$key)
                            <span class="badge rounded-pill bg-success p-2"><i class="fas fa-check"></i> Sí</span>
                            @else
                            <span class="badge rounded-pill bg-secondary p-2"><i class="fas fa-times"></i> No</span>
                            @endif
                        </li>
                        @endforeach
                        @if($anteMed->antecedentes_personales_otro)
                        <li class="list-group-item px-2">
                            <i class="fas fa-comment-medical me-1"></i>
                            <strong>Especifique (otro):</strong>
                            <div class="ms-3">{!! $anteMed->antecedentes_personales_otro !!}</div>
                        </li>
                        @endif
                    </ul>
                    @else
                    <div class="text-muted">No hay antecedentes Médicos personales registrados.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4 border-0">
                <div class="card-header text-dark border-0" style="background-color: #0077b6;">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i> Antecedentes Médicos Familiares
                    </h5>
                </div>
                <div class="card-body p-3">
                    @php
                    $familiares = [
                    ['fam_cardiovasculares', 'Cardiovasculares', 'fa-heart-pulse'],
                    ['fam_oncologicos', 'Oncológicos', 'fa-dna'],
                    ['fam_endocrinos', 'Endócrinos', 'fa-bone'],
                    ['fam_psiquiatricos', 'Psiquiátricos', 'fa-brain'],
                    ['fam_hematologicos', 'Hematológicos', 'fa-droplet'],
                    ['fam_neurologicos', 'Neurológicos', 'fa-brain'],
                    ['fam_autoinmunes', 'Autoinmunes', 'fa-shield-virus'],
                    ['fam_otros', 'Otros', 'fa-asterisk'],
                    ];
                    @endphp

                    @if($anteMed->paciente_id ?? false)
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($familiares as [$key, $label, $icon])
                        <li class="list-group-item d-flex justify-content-between align-items-center px-2">
                            <span>
                                <i class="fas {{ $icon }} me-1"></i> {{ $label }}
                            </span>
                            @if($anteMed->$key)
                            <span class="badge rounded-pill bg-success p-2"><i class="fas fa-check"></i> Sí</span>
                            @else
                            <span class="badge rounded-pill bg-secondary p-2"><i class="fas fa-times"></i> No</span>
                            @endif
                        </li>
                        @endforeach
                        @if($anteMed->antecedentes_familiares_otro)
                        <li class="list-group-item px-2">
                            <i class="fas fa-comment-medical me-1"></i>
                            <strong>Especifique (otros):</strong>
                            <div class="ms-3">{!! $anteMed->antecedentes_familiares_otro !!}</div>
                        </li>
                        @endif
                        @if($anteMed->observaciones)
                        <li class="list-group-item px-2">
                            <i class="fas fa-clipboard-list me-1"></i>
                            <strong>Observaciones:</strong>
                            <div class="ms-3">{!! $anteMed->observaciones !!}</div>
                        </li>
                        @endif
                    </ul>
                    @else
                    <div class="text-muted">No hay antecedentes familiares registrados.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /antecedentes medicos perosnales Y familiares -->

    <!-- Información General y Examen Estomatológico -->
    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #9489d7;">
            <h5 class="mb-0"><i class="fa-solid fa-teeth-open"></i> Información General y Examen Estomatológico</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 text-center align-middle">
                    <thead>
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
                        @endphp

                        @foreach($fila as $f)
                        <tr>
                            {{-- Primer tejido --}}
                            <td class="text-start">{{ $f['label1'] }}</td>
                            <td>
                                @php $v1 = optional($odo)->{$f['campo']} ?? null; @endphp
                                @if($v1 === 'anormal')
                                <span class="badge bg-danger">Anormal</span>
                                @elseif($v1 === 'normal')
                                <span class="badge bg-success">Normal</span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>

                            {{-- Segundo tejido --}}
                            <td class="text-start">{{ $f['label2'] ?? '-' }}</td>
                            <td>
                                @if($f['campo2'])
                                @php $v2 = optional($odo)->{$f['campo2']} ?? null; @endphp
                                @if($v2 === 'anormal')
                                <span class="badge bg-danger">Anormal</span>
                                @elseif($v2 === 'normal')
                                <span class="badge bg-success">Normal</span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>

                            {{-- Hallazgo articular --}}
                            <td class="text-start">{{ $f['label3'] }}</td>
                            <td>
                                @php $va = optional($odo)->{$f['campo3']} ?? null; @endphp
                                @if($va === 'anormal')
                                <span class="badge bg-danger">Sí</span>
                                @elseif($va === 'normal')
                                <span class="badge bg-success">No</span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        {{-- Última visita al odontólogo --}}
                        <tr>
                            <td colspan="2" class="text-start"><strong>Última visita al odontólogo:</strong></td>
                            <td colspan="4">
                                @php
                                $fecha = optional(optional($paciente->odontograma))->ultima_visita_odontologo;
                                @endphp

                                {{ $fecha
            ? \Carbon\Carbon::parse($fecha)->format('d/m/Y')
            : 'N/A' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-start">
            <strong>Observaciones:</strong>
            <p>{!! optional($paciente->odontograma)->observaciones_estomatologico ?? 'N/A' !!}</p>
        </div>
    </div>
    <!-- /Información General y Examen Estomatológico -->

    {{-- Antecedentes Odontológicos --}}
    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #9489d7;">
            <h5 class="mb-0"><i class="fa-solid fa-teeth-open"></i> Antecedentes Odontológicos</h5>
        </div>
        <div class="card-body">
            @php
            $higieneMap = ['B' => 'Bueno', 'R' => 'Regular', 'M' => 'Malo'];
            @endphp
            <div class="row gy-3">
                <div class="col-md-4">
                    <strong>1. Higiene Oral:</strong>
                    <p>{{ $higieneMap[optional($paciente->odontograma)->higiene_oral] ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>2. Seda Dental:</strong>
                    <p>{{ (optional($paciente->odontograma)->seda_dental ?? false) ? 'Sí' : 'No' }}</p>
                </div>
                <div class="col-md-4">
                    <strong>3. Sangrado Gingival y Cálculos:</strong>
                    <p>{{ optional($paciente->odontograma)->sangrado_gingival ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <strong>4. Odontalgia:</strong>
                    <p>{{ (optional($paciente->odontograma)->odontalgia ?? false) ? 'Sí' : 'No' }}</p>
                    @if(optional($paciente->odontograma)->odontalgia)
                    <p><em>¿Cuál?:</em> {{ optional($paciente->odontograma)->odontalgia_cual }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <strong>5. Frecuencia de Cepillado:</strong>
                    <p>{{ optional($paciente->odontograma)->frecuencia_cepillado ?? 'N/A' }}</p>
                </div>
            </div>

        </div>
    </div>
    <!-- /HISTORIA CLINICA ODONTOLOGICA -->

    <!-- ODONTOGRAMA -->
    <style>
        .odontograma-card {
            box-shadow: 0 0 6px rgba(0, 0, 0, .1);
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            margin-bottom: 2rem;
            overflow: hidden;
        }



        .odontograma-toolbar .odontograma-tool.active {
            background: #0d6efd;
            color: #fff
        }

        .odontograma-linea {
            display: flex;
            flex-wrap: nowrap;
            gap: .35rem;
            justify-content: center;
            overflow-x: auto;
        }

        .diente {
            text-align: center;
            position: relative;
            user-select: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 3.375rem;
            width: 3.375rem;
        }

        .diente i {
            font-size: 1.8rem;
            color: #6c757d
        }

        .badge-container {
            display: flex;
            flex-direction: column;
            margin-top: 2px;
            position: relative;
            top: 0;
            right: 0;
            flex-wrap: wrap;
            gap: 3px;
            justify-content: center;
            max-width: 100%
        }

        .badge-container .badge {
            font-size: 0.87rem;
            line-height: 1;
            padding: 3px 4px
        }

        .odontograma-grid {
            display: grid;
            grid-template-columns: repeat(2, auto);
            grid-template-rows: repeat(2, auto);
            gap: 0;
            position: relative;
            width: max-content;
            /* se adapta al ancho real de los cuadrantes */
            margin: 0 auto;
        }

        /* línea horizontal */
        .odontograma-grid::before.odontograma-grid::after {
            display: none;
        }

        /* primer cuadrante: arriba-izquierda */
        .quadrant-sup_izq {
            /* ya existe .quadrant-…  */
            border: 0;
            /* quitamos el marco completo          */
            border-right: 2px solid #495057;
            border-bottom: 2px solid #495057;
        }

        /* arriba-derecha */
        .quadrant-sup_der {
            border: 0;
            border-left: 2px solid #495057;
            border-bottom: 2px solid #495057;
        }

        /* abajo-izquierda */
        .quadrant-inf_izq {
            border: 0;
            border-right: 2px solid #495057;
            border-top: 2px solid #495057;
        }

        /* abajo-derecha */
        .quadrant-inf_der {
            border: 0;
            border-left: 2px solid #495057;
            border-top: 2px solid #495057;
        }

        .quadrant {
            border: 2px solid #495057;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center
        }

        .quadrant-label {
            font-weight: 600;
            margin-bottom: .5rem
        }



        .quadrant-title {
            font-weight: 600;
            margin-bottom: .5rem;
        }
    </style>
    @php
    // Normalizar y filtrar cadenas vacías (por si acaso)
    $normalizar = fn(array $arr): array => array_map(fn($v) =>
    is_string($v)
    ? array_values(array_filter(explode(',', $v), fn($i) => $i !== ''))
    : $v
    , $arr);

    $inicial = $normalizar($inicial);
    $final = $normalizar($final);

    // Cuadrantes con rangos descendentes donde haga falta
    $cuadrantes = [
    'sup_izq' => [ range(18,11,-1), range(55,51,-1) ],
    'sup_der' => [ range(21,28), range(61,65) ],
    'inf_izq' => [ range(85,81,-1), range(48,41,-1)],
    'inf_der' => [ range(71,75), range(31,38) ],
    ];
    $labels = [
    'sup_izq' => 'Superior Derecho',
    'sup_der' => 'Superior Izquierdo',
    'inf_izq' => 'Inferior Derecho',
    'inf_der' => 'Inferior Izquierdo',
    ];
    @endphp

    {{-- Odontograma Inicial --}}
    <div class="odontograma-card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Odontograma Inicial</h5>
        </div>
        <div class="card-body">
            <div class="odontograma-grid">
                @foreach($cuadrantes as $key => $filas)
                <div class="quadrant">
                    <div class="quadrant-title">{{ $labels[$key] }}</div>
                    @foreach($filas as $fila)
                    <div class="odontograma-linea mt-2">
                        @foreach($fila as $diente)
                        @php $marcadas = $inicial[$diente] ?? []; @endphp
                        <div class="diente">
                            <i class="fa fa-tooth"></i>
                            <small>{{ $diente }}</small>
                            <div class="badge-container">
                                @foreach($marcadas as $herr)
                                @if(isset($iconMap[$herr]))
                                <span class="badge">{{ $iconMap[$herr] }}</span>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Odontograma Final --}}
    <div class="odontograma-card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Odontograma Final</h5>
        </div>
        <div class="card-body">
            <div class="odontograma-grid">
                @foreach($cuadrantes as $key => $filas)
                <div class="quadrant">
                    <div class="quadrant-title">{{ $labels[$key] }}</div>
                    @foreach($filas as $fila)
                    <div class="odontograma-linea mt-2">
                        @foreach($fila as $diente)
                        @php $marcadas = $final[$diente] ?? []; @endphp
                        <div class="diente">
                            <i class="fa fa-tooth"></i>
                            <small>{{ $diente }}</small>
                            <div class="badge-container">
                                @foreach($marcadas as $herr)
                                @if(isset($iconMap[$herr]))
                                <span class="badge">{{ $iconMap[$herr] }}</span>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Observaciones --}}
    @if(!empty($paciente->odontograma->observaciones_odontograma))
    <div class="card">
        <div class="card-header bg-secondary text-white">Observaciones</div>
        <div class="card-body">
            {!! nl2br(e($paciente->odontograma->observaciones_odontograma)) !!}
        </div>
    </div>
    @endif
    <!-- /ODONTOGRAMA -->

    <!-- VALORACION -->
    @php
    $v = $paciente->valoracion; // alias corto
    @endphp
    {{-- ─────────────  ORTODONCIA PREVIA  ───────────── --}}
    <div class="card shadow mb-4 border-primary">
        <div class="card-header text-white" style="background-color: #13d3bc;">
            <h5 class="mb-0"><i class="fas fa-stethoscope"></i> Valoración Ortodoncia</h5>
        </div>
        @if($v)
        <table class="table table-bordered mb-4">
            <tr>
                <th colspan="2" class="table-secondary">Ortodoncia Previa</th>
            </tr>

            <tr>
                <td>Ortodoncia previa</td>
                <td>{{ $v->ortodoncia_previa ? 'Sí' : 'No' }}</td>
            </tr>
            <tr>
                <td>Tiene aparatología</td>
                <td>{{ $v->tiene_aparatologia ? 'Sí' : 'No' }}</td>
            </tr>
            <tr>
                <td>Tiempo aparatología</td>
                <td>{{ $v->tiempo_aparatologia ?? '—' }}</td>
            </tr>
        </table>


        {{-- ─────────────  EXAMEN FACIAL  ───────────── --}}
        <table class="table table-bordered mb-4">
            {{-- Cabecera --}}
            <tr>
                <th colspan="4" class="table-secondary text-center">Examen Facial</th>
            </tr>

            {{-- Fila 1: perfil facial + SNA --}}
            <tr>
                <td><strong>Perfil facial</strong></td>
                <td>{{ ucfirst($v->perfil_facial ?? '—') }}</td>

                <td><strong>SNA</strong></td>
                <td>{{ $v->sna ?? '—' }}</td>
            </tr>

            {{-- Fila 2: SNB + ANB --}}
            <tr>
                <td><strong>SNB</strong></td>
                <td>{{ $v->snb ?? '—' }}</td>

                <td><strong>ANB</strong></td>
                <td>{{ $v->anb ?? '—' }}</td>
            </tr>

            {{-- Fila 3: desvío mandibular + tipo de cara --}}
            <tr>
                <td><strong>Desvío mandibular</strong></td>
                <td>
                    {{ $v->desvio_mandibular ? 'Sí' : 'No' }}
                </td>

                <td><strong>Tipo de cara</strong></td>
                <td>{{ ucfirst($v->tipo_cara ?? '—') }}</td>
            </tr>

            <tr>
                <td><strong>Lado derecho</strong></td>
                <td>
                    @if($v->desvio_lado_der)
                    Sí &nbsp;
                    @if($v->desvio_mm_der !== null && $v->desvio_mm_der !== '')
                    ({{ rtrim(rtrim(number_format($v->desvio_mm_der,1,'.',''), '0'), '.') }} mm)
                    @endif
                    @else
                    —
                    @endif
                </td>

                <td><strong>Lado izquierdo</strong></td>
                <td>
                    @if($v->desvio_lado_izq)
                    Sí &nbsp;
                    @if($v->desvio_mm_izq !== null && $v->desvio_mm_izq !== '')
                    ({{ rtrim(rtrim(number_format($v->desvio_mm_izq,1,'.',''), '0'), '.') }} mm)
                    @endif
                    @else
                    —
                    @endif
                </td>
            </tr>

            {{-- Fila 5: labios --}}
            <tr>
                <td><strong>Labio superior</strong></td>
                <td>{{ ucfirst($v->labio_superior ?? '—') }}</td>

                <td><strong>Labio inferior</strong></td>
                <td>{{ ucfirst($v->labio_inferior ?? '—') }}</td>
            </tr>
        </table>


        {{-- ─────────────  EXAMEN INTRAORAL  ───────────── --}}
        @php
        /* Diccionarios para traducir valores */
        $niveles = [
        '' => '—',
        'leve' => 'Leve',
        'moderado'=> 'Moderado',
        'severo' => 'Severo',
        ];

        $denticiones = [
        'temporal' => 'Dentición Temporal',
        'mixta' => 'Dentición Mixta',
        'permanente' => 'Dentición Permanente',
        ];

        $siNo = fn($val) => $val ? 'Sí' : 'No';
        @endphp


        {{-- ===============  EXAMEN INTRAORAL (SHOW)  =============== --}}
        {{-- ► Apiñamiento / Diastemas --}}
        <table class="table table-bordered mb-0 text-center align-middle">

            <thead class="table-light">
                <tr>
                <tr>
                    <th colspan="7" class="table-secondary text-center">Examen Intraoral</th>
                </tr>
                <th rowspan="2"></th>
                <th colspan="2">Apiñamiento</th>
                <th colspan="2">Diastemas</th>
                </tr>
                <tr>
                    <th>Sup.</th>
                    <th>Inf.</th>
                    <th>Sup.</th>
                    <th>Inf.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-start">Valor</td>
                    <td>{{ $niveles[$v->api_sup  ?? ''] }}</td>
                    <td>{{ $niveles[$v->api_inf ?? ''] }}</td>
                    <td>{{ $niveles[$v->dias_sup ?? ''] }}</td>
                    <td>{{ $niveles[$v->dias_inf ?? ''] }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Tipo de dentición --}}
        <div class="p-3 border-top">
            <strong>Tipo de dentición:</strong>
            {{ $denticiones[$v->denticion] ?? '—' }}
        </div>

        {{-- ► Agenesia / Hipoplasia / Pigmentaciones --}}
        <table class="table table-bordered mb-0 text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Agenesia</th>
                    <th>¿Cuál?</th>
                    <th>Hipoplasia</th>
                    <th>¿Cuál?</th>
                    <th>Pigmentaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $siNo($v->agenesia) }}</td>
                    <td>{{ $v->agenesia_cual ?: '—' }}</td>
                    <td>{{ $siNo($v->hipoplasia) }}</td>
                    <td>{{ $v->hipoplasia_cual ?: '—' }}</td>
                    <td>{{ $siNo($v->pigmentaciones) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Dientes en erupción / ausentes --}}
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th>Dientes en erupción</th>
                    <th>Dientes ausentes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $v->dientes_erupcion ?: '—' }}</td>
                    <td>{{ $v->dientes_ausentes ?: '—' }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Mordida cruzada / abierta --}}
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th colspan="3">Mordida Cruzada</th>
                    <th colspan="3">Mordida Abierta</th>
                </tr>
                <tr>
                    <th>¿Tiene?</th>
                    <th>Tipo</th>
                    <th>Lado</th>
                    <th>¿Tiene?</th>
                    <th>Tipo</th>
                    <th>Lado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $siNo($v->mordida_cruzada) }}</td>
                    <td>{{ ucfirst($v->mordida_cruzada_tipo ?: '—') }}</td>
                    <td>{{ ucfirst($v->mordida_cruzada_lado ?: '—') }}</td>

                    <td>{{ $siNo($v->mordida_abierta) }}</td>
                    <td>{{ ucfirst($v->mordida_abierta_tipo ?: '—') }}</td>
                    <td>{{ ucfirst($v->mordida_abierta_lado ?: '—') }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Alteraciones dentarias (rotación, etc.) --}}
        <table class="table table-bordered mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th>Rotación</th>
                    <th>Intrusión</th>
                    <th>Extrusión</th>
                    <th>Gresión</th>
                    <th>Versión</th>
                    <th>Migración</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $v->rotacion   ?: '—' }}</td>
                    <td>{{ $v->intrusion  ?: '—' }}</td>
                    <td>{{ $v->extrusion  ?: '—' }}</td>
                    <td>{{ $v->gresion    ?: '—' }}</td>
                    <td>{{ $v->version    ?: '—' }}</td>
                    <td>{{ $v->migracion  ?: '—' }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Retención --}}
        <div class="p-3 border-top">
            <strong>Retención:</strong>
            {{ $siNo($v->retencion) }}
            @if($v->retencion_cual)
            — {{ $v->retencion_cual }}
            @endif
        </div>

        {{-- ─────────────  ANGLE / OVERJET / OVERBITE  ───────────── --}}
        @php
        /* Ayudantes para formatear */
        $fmt = fn($val) => ($val === null || $val === '') ? '—' : $val;
        @endphp

        {{-- ▬▬▬▬▬▬▬▬▬  CLASIFICACIÓN DE ANGLE Y CANINA  ▬▬▬▬▬▬▬▬▬--}}

        {{-- ► Tabla Angle / Canina --}}
        <table class="table table-bordered text-center mb-0 align-middle">
            <thead class="table-light">
                <tr>
                <tr>
                    <th colspan="7" class="table-secondary text-center">Clasificación de Angle y Canina</th>
                </tr>
                <th rowspan="2"></th>
                <th colspan="3">Derecha</th>
                <th colspan="3">Izquierda</th>
                </tr>
                <tr>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                </tr>
            </thead>
            <tbody>
                {{-- Fila CANINA --}}
                <tr>
                    <th class="text-start">Canina</th>
                    <td>{{ $fmt($v->canina_der_clase1) }}</td>
                    <td>{{ $fmt($v->canina_der_clase2) }}</td>
                    <td>{{ $fmt($v->canina_der_clase3) }}</td>
                    <td>{{ $fmt($v->canina_izq_clase1) }}</td>
                    <td>{{ $fmt($v->canina_izq_clase2) }}</td>
                    <td>{{ $fmt($v->canina_izq_clase3) }}</td>
                </tr>
                {{-- Fila MOLAR --}}
                <tr>
                    <th class="text-start">Molar</th>
                    <td>{{ $fmt($v->molar_der_clase1) }}</td>
                    <td>{{ $fmt($v->molar_der_clase2) }}</td>
                    <td>{{ $fmt($v->molar_der_clase3) }}</td>
                    <td>{{ $fmt($v->molar_izq_clase1) }}</td>
                    <td>{{ $fmt($v->molar_izq_clase2) }}</td>
                    <td>{{ $fmt($v->molar_izq_clase3) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- ► Tabla Overjet / Overbite --}}
        <table class="table table-bordered text-center mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th colspan="2">Sobremordida horizontal<br>(Overjet)</th>
                    <th colspan="2">Sobremordida vertical<br>(Overbite)</th>
                </tr>
                <tr>
                    <th style="width:220px;">Tipo</th>
                    <th style="width:120px;">mm</th>
                    <th style="width:220px;">Tipo</th>
                    <th style="width:120px;">mm</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="text-start">Normal&nbsp;(2-3&nbsp;mm)</th>
                    <td>{{ $fmt($v->overjet_normal) }}</td>
                    <th class="text-start">Mordida abierta</th>
                    <td>{{ $fmt($v->overbite_mordida_abierta) }}</td>
                </tr>
                <tr>
                    <th class="text-start">Aumentado</th>
                    <td>{{ $fmt($v->overjet_aumentado) }}</td>
                    <th class="text-start">Corona clínica&nbsp;(A)</th>
                    <td>{{ $fmt($v->overbite_corona_clinica) }}</td>
                </tr>
                <tr>
                    <th class="text-start">Borde a borde</th>
                    <td>{{ $fmt($v->overjet_borde) }}</td>
                    <th class="text-start">Sobremordida</th>
                    <td>{{ $fmt($v->overbite_sobremordida) }}</td>
                </tr>
                <tr>
                    <th class="text-start">Invertido</th>
                    <td>{{ $fmt($v->overjet_invertido) }}</td>
                    <th></th>
                    <td></td>
                </tr>
            </tbody>
        </table>

        {{-- ─────────────  INCLINACION MOLAR  ───────────── --}}
        @php
        /* ---------- ayudantes ---------- */
        $fmt = fn($x) => ($x === null || $x === '') ? '—' : $x; // vacío ⇒ raya
        $sig = ['+' => '+', 'N' => 'N', '-' => '-']; // signos válidos
        @endphp
        {{-- ▬▬▬▬▬▬▬▬▬  INCLINACIÓN MOLAR  VL ▬▬▬▬▬▬▬▬▬ --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                    <tr>
                        <th colspan="20" class="table-secondary text-center">Inclinación Molar</th>
                    </tr>
                    <th colspan="9" class="border-right">DERECHA</th>
                    <th colspan="9">IZQUIERDA</th>
                    </tr>
                    <tr>
                        @for($i=0;$i<2;$i++)
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

                {{-- = fila 1 (arcada superior) = --}}
                <tbody>
                    <tr>
                        @foreach([8,7,6,8,7,6] as $d) <td colspan="3">{{ $d }}</td> @endforeach
                    </tr>
                    <tr>
                        @foreach([['fila1_derecha_', [8,7,6]],
                        ['fila1_izquierda_', [6,7,8]]] as [$pref,$dientes])
                        @foreach($dientes as $d)
                        @php $val = $v->{$pref.$d} ?? null; @endphp
                        @foreach(['+','N','-'] as $s)
                        <td>{{ $val === $s ? $s : '' }}</td>
                        @endforeach
                        @endforeach
                        @endforeach
                    </tr>

                    {{-- = fila 2 (arcada inferior) = --}}
                    <tr>
                        @foreach([8,7,6,8,7,6] as $d) <td colspan="3">{{ $d }}</td> @endforeach
                    </tr>
                    <tr>
                        @foreach([['fila2_derecha_', [8,7,6]],
                        ['fila2_izquierda_', [6,7,8]]] as [$pref,$dientes])
                        @foreach($dientes as $d)
                        @php $val = $v->{$pref.$d} ?? null; @endphp
                        @foreach(['+','N','-'] as $s)
                        <td>{{ $val === $s ? $s : '' }}</td>
                        @endforeach
                        @endforeach
                        @endforeach
                    </tr>
                </tbody>
                <tfoot class="table-light">
                    <tr>@for($i=0;$i<2;$i++)<th>+</th>
                            <th>N</th>
                            <th>-</th>
                            <th>+</th>
                            <th>N</th>
                            <th>-</th>
                            <th>+</th>
                            <th>N</th>
                            <th>-</th>@endfor</tr>
                </tfoot>
            </table>
        </div>

        {{-- ▸ Desviación línea media y plano terminal --}}
        <div class=" border-top row gx-4 gy-3 p-3 m-4">

            {{-- ♦ Línea media --}}
            <div class="col-md-6 border-end">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Desviación Línea Media Dentaria</h6>

                @foreach(['sup'=>'Superior','inf'=>'Inferior'] as $arc=>$lab)
                <div class="row mb-2">
                    <label class="col-4 col-md-3 fw-bold">{{ $lab }}</label>

                    <div class="col-4">{{ $fmt($v->{'midline_'.$arc.'_derecha'}) }}&nbsp;mm&nbsp;<small class="text-muted">D</small></div>
                    <div class="col-4">{{ $fmt($v->{'midline_'.$arc.'_izquierda'}) }}&nbsp;mm&nbsp;<small class="text-muted">I</small></div>
                </div>
                @endforeach
            </div>

            {{-- ♦ Plano terminal --}}
            <div class="col-md-6">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Plano Terminal (dentición temporal)</h6>

                <div class="row mb-2">
                    <label class="col-4 fw-bold">Mesial</label>
                    <div class="col-8">{{ $fmt($v->plano_mesial_mm) }}&nbsp;mm</div>
                </div>
                <div class="row mb-2">
                    <label class="col-4 fw-bold">Distal</label>
                    <div class="col-8">{{ $fmt($v->plano_distal_mm) }}&nbsp;mm</div>
                </div>
                <div class="row">
                    <label class="col-4 fw-bold">Neutro</label>
                    <div class="col-8">{{ $fmt($v->plano_neutro_mm) }}&nbsp;mm</div>
                </div>
            </div>

        </div>

        {{-- =========  EXAMEN RADIOGRÁFICO  (vista *show*) ========= --}}
        @php
        /* ayudantes */
        $siNo = fn($b) => $b === 1 ? 'Sí' : ($b === 0 ? 'No' : '—');
        @endphp

        <div class="card-body p-0">
            <div class="table-responsive">
                @php
                $v = $paciente->valoracion;
                @endphp

                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                        <tr>
                            <th colspan="20" class="table-secondary text-center">Examen Radiográfico</th>
                        </tr>
                        <th rowspan="2" class="align-middle">Hallazgo</th>
                        <th colspan="2"></th>
                        <th colspan="2">Detalles</th>
                        </tr>
                        <tr>
                            <th>SÍ</th>
                            <th>NO</th>
                            <th>Vertical mm</th>
                            <th>Horizontal mm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pérdida ósea</td>
                            <td class="text-center">
                                @if($v && $v->perdida_osea) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->perdida_osea) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td>
                                @if($v && $v->perdida_osea_vertical_mm)
                                Vertical: {{ $v->perdida_osea_vertical_mm }} mm
                                @endif
                            </td>
                            <td>
                                @if($v && $v->perdida_osea_horizontal_mm)
                                Horizontal: {{ $v->perdida_osea_horizontal_mm }} mm
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Dilaceración radicular</td>
                            <td class="text-center">
                                @if($v && $v->dilaceracion_radicular) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->dilaceracion_radicular) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->dilaceracion_cual)
                                ¿Cuál? {{ $v->dilaceracion_cual }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Reabsorción radicular</td>
                            <td class="text-center">
                                @if($v && $v->reabsorcion_radicular) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->reabsorcion_radicular) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->reabsorcion_cual)
                                ¿Cuál? {{ $v->reabsorcion_cual }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Rarefacción</td>
                            <td class="text-center">
                                @if($v && $v->rarefaccion) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->rarefaccion) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->rarefaccion_zona)
                                Zona: {{ $v->rarefaccion_zona }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Conductos radicular</td>
                            <td class="text-center">
                                @if($v && $v->conductos_radicular) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->conductos_radicular) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->conductos_cual)
                                ¿Cuál? {{ $v->conductos_cual }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Longitud radicular disminuida</td>
                            <td class="text-center">
                                @if($v && $v->longitud_radicular_disminuida) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->longitud_radicular_disminuida) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->longitud_cual)
                                ¿Cuál? {{ $v->longitud_cual }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Retenedor intrarradicular</td>
                            <td class="text-center">
                                @if($v && $v->retenedor_intrarradicular) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->retenedor_intrarradicular) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->retenedor_cual)
                                ¿Cuál? {{ $v->retenedor_cual }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Implante</td>
                            <td class="text-center">
                                @if($v && $v->implante) <i class="fa-solid fa-circle-check text-success"></i> @endif
                            </td>
                            <td class="text-center">
                                @if($v && !$v->implante) <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </td>
                            <td colspan="2">
                                @if($v && $v->implante_zona)
                                Zona: {{ $v->implante_zona }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                @if($v && $v->observ_radiografico)
                <div class="p-3 mt-3">
                    <label class="fw-bold">Observaciones:</label>
                    <div class="border rounded p-2">
                        {!! $v->observ_radiografico !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    <!-- /VALORACION -->
</div>
<!--**NO** CAMBIAR ESTE DIV PORQUE SE SUPERPONEN LAS DOS ULTIMAS CARDS  -->


<!-- EXAMEN ENDODONTICO Y PERIODONTAL -->
@php
$examen = $paciente->examenendodonticos; // relación hasOne

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

{{-- ===== Arcada superior ===== --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header text-white" style="background:#ecb10d;">
        <h5 class="mb-0">EXAMEN ENDODONTICO ARCADA SUPERIOR</h5>
    </div>
    <div class="card-body p-0">
        @if($examen)
        <table class="table mb-0">
            <tbody>
                <tr>
                    {{-- ===== Fecha ===== --}}
                    <td class="fw-semibold">
                        Fecha del examen:
                        {{ $examen?->fecha?->format('d/m/Y') ?? '—' }}
                    </td>

                </tr>
                @foreach ($sup as $label => $col)
                <tr>
                    <td style="width:25%" class="fw-semibold">{{ $label }}</td>
                    <td>{!! $examen->$col ? nl2br(e($examen->$col)) : '—' !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="p-3 text-muted mb-0">No se ha registrado examen endodóntico.</p>
        @endif
    </div>
</div>

{{-- ===== Arcada inferior ===== --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header text-white" style="background:#ecb10d;">
        <h5 class="mb-0">EXAMEN ENDODONTICO ARCADA INFERIOR</h5>
    </div>
    <div class="card-body p-0">
        @if($examen)
        <table class="table mb-0">
            <tbody>
                @foreach ($inf as $label => $col)
                <tr>
                    <td style="width:25%" class="fw-semibold">{{ $label }}</td>
                    <td>{!! $examen->$col ? nl2br(e($examen->$col)) : '—' !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<!-- EXAMEN PERIODONTAL -->
@php
$periodontal = $paciente->examenperiodontals; // relación hasOne

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
$txt = fn($v) => $v ? nl2br(e($v)) : '—';
@endphp


{{-- Arcada superior --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header text-white" style="background:#ecb10d;">
        <h5 class="mb-0">EXAMEN PERIODONTAL ARCADA SUPERIOR</h5>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <tbody>
                @foreach ($sup as $lab => $col)
                <tr>
                    <td style="width:28%" class="fw-semibold">{{ $lab }}</td>
                    <td>{!! $txt($periodontal->$col ?? null) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Arcada inferior --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header text-white" style="background:#ecb10d;">
        <h5 class="mb-0">EXAMEN PERIODONTAL ARCADA INFERIOR</h5>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <tbody>
                @foreach ($inf as $lab => $col)
                <tr>
                    <td style="width:28%" class="fw-semibold">{{ $lab }}</td>
                    <td>{!! $txt($periodontal->$col ?? null) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /EXAMEN ENDODONTICO Y PERIODONTAL -->

<!-- Diagnóstico  -->
<div class="card mb-4">
    <div class="card-header text-white" style="background-color: #44da09;">
        <h5 class="mb-0"><i class="fas fa-search"></i> Diagnóstico HC</h5>
    </div>
    <div class="card-body p-0">
        @if($paciente->diagnosticoHcs->isEmpty())
        <p class="p-3 text-muted">No hay diagnósticos cargados.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
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
        </div>
        @endif
    </div>
</div>
<!-- /Diagnostico  -->

<!-- CONTROLES -->
<div class="card mb-4 shadow-sm">
    {{-- Cabecera --}}
    <div class="card-header text-white" style="background-color:rgb(206, 93, 131);">
        <h5 class="mb-0">
            <i class="fa-solid fa-user-check me-2"></i> Controles Ortodoncia
        </h5>
    </div>

    {{-- Cuerpo --}}
    @if ($controles->isEmpty())
    <p class="p-3 m-0 text-muted">No hay controles cargados.</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="col-md-3">Paciente</th>
                    <th class="col-md-3">Doctor</th>
                    <th class="col-md-2">Fecha consulta</th>
                    <th class="col-md-4">Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($controles as $control)
                <tr>
                    <td>{{ $control->paciente->apellidos }} {{ $control->paciente->nombres }}</td>
                    <td>{{ $control->doctor->nombres }} {{ $control->doctor->apellidos }}</td>
                    <td>{{ \Carbon\Carbon::parse($control->fecha_consulta)->format('d/m/Y') }}</td>
                    <td class="text-break">{!! $control->detalle !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
<!-- /CONTROLES -->

<!-- PLAN DE TRATAMIENTO -->
<div class="container py-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:rgba(77, 127, 237, 1);">
            <h5 class="m-0 font-weight-bold">PLAN DE TRATAMIENTO</h5>

        </div>
        <div class="card-body">
            {{-- Modalidades --}}

            <div class="row mb-4">
                @foreach([
                'Ortodoncia Correctiva' => $plan->ortodoncia_correctiva,
                'Compensación Ortodoncia' => $plan->compensacion_ortodoncia,
                'Ortopedia Dentofacial' => $plan->ortopedia_dentofacial,
                'Cirugía Ortognática' => $plan->cirugia_ortognatica,
                ] as $label => $value)
                <div class="col-md-3 mb-2">
                    <span class="small font-weight-bold">{{ $label }}</span><br>
                    @if($value)
                    <i class="fa fa-check-circle text-success"></i>
                    @else
                    <i class="fa fa-times-circle text-muted"></i>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Objetivos --}}
            <div class="mb-4">
                <label class="small font-weight-bold text-uppercase mb-2">Objetivos del Tratamiento</label>
                <div class="border rounded p-3 bg-light" style="min-height:150px;">
                    {!! ($plan->objetivos ?: '—') !!}
                </div>
            </div>

            {{-- Exodoncias --}}
            <div class="row mb-4">
                @foreach([
                'Exodoncias' => $plan->exodoncias,
                'Posibles Exodoncias' => $plan->posibles_exodoncias,
                'Sin Exodoncias' => $plan->sin_exodoncias,
                ] as $label => $value)
                <div class="col-md-4 mb-3">
                    <span class="small font-weight-bold">{{ $label }}</span>
                    <div class="border rounded px-2 py-2 bg-light">
                        {{ $value ?: '—' }}
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Aparatología y Contención --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <span class="small font-weight-bold">Aparatología Complementaria</span>
                    <div class="border rounded px-2 py-2 bg-light">
                        {{ $plan->aparatologia_complementaria ?: '—' }}
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <span class="small font-weight-bold">Contención</span>
                    <div class="border rounded px-2 py-2 bg-light">
                        {{ $plan->contencion ?: '—' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /PLAN DE TRATAMIENTO -->

</div>

<!-- BTN REGRESAR -->
<div class="text-center mb-5">
    <a href="{{url('admin/pacientes')}}" class="btn btn-secondary btn-lg mb-3"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
</div>
<!-- /BTN REGRESAR -->
</div>
@endsection