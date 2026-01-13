<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensagemChat;
use Illuminate\Support\Facades\Auth;

class VoluntarioController extends Controller
{


    public function areaVoluntarios()
    {
        $mensagens = MensagemChat::with('user')->orderBy('created_at', 'asc')->get();
        return view('pages.area_voluntarios', compact('mensagens'));
    }

    public function enviarMensagem(Request $request)
    {
        $request->validate(['conteudo' => 'required|max:1000']);

        MensagemChat::create([
            'user_id' => Auth::id(),
            'conteudo' => $request->conteudo
        ]);

        return back()->with('success', 'Mensagem enviada!');
    }

    public function eliminarMensagem(MensagemChat $mensagem)
    {
        // Validação de propriedade
        if (Auth::id() !== $mensagem->user_id && (int)Auth::user()->role !== 1) {
            abort(403);
        }

        $mensagem->delete();
        return back()->with('success', 'Mensagem removida.');
    }
}
