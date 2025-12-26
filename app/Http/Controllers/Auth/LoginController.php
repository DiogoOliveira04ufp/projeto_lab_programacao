<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostra o formulário de login.

    public function show()
    {
        return view('auth.login');
    }

    // Tenta autenticar o utilizador.
    public function login(Request $request)
    {
        // Validação simples
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // Tenta login
        if (Auth::attempt($credentials, $remember)) {
            // Evita session fixation
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // Falhou: devolve erro e mantém o email no input
        return back()
            ->withErrors(['email' => 'Email ou password errados.'])
            ->onlyInput('email');
    }

    
    // Termina a sessão.
    
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida sessão e troca token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
