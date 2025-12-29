<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email não é válido.',
            'password.required' => 'A palavra-passe é obrigatória.',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Email ou palavra-passe incorretos.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function showRegister()
    {
        // o teu ficheiro chama-se "registo.blade.php"
        return view('pages.registo');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email não é válido.',
            'email.unique' => 'Esse email já está registado.',
            'password.required' => 'A palavra-passe é obrigatória.',
            'password.min' => 'A palavra-passe tem de ter pelo menos 6 caracteres.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            // o teu User já tem cast "hashed", mas isto também é ok
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
