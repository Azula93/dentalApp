<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin',
        'consultorio_id',
        'doctor_id'
    ];
    // Relaciones con otros modelos
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
