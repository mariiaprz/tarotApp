<?php

namespace Database\Seeders;

use App\Models\TipoTirada;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTiradaSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiamos la tabla
        DB::table('tipo_tirada')->delete();

        // Definimos los datos en arrays ordenados
        $nombres = [
            'Carta del Día',
            'Pasado, Presente, Futuro',
            'Cruz Simple',
            'Cruz Celta'
        ];

        $num_cartas = [1, 3, 5, 10];

        $descripciones = [
            'Una sola carta para obtener un consejo rápido o una guía para tu jornada.',
            'Tirada clásica que revela la evolución temporal: origen, situación actual y desenlace.',
            'Cinco cartas para una visión general: situación, obstáculo, consejo y resultado.',
            'La tirada más completa para situaciones complejas, cubriendo pasado, influencias y futuro lejano.'
        ];

        // Recorremos y creamos los objetos
        for ($i = 0; $i < count($nombres); $i++) {
            $tipo = new TipoTirada();
            $tipo->nombre = $nombres[$i];
            $tipo->num_cartas = $num_cartas[$i];
            $tipo->descripcion = $descripciones[$i];
            $tipo->imagen = null;

            $tipo->save();
        }
    }
}
