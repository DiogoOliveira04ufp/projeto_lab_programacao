<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {

        return view('pages.perfil', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);


        if ($user->role == 2 && $request->has('remover_cargo')) {
            $user->role = 0;
        }

        $user->name = $data['name'];
        $user->save();

        return redirect()->route('perfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy()
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'A sua conta foi eliminada.');
    }
}
