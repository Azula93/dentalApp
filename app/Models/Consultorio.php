<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'horario_atencion',
        'tipo_consultorio',
        'especialidad',
        'ciudad',
        'capacidad',
        'estado',
        'observaciones',
        'ubicacion'
    ];

    // Relaciones con otros modelos
    public function doctores()
    {
        return $this->hasMany(Doctor::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
