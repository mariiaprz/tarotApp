<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTirada extends Model
{
    protected $table = 'tipo_tirada';

    protected $fillable = [
        'nombre',
        'descripcion',
        'num_cartas',
        'imagen'
    ];

    // RELACIONES

    // Un tipo de tirada se usa en muchas lecturas
    public function lecturas()
    {
        // 'idtipo_tirada' es la clave foránea en la tabla lecturas
        return $this->hasMany(Lectura::class, 'idtipo_tirada');
    }
}
