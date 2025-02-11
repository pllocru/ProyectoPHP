<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'cif',
        'name',
        'telefono',
        'email',
        'cuenta_corriente',
        'pais_id',
        'moneda',
        'importe_cuota_mensual',
    ];

    /**
     * Relación con la tabla de países.
     */
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
}

