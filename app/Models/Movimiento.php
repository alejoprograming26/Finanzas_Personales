<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Movimiento extends Model
{
    protected $fillable = [
        'user_id',
        'categoria_id',
        'tipo',
        'monto',
        'descripcion',
        'foto',
        'fecha',

    ];
    //Relacion muchos a uno con la tabla usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relacion muchos a uno con la tabla categorias
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
protected static function booted()
{
    static::created(function ($movimiento) {
        if ($movimiento->tipo === 'gasto') {
            // Buscar el presupuesto correspondiente
            $presupuesto = Presupuesto::where('user_id', $movimiento->user_id)
                ->where('categoria_id', $movimiento->categoria_id)
                ->where('mes', now()->format('F')) // Usar el mes actual
                ->where('anio', now()->year)
                ->first();

            // Si existe el presupuesto, actualizar el monto gastado
            if ($presupuesto) {
                $presupuesto->monto_utilizado += $movimiento->monto;
                $presupuesto->save();
            }
        }
    });
}
}
