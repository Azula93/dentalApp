<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;



use Spatie\Permission\Traits\Permission;

class Paciente extends Model
{
    use HasRoles, HasFactory;

    protected $guard_name = 'web';

    protected $fillable = [
        'nombres',
        'apellidos',
        'di',
        'edad',
        'fecha_nacimiento',
        'estado_civil',
        'sexo',
        'ocupacion',
        'direccion_residencia',
        'celular',
        'email',
        'acudiente',
        'parentesco',
        'ocupacion_acudiente',
        'correo_acudiente',
        'celular_acudiente',
        'eps',
        'tipo_vinculacion',
        'servicio_urgencias',
        'ultima_visita_odontologo',
        'ultimo_tratamiento',
        'como_se_entero',
        'tipo_sangre',
        'historia_enfermedad_actual',
        'motivo_consulta'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($paciente) {
            $contador = self::count() + 1;
            $numeroHistoria = 'HC-' . str_pad($contador, 4, '0', STR_PAD_LEFT);

            while (self::where('numero_historia', $numeroHistoria)->exists()) {
                $contador++;
                $numeroHistoria = 'HC-' . str_pad($contador, 4, '0', STR_PAD_LEFT);
            }

            $paciente->numero_historia = $numeroHistoria;
        });
    }

    public function anamnesis()
    {
        return $this->hasOne(HistoriaAnamnesis::class);
    }

    public function antecedentesMedicos()
    {
        return $this->hasOne(AntecedenteMedico::class, 'paciente_id');
    }

    public function odontograma()
    {
        return $this->hasOne(Odontograma::class);
    }

    public function valoracion()
    {
        return $this->hasOne(Valoracion::class);
    }

    public function diagnosticoHcs()
    {
        return $this->hasMany(DiagnosticoHc::class);
    }

    public function controles()
    {
        return $this->hasMany(Control::class);
    }

    public function facturacions()
    {
        return $this->hasMany(Facturacion::class);
    }

    public function examenendodonticos()
    {
        return $this->hasOne(Examenendodontico::class);
    }

    public function examenperiodontals()
    {
        return $this->hasOne(Examenperiodontal::class);
    }

    public function planTratamiento()
    {
        return $this->hasOne(PlanTratamiento::class);
    }
}
