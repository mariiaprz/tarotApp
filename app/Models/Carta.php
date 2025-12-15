<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $table = 'carta';

    protected $fillable = [
        'nombre',
        'arcano',
        'palo',
        'significado_derecho',
        'significado_invertido',
        'imagen'
    ];

    // RELACIONES

    // Una carta puede aparecer en muchas tiradas diferentes (tabla intermedia)
    public function cartaLecturas()
    {
        // Relación con el modelo intermedio
        return $this->hasMany(CartaLectura::class, 'idcarta');
    }
}
