<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'tema';

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono'
    ];

    // RELACIONES

    // Un tema puede tener muchas lecturas asociadas
    public function lecturas()
    {
        // 'idtema' es la clave foránea en la tabla lecturas
        return $this->hasMany(Lectura::class, 'idtema');
    }
}
