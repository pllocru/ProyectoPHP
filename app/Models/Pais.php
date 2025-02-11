<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'moneda',
    ];

    /**
     * Relación con clientes (un país puede tener varios clientes).
     */
    public function clientes()
    {
        return $this->hasMany(Client::class, 'pais_id');
    }
}
