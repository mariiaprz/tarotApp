<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemaSeeder extends Seeder
{

    public function run(): void
    {

        DB::table('tema')->delete(); // Para que no de error al volver a hacer el seeder por restricciones (claves duplicadas)

        $nombres = ['Amor', 'Trabajo', 'Dinero', 'Salud', 'Espiritualidad', 'General'];

        $iconos = ['ti-heart', 'ti-briefcase', 'ti-money', 'ti-pulse', 'ti-eye', 'ti-star'];

        $descripciones = [
            'Relaciones, pareja y sentimientos.',
            'Carrera profesional y proyectos.',
            'Economía, inversiones y fortuna.',
            'Bienestar físico y energía vital.',
            'Crecimiento personal, karma y misión.',
            'Mensaje abierto del universo.'
        ];

        for ($i = 0; $i < count($nombres); $i++) {
            $tema = new Tema();
            $tema->nombre = $nombres[$i];
            $tema->descripcion = $descripciones[$i];
            $tema->icono = $iconos[$i];
            $tema->save();
        }
    }
}
