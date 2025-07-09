<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id',
        'monto_asigando',
        'monto_utilizado',
        'mes',
        'anio',
    ];

    // Relacion  muchos a uno con la tabla usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion de muchos a uno con la tabla categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }



}
