<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'control_id',
        'fecha_emision',
        'fecha_pago',
        'subtotal',
        'descuento',
        'impuesto',
        'monto',
        'metodo_pago',
        'referencia_pago',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'fecha_emision' => 'date',   // convierte a Carbon
        'fecha_pago'    => 'date',
    ];

    public function items()
    {
        return $this->hasMany(FacturaItem::class, 'factura_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    protected static function booted()
    {
        static::created(function ($factura) {
            // Genera y salva el numero_recibo justo después de creado
            $factura->numero_recibo = 'RC-' . str_pad($factura->id, 6, '0', STR_PAD_LEFT);
            $factura->saveQuietly(); // evita loop de eventos
        });
    }
}
