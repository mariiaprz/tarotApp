<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Tema;
use App\Models\Carta;

class MainController extends Controller
{
    // Este método carga la portada y envía los temas
    public function index(): View
    {
        // Pedimos todos los temas a la base de datos
        $temas = Tema::all();

        // Cogemos 4 cartas aleatorias de la base de datos
        $cartasGuia = Carta::inRandomOrder()->take(4)->get();

        // Se pasan ambas variables a la vista
        return view('welcome', ['temas' => $temas, 'cartasGuia' => $cartasGuia]);
    }
}
