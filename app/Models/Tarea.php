<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'persona_contacto',
        'telefono_contacto',
        'correo_contacto',
        'direccion',
        'poblacion',
        'codigo_postal',
        'provincia',
        'descripcion',
        'estado',
        'fecha_creacion',
        'fecha_realizacion',
        'anotaciones_anteriores',
        'anotaciones_posteriores',
        'fichero_resumen',
        'fecha_actualizacion'
    ];

    protected $dates = [
        'fecha_creacion',
        'fecha_realizacion',
        'fecha_actualizacion'
    ];

    protected $casts = [
        'anotaciones_anteriores' => 'array',
        'anotaciones_posteriores' => 'array'
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
