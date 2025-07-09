<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaItem extends Model
{
    use HasFactory;

    public function facturacion()
    {
        return $this->belongsTo(Facturacion::class, 'factura_id');
    }
}
