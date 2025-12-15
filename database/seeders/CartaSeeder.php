<?php

namespace Database\Seeders;

use App\Models\Carta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carta')->delete();

        $nombres = [
            'El Loco',
            'El Mago',
            'La Emperatriz',
            'El Sumo Sacerdote',
            'El Carro',
            'El Ermitaño',
            'La Muerte',
            'La Templanza',
            'La Torre',
            'La Luna',
            'El Sol',
            'El Mundo'
        ];

        $sig_derecho = [
            'Nuevos comienzos, inocencia, espontaneidad, espíritu libre.', // El Loco
            'Manifestación, ingenio, poder, acción inspirada.', // El Mago
            'Feminidad, belleza, naturaleza, abundancia.', // La Emperatriz
            'Tradición, conformidad, moralidad, ética.', // El Sumo Sacerdote
            'Control, voluntad, victoria, asertividad.', // El Carro
            'Introspección, búsqueda interior, soledad, guía.', // El Ermitaño
            'Fin, transición, eliminación, metamorfosis.', // La Muerte
            'Equilibrio, moderación, paciencia, propósito.', // La Templanza
            'Cambio repentino, agitación, caos, revelación.', // La Torre
            'Ilusión, miedo, ansiedad, subconsciente, intuición.', // La Luna
            'Positividad, diversión, calidez, éxito, vitalidad.', // El Sol
            'Completitud, integración, logro, viaje.' // El Mundo
        ];

        $sig_invertido = [
            'Imprudencia, asunción de riesgos, ingenuidad.', // El Loco
            'Manipulación, mala planificación, talentos latentes.', // El Mago
            'Dependencia creativa, bloqueo, descuido.', // La Emperatriz
            'Rebelión, subversión, nuevos enfoques.', // El Sumo Sacerdote
            'Falta de control, agresión, falta de dirección.', // El Carro
            'Aislamiento, soledad, retirada, rechazo.', // El Ermitaño
            'Resistencia al cambio, incapacidad para seguir adelante.', // La Muerte
            'Desequilibrio, exceso, falta de visión a largo plazo.', // La Templanza
            'Miedo al cambio, evitar el desastre, retraso.', // La Torre
            'Liberación del miedo, infelicidad, confusión.', // La Luna
            'Pesimismo, falta de realismo, tristeza temporal.', // El Sol
            'Falta de cierre, falta de logro, vacío.' // El Mundo
        ];

        $imagenes = [
            'el_loco.jpg',
            'el_mago.jpg',
            'la_emperatriz.jpg',
            'el_sumo_sacerdote.jpg',
            'el_carro.jpg',
            'el_ermitano.jpg',
            'la_muerte.jpg',
            'la_templanza.jpg',
            'la_torre.jpg',
            'la_luna.jpg',
            'el_sol.jpg',
            'el_mundo.jpg'
        ];

        for ($i = 0; $i < count($nombres); $i++) {
            $carta = new Carta();
            $carta->nombre = $nombres[$i];
            $carta->arcano = 'mayor';
            $carta->palo = null;
            $carta->significado_derecho = $sig_derecho[$i];
            $carta->significado_invertido = $sig_invertido[$i];
            $carta->imagen = 'assets/images/cartas/' . $imagenes[$i];

            $carta->save();
        }
    }
}
