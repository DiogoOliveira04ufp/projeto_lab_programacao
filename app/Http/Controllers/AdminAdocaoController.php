<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AdminAdocaoController extends Controller
{
    public function index()
    {

        $pedidos = Animal::whereNotNull('user_id')
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('pages.admin_adocao', compact('pedidos'));
    }

    public function updateStatus(Request $request, Animal $animal)
    {
        $request->validate([
            'status' => 'required|in:aprovado,rejeitado',
        ]);

        if ($request->status === 'rejeitado') {

            $animal->update([
                'status' => 'pendente',
                'adotado' => false,
                'user_id' => null
            ]);
            return back()->with('success', 'Pedido rejeitado. O gato está novamente disponível.');
        }


        $animal->update(['status' => 'aprovado']);
        return back()->with('success', 'Adoção aprovada com sucesso!');
    }
}
