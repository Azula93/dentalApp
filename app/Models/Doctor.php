<?php

namespace App\Models;

use App\Models\Consultorio;
use App\Models\Horario;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'email',
        'especialidad',
        'cedula',
        'direccion',

    ];
    // Relaciones con otros modelos
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function controles()
    {
        return $this->hasMany(Control::class);
    }

    public function facturacions()
    {
        return $this->hasMany(Facturacion::class);
    }
}
