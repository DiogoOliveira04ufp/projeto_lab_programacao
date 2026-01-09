<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Só Admin (role=1) pode ver o painel de admin
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Lista de utilizadores
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        // Lista de gatos (página independente para não misturar paginações)
        $gatos = Animal::where('especie', 'gato')
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['*'], 'gatos_page');

        return view('pages.admin', compact('users', 'gatos'));
    }

    public function destroy(User $user)
    {
        // Só Admin (role=1) pode eliminar utilizadores
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Impedir que o admin apague o próprio utilizador
        if ((int) auth()->id() === (int) $user->id) {
            return redirect()
                ->route('admin')
                ->with('error', 'Não podes eliminar o teu próprio utilizador.');
        }

        $user->delete();

        return redirect()
            ->route('admin')
            ->with('success', 'Utilizador eliminado com sucesso.');
    }

    public function updateRole(Request $request, User $user)
    {
        // Só Admin (role=1) pode alterar roles
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        // Aceitar: 0 (user), 1 (admin), 2 (voluntário)
        $data = $request->validate([
            'role' => ['required', 'integer', 'in:0,1,2'],
        ]);

        // Impedir que o admin se auto-remova de Admin sem querer
        if ((int) auth()->id() === (int) $user->id && (int) $data['role'] !== User::ROLE_ADMIN) {
            return back()->with('error', 'Não podes remover o teu próprio papel de Admin.');
        }

        $user->role = (int) $data['role'];
        $user->save();

        return back()->with('success', 'Papel atualizado com sucesso.');
    }

    public function storeAnimal(Request $request)
    {
        // Só Admin (role=1) pode criar gatos
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['nullable', 'date'],
            'raca' => ['nullable', 'string', 'max:255'],
            'historico' => ['nullable', 'string'],
            'peso' => ['nullable', 'numeric', 'min:0'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
        ]);

        // Este CRUD é só para gatos
        $data['especie'] = 'gato';

        // Guardar foto no disk "public" (storage/app/public/...)
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('gatos', 'public');
        }

        Animal::create($data);

        return redirect()
            ->route('admin')
            ->with('success', 'Gato criado com sucesso.');
    }

    public function destroyAnimal(Animal $animal)
    {
        // Só Admin (role=1) pode eliminar gatos
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $animal->delete();

        return redirect()
            ->route('admin')
            ->with('success', 'Animal eliminado com sucesso.');
    }
}
