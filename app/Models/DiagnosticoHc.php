<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoHc extends Model
{
    use HasFactory;

    protected $table = 'diagnostico_hc';
    protected $fillable = ['paciente_id', 'procedimiento', 'diagnostico', 'solucion'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
