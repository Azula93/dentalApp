@extends('layouts.admin')
@section('content')
@php
use App\Models\Odontograma;
@endphp
<div class="container p-3">
    <h1 class="mb-4">Odontograma del paciente {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.pacientes.odontograma.update',$paciente) }}">
        @csrf @method('PUT')
        <!-- HISTORIA CLINICA ODONTOLOGICA -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Información General y Examen Estomatológico</h5>
            </div>
            <div class="card-body p-0">
                @php
                $filas = [
                ['labios', 'Labios', 'piso_boca', 'Piso de Boca', 'ruido_articular', 'Ruido Articular'],
                ['carrillos', 'Carrillos', 'glandulas_salivares', 'Glándulas Salivales', 'dolor_articular', 'Dolor Articular'],
                ['paladar_duro', 'Paladar Duro', 'orofaringe', 'Orofaringe', 'dolor_muscular', 'Dolor Muscular'],
                ['lengua', 'Lengua', '', '', 'alteraciones_movimiento', 'Alteraciones en Movimiento'],
                ];
                $e = $paciente->odontograma ?? new Odontograma;
                @endphp

                <table class="table table-bordered text-center align-middle mb-0">
                    <thead>
                        <tr>
                            <th rowspan="2">Tejido</th>
                            <th colspan="2"> </th>
                            <th rowspan="2">Tejido</th>
                            <th colspan="2"> </th>
                            <th rowspan="2">Hallazgo Articular</th>
                            <th colspan="2">SI / NO</th>
                        </tr>
                        <tr>
                            <th>Normal</th>
                            <th>Anormal</th>
                            <th>Normal</th>
                            <th>Anormal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filas as $f)
                        <tr>
                            {{-- Tejido 1 --}}
                            <td class="text-start">{{ $f[1] }}</td>
                            <td>
                                <input type="radio" name="{{ $f[0] }}" value="normal"
                                    {{ old($f[0], $e->{$f[0]}) === 'normal' ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="radio" name="{{ $f[0] }}" value="anormal"
                                    {{ old($f[0], $e->{$f[0]}) === 'anormal' ? 'checked' : '' }}>
                            </td>

                            {{-- Tejido 2 --}}
                            <td class="text-start">{{ $f[3] }}</td>
                            @if($f[2])
                            <td>
                                <input type="radio" name="{{ $f[2] }}" value="normal"
                                    {{ old($f[2], $e->{$f[2]}) === 'normal' ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="radio" name="{{ $f[2] }}" value="anormal"
                                    {{ old($f[2], $e->{$f[2]}) === 'anormal' ? 'checked' : '' }}>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif

                            {{-- Hallazgo articular --}}
                            <td class="text-start">{{ $f[5] }}</td>
                            <td>
                                <input type="radio" name="{{ $f[4] }}" value="anormal"
                                    {{ old($f[4], $e->{$f[4]}) === 'anormal' ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="radio" name="{{ $f[4] }}" value="normal"
                                    {{ old($f[4], $e->{$f[4]}) === 'normal' ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Observaciones Información General y Examen Estomatológico:</label>
                        <textarea name="observaciones_estomatologico" id="editor_obsInfoGral" class="form-control" cols="30" rows="10" style="width: 100%;">{{ old('observaciones_estomatologico', $modelo->observaciones_estomatologico ?? '') }}</textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Antecedentes Odontológicos</h5>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label class="form-label"><strong>1. Higiene Oral</strong></label><br>
                        @foreach(['Bueno'=>'B','Regular'=>'R','Malo'=>'M'] as $txt=>$val)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="higiene_oral" value="{{ $val }}"
                                @if(old('higiene_oral', $odo->higiene_oral ?? '')==$val) checked @endif>
                            <label class="form-check-label">{{ $txt }}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"><strong>2. Seda Dental</strong></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="seda_dental" value="1"
                                @if(old('seda_dental', $modelo->seda_dental ?? false)) checked @endif>
                            <label class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="seda_dental" value="0"
                                @if(old('seda_dental', $modelo->seda_dental ?? false)===false) checked @endif>
                            <label class="form-check-label">No</label>
                        </div>
                    </div>

                    <div class="col-md-4 pb-3">
                        <label class="form-label"><strong>3. Odontalgia</strong></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="odontalgia" value="1"
                                @if(old('odontalgia', $modelo->odontalgia ?? false)) checked @endif>
                            <label class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="odontalgia" value="0"
                                @if(old('odontalgia', $modelo->odontalgia ?? false)===false) checked @endif>
                            <label class="form-check-label">No</label>
                        </div>
                        <input type="text" name="odontalgia_cual" class="form-control form-control-sm mt-1"
                            placeholder="¿Cuál?" value="{{ old('odontalgia_cual', $modelo->odontalgia_cual ?? '') }}">
                    </div>
                </div>

                <div class="row p-4">
                    <div class="col-md-4">
                        <label for="sangrado" class="form-label"><strong>4. Sangrado Gingival y Cálculos:</strong></label>
                        <input type="text" id="sangrado_gingival" name="sangrado_gingival" class="form-control"
                            value="{{ old('sangrado_gingival', $modelo->sangrado_gingival ?? '') }}">
                    </div>

                    <div class="col-md-4 ">
                        <label for="frecuencia_cepillado" class="form-label"><strong>5. Frecuencia de Cepillado</strong></label>
                        <input type="text" id="frecuencia_cepillado" name="frecuencia_cepillado" class="form-control"
                            value="{{ old('frecuencia_cepillado', $modelo->frecuencia_cepillado ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="ultima_visita_odontologo" class="form-label">
                            <strong>Última visita al odontólogo</strong>
                        </label>
                        <input
                            type="date"
                            id="ultima_visita_odontologo"
                            name="ultima_visita_odontologo"
                            class="form-control"
                            value="{{ old('ultima_visita_odontologo', isset($modelo->ultima_visita_odontologo) ? \Carbon\Carbon::parse($modelo->ultima_visita_odontologo)->format('Y-m-d') : '') }}">
                        @error('ultima_visita_odontologo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /HISTORIA CLINICA ODONTOLOGICA -->

        <!-- ODONTOGRAMA -->
        @php
        // Función para normalizar y filtrar valores vacíos
        $normalizar = function(array $arr): array {
        return array_map(function($v) {
        if (is_string($v)) {
        // explode + array_filter elimina cadenas vacías
        $parts = array_filter(explode(',', $v), fn($item) => $item !== '');
        return array_values($parts);
        }
        return $v;
        }, $arr);
        };

        // Aplica la normalización a ambos arrays
        $inicial = $normalizar($odontograma->initial ?? []);
        $final = $normalizar($odontograma->final ?? []);


        // 2. Herramientas y mapa de iconos
        $herramientas = [
        'amalgama' => 'Amalgama 🟦',
        'resina' => 'Resina 🟩',
        'diente_ausente' => 'Diente Ausente |',
        'endodoncia' => 'Endodoncia 🔼',
        'corona' => 'Corona 🔵',
        'exodoncia' => 'Exodoncia ❌',
        'caries' => 'Caries 🟥',
        'necesidad_endodoncia' => 'Necesidad de Endodoncia 🔺',
        'no_erupcionado' => 'No Erupcionado ➖',
        ];
        $iconMap = array_map(function($lbl) {
        // extrae el emoji del label
        return trim(mb_substr($lbl, mb_strlen($lbl) - 2));
        }, $herramientas);

        // 3. Cuadrantes con rangos descendentes (paso -1)
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
                /* ← evita que se baje a la 2ª línea */
                gap: .35rem;
                justify-content: center;
                overflow-x: auto;
            }

            .diente {
                width: 54px;
                /* más estrecho para que quepan los 8 dientes */
                text-align: center;
                position: relative;
                user-select: none;
                display: flex;
                /* apila ícono + número + badges */
                flex-direction: column;
                align-items: center;
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
                grid-template-columns: 1fr 1fr;
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
                border: 2px solidrgb(163, 35, 35);
                padding: 1rem;
                display: flex;
                flex-direction: column;
                align-items: center
            }

            .quadrant-label {
                font-weight: 600;
                margin-bottom: .5rem
            }

            /* .diente.marcado i {
                color: #0d6efd;
            } */
        </style>

        <form method="POST"
            action="{{ route('admin.pacientes.odontograma.update', $paciente->id) }}">
            @csrf @method('PUT')

            {{-- ODONTOGRAMA INICIAL --}}
            <div class="odontograma-card mb-4 card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Odontograma Inicial</h5>
                </div>

                <div class="card-body">
                    <div class=" container mb-4">
                        <div class="row align-items-start">
                            <div class="col">
                                <strong>Hallazgos:</strong>
                                @foreach($herramientas as $key => $label)
                                <button type="button"
                                    class="btn btn-outline-secondary btn-sm odontograma-tool me-2 mb-2"
                                    data-tool="{{ $key }}">{{ $label }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="odontograma-grid">
                        @foreach($cuadrantes as $quad => $filas)
                        <div class="quadrant quadrant-{{ $quad }}">
                            <div class="quadrant-title">{{ $labels[$quad] }}</div>
                            @foreach($filas as $fila)
                            <div class="odontograma-linea mt-2">
                                @foreach($fila as $diente)
                                @php
                                $marcadas = $inicial[$diente] ?? [];
                                @endphp
                                <div class="diente {{ $marcadas ? 'marcado' : '' }}"
                                    data-diente="{{ $diente }}"
                                    data-prefijo="initial">
                                    <i class="fa fa-tooth "></i>
                                    <small>{{ $diente }}</small>

                                    {{-- hidden que recibe siempre implode de un array --}}
                                    <input type="hidden"
                                        name="inicial[{{ $diente }}]"
                                        value="{{ implode(',', $marcadas) }}">

                                    <div class="badge-container">
                                        @foreach($marcadas as $herr)
                                        @if($herr !== '' && isset($iconMap[$herr]))
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

            {{-- ODONTOGRAMA FINAL  --}}
            <div class="odontograma-card mb-4 card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Odontograma Final</h5>
                </div>
                <div class="card-body">
                    <div class="odontograma-toolbar mb-4">
                        <strong>Hallazgos:</strong>
                        @foreach($herramientas as $key => $label)
                        <button type="button"
                            class="btn btn-outline-secondary btn-sm odontograma-tool me-2 mb-2"
                            data-tool="{{ $key }}">{{ $label }}</button>
                        @endforeach
                    </div>
                    <div class="odontograma-grid">
                        @foreach($cuadrantes as $quad => $filas)
                        <div class="quadrant quadrant-{{ $quad }}">
                            <div class="quadrant-title">{{ $labels[$quad] }}</div>
                            @foreach($filas as $fila)
                            <div class="odontograma-linea mt-2">
                                @foreach($fila as $diente)
                                @php
                                $marcadas = $final[$diente] ?? [];
                                @endphp
                                <div class="diente {{ $marcadas ? 'marcado' : '' }}"
                                    data-diente="{{ $diente }}"
                                    data-prefijo="final">
                                    <i class="fa fa-tooth"></i><br>
                                    <small>{{ $diente }}</small>
                                    <input type="hidden"
                                        name="final[{{ $diente }}]"
                                        value="{{ implode(',', $marcadas) }}">
                                    <div class="badge-container">
                                        @foreach($marcadas as $herr)
                                        @if($herr !== '' && isset($iconMap[$herr]))
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

            <script>
                (() => {
                    let herramientaSeleccionada = null;

                    // ===== Selección de herramienta =====
                    document.querySelectorAll('.odontograma-tool').forEach(btn => {
                        btn.addEventListener('click', () => {
                            document.querySelectorAll('.odontograma-tool').forEach(b => b.classList.remove('active'));
                            btn.classList.add('active');
                            herramientaSeleccionada = btn.dataset.tool;
                        });
                    });

                    // ===== Click en diente =====
                    document.querySelectorAll('.diente').forEach(d => {
                        d.addEventListener('click', () => {
                            if (!herramientaSeleccionada) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Sin hallazgos',
                                    text: 'Selecciona un hallazgo primero.',
                                    confirmButtonColor: '#0d6efd'
                                });
                                return;
                            }
                            const input = d.querySelector('input[type="hidden"]');
                            let valores = input.value ? input.value.split(',') : [];
                            const idx = valores.indexOf(herramientaSeleccionada);
                            if (idx === -1) valores.push(herramientaSeleccionada);
                            else valores.splice(idx, 1);
                            input.value = valores.join(',');

                            // Actualizar badges visuales
                            const cont = d.querySelector('.badge-container');
                            cont.innerHTML = '';
                            valores.forEach(k => {
                                const span = document.createElement('span');
                                span.className = 'badge';
                                span.textContent = iconMap[k] ?? '';
                                cont.appendChild(span);
                            });
                        });
                    });

                    const iconMap = {
                        amalgama: '🟦',
                        resina: '🟩',
                        diente_ausente: '|',
                        endodoncia: '🔼',
                        corona: '🔵',
                        exodoncia: '❌',
                        caries: '🟥',
                        necesidad_endodoncia: '🔺',
                        no_erupcionado: '➖',
                    };


                })();
            </script>

            {{-- 4 Observaciones generales --}}
            <div class="mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Observaciones Odontograma:</label>
                        <textarea name="observaciones_odontograma" id="editor_obsOdontograma" class="form-control" cols="30" rows="10" style="width: 100%;">{{ old('observaciones_odontograma', $modelo->observaciones_odontograma ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2">
                <a href="{{ route('admin.pacientes.index',$paciente) }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
                <button class="btn btn-success "><i class="fa-solid fa-cloud"></i> Guardar</button>
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

    ClassicEditor.create(document.querySelector('#editor_obsOdontograma'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: {
            items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        },
    });

    ClassicEditor.create(document.querySelector('#editor_obsInfoGral'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph],
        toolbar: {
            items: ['undo', 'redo', '|', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'],
        },
    });
</script>
<!-- /SCRIPTS DE CKEDITOR -->
@endsection