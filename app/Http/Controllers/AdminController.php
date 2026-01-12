<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    private $racasPermitidas = [
        'Abyssinian', 'American Bobtail', 'American Bobtail Shorthair', 'American Curl',
        'American Curl Longhair', 'American Shorthair', 'American Wirehair', 'Australian Mist',
        'Balinese', 'Bengal','Bengal Longhair', 'Birman', 'Bombay', 'British Longhair', 'British Shorthair',
        'Burmese', 'Burmilla','Burmilla Longhair','Chartreux', 'Chausie','Cherubim','Cornish Rex','Cymric',
        'Devon Rex','Donskoy','Egyptian Mau','Exotic Shorthair','Havana','Highlander','Highlander Shorthair',
        'Himalayan','Household Pet', 'Japanese Bobtail','Japanese Bobtail Longhair','Khaomanee','Korat',
        'Kurilian Bobtail','Kurilian Bobtail Longhair','LaPerm','LaPerm Shorthair','Maine Coon',
        'Maine Coon Polydactyl','Manx','Minuet','Minuet Longhair','Munchkin','Munchkin Longhair',
        'Nebelung','Norwegian Forest','Ocicat','Oriental Longhair','Oriental Shorthair','Persian',
        'Peterbald','Pixiebob','Pixiebob Longhair','Ragdoll','Russian Blue','Savannah','Scottish Fold',
        'Scottish Fold Longhair','Scottish Straight','Scottish Straight Longhair','Selkirk Rex','Selkirk Rex Longhair',
        'Serengeti','Siamese','Siberian','Singapura','Snowshoe','Somali','Sphynx','Tennessee Rex','Thai',
        'Tonkinese','Toybob','Toyger','Turkish Angora','Turkish Van'
        ];

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

        $racasDisponiveis = $this->racasPermitidas;

        return view('pages.admin', compact('users', 'gatos', 'racasDisponiveis'));
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
        if (auth()->user()->role !== 1) {
            abort(403);
        }

        $data = $request->validate([
            'role' => 'required|integer|in:0,1,2',
        ]);

        $user->role = (int) $data['role'];
        $user->save();

        $nomeDoPapel = $this->getRoleName($user->role);

       return back()->with('status', "O utilizador {$user->name} agora é {$nomeDoPapel}.");
    }

    private function getRoleName($role)
    {
    return match($role) {
        1 => 'Administrador',
        2 => 'Voluntário',
        0 => 'Utilizador Comum',
        default => 'Desconhecido',
    };
    }

    public function storeAnimal(Request $request)
    {
        // Só Admin (role=1) pode criar gatos
        if (!auth()->check() || (int) auth()->user()->role !== User::ROLE_ADMIN) {
            abort(403);
        }

        $racasValidas = $this->racasPermitidas;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'data_nascimento' => ['nullable', 'date'],
            'raca' => ['required', 'string', 'in:' . implode(',', $racasValidas)],
            'historico' => ['required', 'string','min:3'],
            'peso' => ['nullable', 'numeric', 'min:0'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
        ],
        [
            'raca.in' => 'A raça selecionada não é válida. Por favor, escolha uma raça da lista fornecida.',

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
