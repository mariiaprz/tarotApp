<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    function showRegister(): View
    {
        return view('auth.register');
    }

    // Procesar registro
    function register(Request $request): RedirectResponse
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::login($user);
            $txtmessage = 'Registro exitoso.';
            $result = true;
        } catch (\Exception $e) {
            $txtmessage = 'Error al registrar: ' . $e->getMessage();
            $result = false;
        }

        $message = ['mensajeTexto' => $txtmessage];

        if ($result) {
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    // Mostrar formulario de login
    function showLogin(): View
    {
        return view('auth.login');
    }

    // Procesar login
    function login(Request $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('main')->with(['mensajeTexto' => 'Bienvenido!']);
        }

        return back()->withErrors(['mensajeTexto' => 'Credenciales incorrectas.'])->withInput();
    }

    // Cerrar sesión
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('main')->with(['mensajeTexto' => 'Sesión cerrada.']);
    }
}
