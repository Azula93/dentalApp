<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenteMedico extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_medicos';

    protected $fillable = [
        'paciente_id',
        'alergias',
        'trastornos_coagulacion',
        'enf_respiratorias',
        'alteraciones_cardiacas',
        'fiebre_reumatica',
        'cirugias',
        'enf_renal',
        'hepatitis',
        'trastornos_gastricos',
        'hipertension',
        'diabetes',
        'hospitalizaciones',
        'tto_farmacologico_actual',
        'tto_medico_actual',
        'vih_sida',
        'cancer',
        'fuma',
        'embarazo',
        'otra_patologia',
        'antecedentes_personales_otro',
        'fam_cardiovasculares',
        'fam_oncologicos',
        'fam_endocrinos',
        'fam_psiquiatricos',
        'fam_hematologicos',
        'fam_neurologicos',
        'fam_autoinmunes',
        'fam_otros',
        'antecedentes_familiares_otro',
        'observaciones',

    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
