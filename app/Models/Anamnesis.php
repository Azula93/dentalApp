<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use HasFactory;

    protected $table = 'anamnesis';

    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'historia_enfermedad_actual',
        // otros campos si necesitas
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
