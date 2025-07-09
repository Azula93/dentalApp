<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examenendodontico extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'otros_superior',
        'movilidad_superior',
        'palpacion_superior',
        'percusion_superior',
        'fistula_superior',
        'calor_superior',
        'frio_superior',
        'electricidad_superior',
        'color_superior',
        'cavitaria_superior',
        'trauma_superior',
        'pronostico_superior',
        'otros_inferior',
        'movilidad_inferior',
        'palpacion_inferior',
        'percusion_inferior',
        'fistula_inferior',
        'calor_inferior',
        'frio_inferior',
        'electricidad_inferior',
        'color_inferior',
        'cavitaria_inferior',
        'trauma_inferior',
        'pronostico_inferior',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'date',   // para que Eloquent devuelva Carbon
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
