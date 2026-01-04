<?php

namespace App\Http\Controllers;

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
        return view('pages.admin', compact('users'));
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
}