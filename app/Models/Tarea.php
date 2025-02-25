<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'estado',
        'usuario_id',
        'cliente_id',
        'asignado_a',
        'anotaciones',
    ];

   
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function usuario()
{
    return $this->belongsTo(User::class, 'usuario_id');
}

}
