<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartaLectura extends Model
{
    protected $table = 'carta_lectura';

    protected $fillable = [
        'idlectura',
        'idcarta',
        'orden',
        'nombre_posicion',
        'invertida'
    ];

    // RELACIONES

    // Este registro pertenece a una lectura específica
    public function lectura()
    {
        // 'idlectura' conecta con el modelo Lectura
        return $this->belongsTo(Lectura::class, 'idlectura');
    }

    // Este registro pertenece a una carta específica
    public function carta()
    {
        // 'idcarta' conecta con el modelo Carta
        return $this->belongsTo(Carta::class, 'idcarta');
    }
}
