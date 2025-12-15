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

                foreach ($cartas as $index => $carta) {
                    // Genera número aleatorio entre 1-100, si es <=20, será carta invertida
                    $invertida = rand(1, 100) <= 20;

                    CartaLectura::create([
                        'idlectura' => $lectura->id,
                        'idcarta'   => $carta->id,
                        'orden'     => $index + 1,
                        'invertida' => $invertida,
                        'nombre_posicion' => 'Posición ' . ($index + 1)
                    ]);
                }
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
