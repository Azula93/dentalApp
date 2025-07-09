<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examenperiodontal extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'otros',
        'calculos_superior',
        'sensibilidad_superior',
        'trauma_superior',
        'furca_superior',
        'bolsa_superior',
        'movilidad_superior',
        'exudado_superior',
        'hemorragia_superior',
        'agrandamientoG_superior',
        'retraccion_superior',
        'biotipo_superior',
        'pronostico_superior',

        'otros_inferior',
        'calculos_inferior',
        'sensibilidad_inferior',
        'trauma_inferior',
        'furca_inferior',
        'bolsa_inferior',
        'movilidad_inferior',
        'exudado_inferior',
        'hemorragia_inferior',
        'agrandamientoG_inferior',
        'retraccion_inferior',
        'biotipo_inferior',
        'pronostico_inferior'
    ];

    protected $casts = [
        'fecha' => 'date',   // para que Eloquent devuelva Carbon
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
