<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{

    // Define qué rutas necesitan estar logueado y verificado
    function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->middleware('verified')->only(['edit', 'update']);
    }

    // Muestra el formulario de edición
    function edit(): View
    {
        return view('auth.edit');
    }

    // Muestra el perfil/dashboard
    function index(): View
    {
        return view('auth.home');
    }

    // Guarda los cambios
    function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $rules = [
            'name'            => 'required|max:255',
            'email'           => 'required|max:255|email',
            'currentpassword' => 'nullable|current_password', // Valida que la clave actual sea real
            'password'        => 'nullable|min:8|confirmed'   // Valida que la nueva coincida con el confirm
        ];

        $messages = [
            'name.required'                  => 'El nombre es obligatorio',
            'name.max'                       => 'El nombre es demasiado largo',
            'email.required'                 => 'El email es obligatorio',
            'email.max'                      => 'El email es demasiado largo',
            'email.email'                    => 'El formato del email no es válido',
            'currentpassword.current_password' => 'La contraseña actual no es correcta',
            'password.min'                   => 'La nueva contraseña debe tener al menos 8 caracteres',
            'password.confirmed'             => 'Las nuevas contraseñas no coinciden',
        ];

        // Ejecutar validador
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // Asignar nuevos valores
        $user->name = $request->name;

        // Si cambia el email, invalidamos la verificación
        if ($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        // Solo cambiamos la contraseña si ha rellenado los dos campos
        if ($request->password != null && $request->currentpassword != null) {
            $user->password = Hash::make($request->password);
        }

        // Intentar guardar
        try {
            $result = $user->save();
            $message = 'Perfil actualizado correctamente';
        } catch (\Exception $e) {
            $message = 'No se pudo actualizar el perfil';
            $result = false;
        }

        $messageArray = [
            'general' => $message
        ];

        if ($result) {
            return redirect()->route('home')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
}
