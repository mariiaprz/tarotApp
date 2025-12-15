<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    protected $table = 'lectura';

    protected $fillable = [
        'iduser',
        'idtema',
        'idtipo_tirada',
        'pregunta',
        'interpretacion'
    ];

    // RELACIONES
    
    // Una lectura pertenece a un usuario
    public function user()
    {
        // 'iduser' es la clave foránea en esta tabla
        return $this->belongsTo(User::class, 'iduser');
    }

    // Una lectura pertenece a un tema (Amor, Dinero...)
    public function tema()
    {
        // 'idtema' es la clave foránea en esta tabla
        return $this->belongsTo(Tema::class, 'idtema');
    }

    // Una lectura pertenece a un tipo de tirada (Cruz Celta, 3 cartas...)
    public function tipoTirada()
    {
        // 'idtipo_tirada' es la clave foránea en esta tabla
        return $this->belongsTo(TipoTirada::class, 'idtipo_tirada');
    }

    // Una lectura tiene muchas cartas asociadas (a través de la tabla intermedia)
    public function cartaLecturas()
    {
        // Relación con el modelo intermedio CartaLectura
        return $this->hasMany(CartaLectura::class, 'idlectura');
    }
}
