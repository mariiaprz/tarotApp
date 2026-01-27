<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLecturaRequest;
use App\Models\Lectura;
use App\Models\Tema;
use App\Models\Carta;
use App\Models\TipoTirada;
use App\Models\CartaLectura;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Para llamadas HTTP externas (API de Google Gemini)
use Illuminate\View\View;

class LecturaController extends Controller
{
    public function __construct()
    {
        // Solo usuarios logueados y con email verificado pueden entrar
        $this->middleware(['auth', 'verified']);
    }

    // INDEX
    function index(): View
    {
        // Obtiene usuario conectado actualmente
        $user = Auth::user();
        // Busca lecturas del tema asociado, más recientes primero
        $lecturas = Lectura::where('iduser', $user->id)
            ->with('tema')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('lectura.index', ['lecturas' => $lecturas]);
    }

    // CREATE (Formulario)
    function create($idtema): View
    {
        // Busca el tema
        $tema = Tema::find($idtema);

        // Comprueba si existe. Si es null, damos error 404
        if ($tema == null) {
            abort(404);
        }

        $tipos = TipoTirada::all();

        return view('lectura.create', ['tema' => $tema, 'tipos' => $tipos]);
    }

    // STORE
    function store(StoreLecturaRequest $request): RedirectResponse
    {

        // Instancia con los datos del formulario
        $lectura = new Lectura($request->all());
        // Asigna el usuario
        $lectura->iduser = Auth::id();

        // Valor por defecto si la pregunta está vacía
        if (empty($lectura->pregunta)) {
            $lectura->pregunta = 'Consulta general';
        }

        $result = false;
        $txtmessage = '';

        try {
            // Guarda la Lectura base
            $result = $lectura->save();

            // Barajamos solo lo hacemos si la lectura se guardó bien
            if ($result) {
                // Buscamos el tipo de tirada
                $tipoTirada = TipoTirada::find($request->idtipo_tirada);
                // Definimos cantidad según num_cartas específico de la tirada
                $cantidad = $tipoTirada->num_cartas;

                // Saca la cantidad de cartas aleatorias indicada
                $cartas = Carta::inRandomOrder()->take($cantidad)->get();

                // Variable para enviar a IA
                $cartasParaIA = "";

                foreach ($cartas as $index => $carta) {
                    // Genera número aleatorio entre 1-100, si es <=20, será carta invertida
                    $invertida = rand(1, 100) <= 20;

                    // Guardamos la carta en la BD
                    CartaLectura::create([
                        'idlectura' => $lectura->id,
                        'idcarta'   => $carta->id,
                        'orden'     => $index + 1,
                        'invertida' => $invertida,
                        'nombre_posicion' => 'Posición ' . ($index + 1)
                    ]);

                    // Preparamos texto para IA
                    $estado = $invertida ? "(Invertida)" : "(Al derecho)";
                    $cartasParaIA .= "- " . $carta->nombre . " $estado\n";
                }

                // Llamada a API de IA (Google Gemini) para interpretación
                try {
                    $temaNombre = $lectura->tema->nombre;
                    $prompt = "Actúa como una experta tarotista mística.
                    DATOS:
                    - Tema: $temaNombre
                    - Pregunta: '{$lectura->pregunta}'
                    - Tirada: {$tipoTirada->nombre}
                    - Cartas: 
                    $cartasParaIA

                    INSTRUCCIONES DE FORMATO (IMPORTANTE):
                    1. Usa etiquetas HTML <h3> para el nombre de cada carta.
                    2. Usa <p> para la explicación de cada carta.
                    3. Si das consejos, usa una lista <ul> con <li>.
                    4. Usa <strong> para resaltar palabras clave.
                    5. No uses Markdown, solo HTML.

                    CONTENIDO:
                    Responde a la pregunta, interpreta las cartas una por una y da una conclusión final.";

                    $apiKey = env('GEMINI_API_KEY');

                    // Realizamos la petición POST a la API de Google Gemini, previamente indicando formato JSON
                    $response = Http::withHeaders(['Content-Type' => 'application/json'])
                        ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}", [
                            'contents' => [
                                ['parts' => [['text' => $prompt]]]
                            ]
                        ]);

                    // Guardamos la respuesta si todo va bien
                    if ($response->successful()) {
                        $lectura->interpretacion = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                    } else {
                        $errorReal = $response->body();
                        $lectura->interpretacion = "<p><strong>ERROR DE GOOGLE:</strong> $errorReal</p>";
                        // $lectura->interpretacion = "<p>El oráculo está en silencio (Error de conexión con la IA).</p>";
                    }
                } catch (\Exception $eIA) {
                    // Si falla la IA, no bloqueamos la lectura, solo ponemos un mensaje
                    $lectura->interpretacion = "<p>Los astros no han podido revelar el mensaje completo en este momento. Guíate por tu intuición.</p>";
                }

                // Guardamos la lectura de nuevo con la interpretación actualizada
                $lectura->save();

                $txtmessage = 'Las cartas han hablado.';
            }
        } catch (UniqueConstraintViolationException $e) {
            $txtmessage = 'Error de duplicidad de datos.';
            $result = false;
        } catch (QueryException $e) {
            $txtmessage = 'Error en la base de datos (datos inválidos).';
            $result = false;
        } catch (\Exception $e) {
            $txtmessage = 'Ha ocurrido un error inesperado al tirar las cartas.';
            $result = false;
        }

        $message = [
            'mensajeTexto' => $txtmessage,
        ];

        if ($result) {
            // Si todo fue bien, vamos al resultado (show)
            return redirect()->route('lectura.show', $lectura->id)->with($message);
        } else {
            // Si falló, volvemos atrás con errores
            return back()->withInput()->withErrors($message);
        }
    }

    // SHOW
    function show(Lectura $lectura): View
    {
        // Validación de seguridad
        if ($lectura->iduser !== Auth::id()) {
            abort(403); // Prohibido ver lecturas de otros
        }

        return view('lectura.show', ['lectura' => $lectura]);
    }

    // DESTROY
    function destroy(Lectura $lectura): RedirectResponse
    {
        if ($lectura->iduser !== Auth::id()) {
            return back()->withErrors(['mensajeTexto' => 'No tienes permiso.']);
        }

        $result = false;

        try {
            $result = $lectura->delete();
            $txtmessage = 'La lectura se ha eliminado correctamente.';
        } catch (\Exception $e) {
            $txtmessage = 'La lectura no se ha podido eliminar.';
            $result = false;
        }

        $message = [
            'mensajeTexto' => $txtmessage,
        ];

        if ($result) {
            return redirect()->route('lectura.index')->with($message);
        } else {
            return back()->withErrors($message);
        }
    }
}
