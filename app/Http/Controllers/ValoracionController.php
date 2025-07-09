<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ValoracionController extends Controller
{
    /**
     * Muestra el formulario de valoración (crear / editar).
     */
    public function edit(Paciente $paciente)
    {
        // Obtiene la valoración existente o crea un modelo en memoria
        $modelo = $paciente->valoracion ?: new Valoracion(['paciente_id' => $paciente->id]);

        return view('admin.pacientes.valoracion',  compact('paciente', 'modelo'));
    }

    /**
     * Guarda o actualiza la valoración.
     */
    public function update(Request $request, Paciente $paciente, Valoracion $valoracion)
    {
        // 1. Convierte todos los radios/checkbox a boolean (true/false)
        $this->normalizeBooleans($request);

        // 2. Valida el payload completo
        $data = $request->validate($this->rules());

        // 3. Inserta o actualiza el registro asociado al paciente
        $paciente->valoracion()->updateOrCreate(
            ['paciente_id' => $paciente->id],
            $data
        );

        return redirect()
            ->route('admin.pacientes.show', $paciente)
            ->with('mensaje', 'Valoración guardada correctamente.')
            ->with('icono', 'success');
    }

    /* ----------------------------------------------------------------- */
    /*  METODOS PRIVADOS                                                 */
    /* ----------------------------------------------------------------- */

    /**
     * Reglas de validación para todos los campos de Valoración.
     */
    private function rules(): array
    {
        $rules = [
            // ------------------ ORTODONCIA PREVIA ------------------
            'ortodoncia_previa'   => 'boolean',
            'tiene_aparatologia'  => 'boolean',
            'tiempo_aparatologia' => 'nullable|string|max:255',

            // ------------------ EXAMEN FACIAL ----------------------
            'perfil_facial' => 'nullable|in:convexo,recto,concavo',

            // Tipo esquelético
            'sna'        => 'nullable|numeric|min:0',
            'snb'        => 'nullable|numeric|min:0',
            'anb'        => 'nullable|numeric|min:0',
            'clase1_mm'  => 'nullable|numeric|min:0',
            'clase2_mm'  => 'nullable|numeric|min:0',
            'clase3_mm'  => 'nullable|numeric|min:0',

            // Asimetría facial
            'desvio_mandibular' => 'boolean',
            'desvio_lado_der' => 'nullable|boolean',
            'desvio_lado_izq' => 'nullable|boolean',
            'desvio_mm_der'   => 'nullable|numeric|min:0|max:99.9',
            'desvio_mm_izq'   => 'nullable|numeric|min:0|max:99.9',
            'tipo_cara'         => 'nullable|in:mesoprosopo,euriprosopo,leptoprosopo',
            'labio_superior' => 'nullable|in:normal,proquelia,retroquelia,fisura',
            'labio_inferior' => 'nullable|in:normal,proquelia,retroquelia,fisura',

            // ------------------ EXAMEN INTRAORAL -------------------
            'denticion' => 'nullable|in:temporal,mixta,permanente',
            'api_sup'   => 'nullable|in:leve,moderado,severo',
            'api_inf'   => 'nullable|in:leve,moderado,severo',
            'dias_sup'  => 'nullable|in:leve,moderado,severo',
            'dias_inf'  => 'nullable|in:leve,moderado,severo',
            'agenesia'           => 'nullable|boolean',
            'agenesia_cual'      => 'nullable|string|max:100',

            'hipoplasia'         => 'nullable|boolean',
            'hipoplasia_cual'    => 'nullable|string|max:100',

            'pigmentaciones'     => 'nullable|boolean',

            'dientes_erupcion'   => 'nullable|string|max:100',
            'dientes_ausentes'   => 'nullable|string|max:100',

            'mordida_cruzada'        => 'nullable|boolean',
            'mordida_cruzada_tipo'   => 'nullable|in:anterior,posterior',
            'mordida_cruzada_lado'   => 'nullable|in:unilateral,bilateral',

            'mordida_abierta'        => 'nullable|boolean',
            'mordida_abierta_tipo'   => 'nullable|in:anterior,posterior',
            'mordida_abierta_lado'   => 'nullable|in:unilateral,bilateral',

            'rotacion'        => 'nullable|string|max:100',
            'intrusion'       => 'nullable|string|max:100',
            'extrusion'       => 'nullable|string|max:100',
            'gresion'         => 'nullable|string|max:100',
            'version'         => 'nullable|string|max:100',
            'migracion'       => 'nullable|string|max:100',
            'retencion'          => 'nullable|boolean',
            'retencion_cual'     => 'nullable|string|max:100',

            // ------------------ CLASIFICACIÓN ANGLE Y CANINA --------
            'canina_der_clase1' => 'nullable|integer|min:0|max:99',
            'canina_der_clase2' => 'nullable|integer|min:0|max:99',
            'canina_der_clase3' => 'nullable|integer|min:0|max:99',
            'canina_izq_clase1' => 'nullable|integer|min:0|max:99',
            'canina_izq_clase2' => 'nullable|integer|min:0|max:99',
            'canina_izq_clase3' => 'nullable|integer|min:0|max:99',
            'molar_der_clase1'  => 'nullable|integer|min:0|max:99',
            'molar_der_clase2'  => 'nullable|integer|min:0|max:99',
            'molar_der_clase3'  => 'nullable|integer|min:0|max:99',
            'molar_izq_clase1'  => 'nullable|integer|min:0|max:99',
            'molar_izq_clase2'  => 'nullable|integer|min:0|max:99',
            'molar_izq_clase3'  => 'nullable|integer|min:0|max:99',

            // ------------------ OVERJET Y OVERBITE -----------------
            'overjet_normal'            => 'nullable|numeric|min:0|max:20',
            'overjet_aumentado'         => 'nullable|numeric|min:0|max:20',
            'overjet_borde'             => 'nullable|numeric|min:0|max:20',
            'overjet_invertido'         => 'nullable|numeric|min:0|max:20',
            'overbite_mordida_abierta'  => 'nullable|numeric|min:0|max:20',
            'overbite_corona_clinica'   => 'nullable|numeric|min:0|max:20',
            'overbite_sobremordida'     => 'nullable|numeric|min:0|max:20',

            // inclinacion molar
            'fila1_derecha_8'          => 'nullable|in:+,N,-',
            'fila1_derecha_7'          => 'nullable|in:+,N,-',
            'fila1_derecha_6'          => 'nullable|in:+,N,-',
            'fila1_izquierda_8'        => 'nullable|in:+,N,-',
            'fila1_izquierda_7'        => 'nullable|in:+,N,-',
            'fila1_izquierda_6'        => 'nullable|in:+,N,-',
            // fila2
            'fila2_derecha_8'          => 'nullable|in:+,N,-',
            'fila2_derecha_7'          => 'nullable|in:+,N,-',
            'fila2_derecha_6'          => 'nullable|in:+,N,-',
            'fila2_izquierda_8'        => 'nullable|in:+,N,-',
            'fila2_izquierda_7'        => 'nullable|in:+,N,-',
            'fila2_izquierda_6'        => 'nullable|in:+,N,-',

            // Desviación Línea Media Dentaria
            'midline_sup_derecha'     => 'nullable|numeric|min:0|max:20',
            'midline_sup_izquierda'   => 'nullable|numeric|min:0|max:20',
            'midline_inf_derecha'     => 'nullable|numeric|min:0|max:20',
            'midline_inf_izquierda'   => 'nullable|numeric|min:0|max:20',

            // Plano Terminal (dentición temporal)
            'plano_mesial_mm'         => 'nullable|numeric|min:0|max:20',
            'plano_distal_mm'         => 'nullable|numeric|min:0|max:20',
            'plano_neutro_mm'         => 'nullable|numeric|min:0|max:20',

            // Pérdida ósea
            'perdida_osea'                  => 'nullable|boolean',
            'perdida_osea_vertical_mm'      => 'nullable|numeric|min:0|max:30',
            'perdida_osea_horizontal_mm'    => 'nullable|numeric|min:0|max:30',

            // Campos tipo radio/texto
            'dilaceracion_radicular' => ['required', 'in:0,1'],
            'dilaceracion_cual'             => 'nullable|string|max:100',
            'reabsorcion_radicular'         => 'required|in:0,1',
            'reabsorcion_cual'              => 'nullable|string|max:100',
            'rarefaccion'                   => 'required|in:0,1',
            'rarefaccion_zona'              => 'nullable|string|max:100',
            'conductos_radicular'           => 'required|in:0,1',
            'conductos_cual'                => 'nullable|string|max:100',
            'longitud_radicular_disminuida' => 'required|in:0,1',
            'longitud_cual'                 => 'nullable|string|max:100',
            'retenedor_intrarradicular'     => 'required|in:0,1',
            'retenedor_cual'                => 'nullable|string|max:100',
            'implante'                      => 'required|in:0,1',
            'implante_zona'                 => 'nullable|string|max:100',
            'observ_radiografico'         => 'nullable|string|max:255',
        ];


        return $rules;
    }

    /**
     * Asegura que todos los radios / checkbox envíen booleanos 0/1 coherentes.
     */
    private function normalizeBooleans(Request $request): void
    {
        $booleanos = [
            'ortodoncia_previa',
            'tiene_aparatologia',
            'desvio_mandibular',
            'desvio_lado_der',
            'desvio_lado_izq',
            'agenesia',
            'hipoplasia',
            'pigmentaciones',
            'mordida_cruzada',
            'mordida_abierta',
            'retencion',
            'dilaceracion_radicular',
            'reabsorcion_radicular',
            'rarefaccion',
            'conductos_radicular',
            'longitud_radicular_disminuida',
            'retenedor_intrarradicular',
            'implante',
        ];

        foreach ($booleanos as $campo) {
            $valor = $request->input($campo);
            // Si viene null, pon '0'
            if (is_null($valor)) {
                $valor = '0';
            }
            // Si viene true/1, pon '1'; si viene false/0, pon '0'
            $request->merge([$campo => ($valor == 1 || $valor === '1') ? '1' : '0']);
        }
    }
}
