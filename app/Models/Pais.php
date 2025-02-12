<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'paises'; // 🔹 Especificamos la tabla correcta

    protected $fillable = [
        'iso2',
        'iso3',
        'prefijo',
        'nombre',
        'continente',
        'subcontinente',
        'iso_moneda',
        'nombre_moneda'
    ];
}
