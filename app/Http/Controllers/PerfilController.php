<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Animal;
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
        $data = $request->validate(['name' => ['required', 'string', 'max:255']]);

        if ($user->role == 2 && $request->has('remover_cargo')) {
            $user->role = 0;
        }

        $user->name = $data['name'];
        $user->save();

        return redirect()->route('perfil')->with('success', 'Perfil atualizado!');
    }

    public function destroy()
    {
        $user = Auth::user();


        Animal::where('user_id', $user->id)->update([
            'user_id' => null,
            'adotado' => false,
            'status'  => 'pendente'
        ]);

        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'Conta eliminada.');
    }

    public function adotar(Animal $animal)
    {
        if ($animal->adotado) {
            return back()->with('error', 'Este gato já tem um pedido em curso.');
        }


        $animal->update([
            'adotado' => true,
            'user_id' => Auth::id(),
            'status'  => 'pendente'
        ]);

        return redirect()->route('perfil')->with('success', 'Pedido enviado!');
    }

    public function cancelarAdocao(Animal $animal)
    {
        if ($animal->user_id !== auth()->id()) {
            abort(403);
        }

        $animal->update([
            'adotado' => false,
            'user_id' => null,
            'status'  => 'pendente'
        ]);

        return redirect()->route('perfil')->with('success', 'Pedido cancelado.');
    }
}
