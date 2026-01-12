<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $avaliacoes = Avaliacao::with('user')
            ->latest()
            ->paginate(10);

        $totalAvaliacoes = Avaliacao::count();
        $mediaPontuacao = $totalAvaliacoes > 0
            ? round(Avaliacao::avg('pontuacao'), 1)
            : null;

        $minhaAvaliacao = auth()->check()
            ? Avaliacao::where('user_id', auth()->id())->first()
            : null;

        return view('pages.avaliacoes', [
            'avaliacoes' => $avaliacoes,
            'totalAvaliacoes' => $totalAvaliacoes,
            'mediaPontuacao' => $mediaPontuacao,
            'minhaAvaliacao' => $minhaAvaliacao,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pontuacao' => 'required|integer|min:0|max:10',
            'comentario' => 'required|string|min:3|max:1000',
        ]);

        Avaliacao::updateOrCreate(
            ['user_id' => auth()->id()],
            ['pontuacao' => $data['pontuacao'], 'comentario' => $data['comentario']]
        );

        return redirect()
            ->route('avaliacoes.index')
            ->with('success', 'Comentário adicionado.');
    }
    public function destroy(Avaliacao $avaliacao)
    {
        if ($avaliacao->user_id !== auth()->id()) {
            abort(403, 'Não tens permissão para apagar esta avaliação.');
        }

        $avaliacao->delete();

        return redirect()
            ->route('avaliacoes.index')
            ->with('success', 'A tua avaliação foi removida.');
    }
}
