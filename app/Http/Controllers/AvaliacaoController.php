<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with('user')->latest()->paginate(10);
        return view('pages.avaliacoes', compact('avaliacoes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pontuacao' => 'required|integer|min:0|max:10',
            'comentario' => 'required|string|min:3|max:1000',
        ]);

        $data['user_id'] = auth()->id();

        Avaliacao::create($data);

        return redirect()->route('avaliacoes.index')->with('success', 'Comentário adicionado.');
    }
}