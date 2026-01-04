<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, [1, 2])) {
            abort(403);
        }

        $users = User::orderBy('created_at', 'desc')->paginate(20);
        $gatos = Animal::where('especie', 'gato')
                    ->orderBy('created_at', 'desc')
                    ->paginate(20, ['*'], 'gatos_page');

        return view('pages.admin', compact('users', 'gatos'));
    }

    public function destroy(\App\Models\User $user)
    {
        if (!in_array(auth()->user()->role, [1, 2])) {
            abort(403);
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('admin')->with('error', 'Não podes eliminar o teu próprio utilizador.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'Utilizador eliminado com sucesso.');
    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 1) {
            abort(403);
        }

        $data = $request->validate([
            'role' => 'required|integer|in:0,1',
        ]);

        $user->role = (int) $data['role'];
        $user->save();

        return back()->with('status', 'Papel atualizado com sucesso.');
    }

    public function storeAnimal(Request $request)
    {
        if (!in_array(auth()->user()->role, [1, 2])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'raca' => 'nullable|string|max:255',
            'historico' => 'nullable|string',
            'peso' => 'nullable|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data['especie'] = 'gato';

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('gatos', 'public');
        }

        Animal::create($data);

        return redirect()->route('admin')->with('success', 'Gato criado com sucesso.');
    }

    public function destroyAnimal(Animal $animal)
    {
        if (!in_array(auth()->user()->role, [1, 2])) {
            abort(403);
        }

        $animal->delete();

        return redirect()->route('admin')->with('success', 'Animal eliminado com sucesso.');
    }
}