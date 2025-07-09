<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
    ];

    // Relación de uno a muchos con la tabla movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }


}
