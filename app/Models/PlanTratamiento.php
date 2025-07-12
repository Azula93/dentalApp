<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'ortodoncia_correctiva',
        'compensacion_ortodoncia',
        'ortopedia_dentofacial',
        'cirugia_ortognatica',
        'objetivos',
        'exodoncias',
        'posibles_exodoncias',
        'sin_exodoncias',
        'aparatologia_complementaria',
        'contencion',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
