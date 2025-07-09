<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontograma extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',

        'labios',
        'carrillos',
        'paladar_duro',
        'lengua',
        'piso_boca',
        'glandulas_salivares',
        'orofaringe',
        'ruido_articular',
        'dolor_articular',
        'dolor_muscular',
        'alteraciones_movimiento',
        'ultima_visita_odontologo',
        'observaciones_estomatologico',
        'higiene_oral',
        'seda_dental',
        'sangrado_gingival',
        'odontalgia',
        'odontalgia_cual',
        'frecuencia_cepillado',
        'tooth_tools',            // <— lo añadimos
        'observaciones_odontograma',
        'initial',
        'final'
    ];

    protected $casts = [
        'initial' => 'array',
        'final'    => 'array',
        'tooth_tools'          => 'array',

    ];


    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
