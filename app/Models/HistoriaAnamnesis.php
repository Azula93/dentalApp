<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaAnamnesis extends Model
{
    use HasFactory;

    protected $table = 'historia_anamnesis';

    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'historia_enfermedad_actual',

    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
