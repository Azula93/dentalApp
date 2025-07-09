<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $table = 'valoraciones';

    protected $fillable = [
        'paciente_id',

        // ortodoncia previa
        'ortodoncia_previa',
        'tiene_aparatologia',
        'tiempo_aparatologia',

        // examen facial
        'perfil_facial',

        // tipo esqueletico
        'sna',
        'snb',
        'anb',
        'clase1_mm',
        'clase2_mm',
        'clase3_mm',

        // asimetria facial
        'desvio_mandibular',
        'desvio_lado_der',
        'desvio_mm_der',
        'desvio_lado_izq',
        'desvio_mm_izq',
        'tipo_cara',
        'labio_superior',
        'labio_inferior',

        // examen intraoral
        'denticion',
        'api_sup',
        'api_inf',
        'dias_sup',
        'dias_inf',
        'agenesia',
        'agenesia_cual',
        'hipoplasia',
        'hipoplasia_cual',
        'pigmentaciones',
        'dientes_erupcion',
        'dientes_ausentes',
        'mordida_cruzada',
        'mordida_cruzada_tipo',
        'mordida_cruzada_lado',
        'mordida_abierta',
        'mordida_abierta_tipo',
        'mordida_abierta_lado',
        'rotacion',
        'intrusion',
        'extrusion',
        'gresion',
        'version',
        'migracion',
        'retencion',
        'retencion_cual',

        // CLASIFICACION ANGLE Y CANINA
        'canina_der_clase1',
        'canina_der_clase2',
        'canina_der_clase3',
        'canina_izq_clase1',
        'canina_izq_clase2',
        'canina_izq_clase3',
        'molar_der_clase1',
        'molar_der_clase2',
        'molar_der_clase3',
        'molar_izq_clase1',
        'molar_izq_clase2',
        'molar_izq_clase3',

        // overjet y overbite
        'overjet_normal',
        'overjet_aumentado',
        'overjet_borde',
        'overjet_invertido',
        'overbite_mordida_abierta',
        'overbite_corona_clinica',
        'overbite_sobremordida',

        // inclinacion molar
        'fila1_derecha_8',
        'fila1_derecha_7',
        'fila1_derecha_6',
        'fila1_izquierda_8',
        'fila1_izquierda_7',
        'fila1_izquierda_6',
        // fila2
        'fila2_derecha_8',
        'fila2_derecha_7',
        'fila2_derecha_6',
        'fila2_izquierda_8',
        'fila2_izquierda_7',
        'fila2_izquierda_6',

        // desviacion linea media dentaria y plano mesial
        'midline_sup_derecha',
        'midline_sup_izquierda',
        'midline_inf_derecha',
        'midline_inf_izquierda',
        'plano_mesial_mm',
        'plano_distal_mm',
        'plano_neutro_mm',

        // examen radiografico
        'perdida_osea',
        'perdida_osea_vertical_mm',
        'perdida_osea_horizontal_mm',
        'dilaceracion_radicular',
        'dilaceracion_cual',
        'reabsorcion_radicular',
        'reabsorcion_cual',
        'rarefaccion',
        'rarefaccion_zona',
        'conductos_radicular',
        'conductos_cual',
        'longitud_radicular_disminuida',
        'longitud_cual',
        'retenedor_intrarradicular',
        'retenedor_cual',
        'implante',
        'implante_zona',
        'observ_radiografico',

    ];

    protected $casts = [
        // ortodoncia previa
        'ortodoncia_previa'    => 'boolean',
        'tiene_aparatologia'   => 'boolean',
        'desvio_mandibular'    => 'boolean',
        'tiempo_aparatologia' => 'string',

        // examen facial
        'perfil_facial',

        // tipo esqueletico
        'sna'        => 'float',
        'snb'        => 'float',
        'anb'        => 'float',
        'clase1_mm'  => 'float',
        'clase2_mm'  => 'float',
        'clase3_mm'  => 'float',

        // asimetria facial
        'desvio_mandibular' => 'boolean',
        'desvio_lado_der' => 'boolean',
        'desvio_mm_der'   => 'float',
        'desvio_lado_izq' => 'boolean',
        'desvio_mm_izq'   => 'float',
        'tipo_cara'         => 'string',
        'labio_superior'    => 'string',
        'labio_inferior'    => 'string',

        // examen intraoral
        'denticion' => 'string',
        'api_sup'   => 'string',
        'api_inf'   => 'string',
        'dias_sup'  => 'string',
        'dias_inf'  => 'string',
        'agenesia'            => 'boolean',
        'hipoplasia'          => 'boolean',
        'pigmentaciones'      => 'boolean',
        'mordida_cruzada'     => 'boolean',
        'mordida_abierta'     => 'boolean',
        'retencion'           => 'boolean',
        'retencion_cual'       => 'string',

        // CLASIFICACION ANGLE Y CANINA
        'canina_der_clase1' => 'integer',
        'canina_der_clase2' => 'integer',
        'canina_der_clase3' => 'integer',
        'canina_izq_clase1' => 'integer',
        'canina_izq_clase2' => 'integer',
        'canina_izq_clase3' => 'integer',
        // molar
        'molar_der_clase1' => 'integer',
        'molar_der_clase2' => 'integer',
        'molar_der_clase3' => 'integer',
        'molar_izq_clase1' => 'integer',
        'molar_izq_clase2' => 'integer',
        'molar_izq_clase3' => 'integer',

        // overjet y overbite
        'overjet_normal'            => 'float',
        'overjet_aumentado'         => 'float',
        'overjet_borde'             => 'float',
        'overjet_invertido'         => 'float',
        'overbite_mordida_abierta'  => 'float',
        'overbite_corona_clinica'   => 'float',
        'overbite_sobremordida'     => 'float',



        // desviacion linea media dentaria y plano mesial
        'midline_sup_derecha'   => 'float',
        'midline_sup_izquierda' => 'float',
        'midline_inf_derecha'   => 'float',
        'midline_inf_izquierda' => 'float',
        'plano_mesial_mm'       => 'float',
        'plano_distal_mm'       => 'float',
        'plano_neutro_mm'       => 'float',

        // examen radiografico
        'perdida_osea'                  => 'boolean',
        'perdida_osea_vertical_mm'      => 'float',
        'perdida_osea_horizontal_mm'    => 'float',

        'dilaceracion_radicular'        => 'integer',
        'reabsorcion_radicular'         => 'integer',
        'rarefaccion'                   => 'integer',
        'conductos_radicular'           => 'integer',
        'longitud_radicular_disminuida' => 'integer',
        'retenedor_intrarradicular'     => 'integer',
        'implante'                      => 'integer',

    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
