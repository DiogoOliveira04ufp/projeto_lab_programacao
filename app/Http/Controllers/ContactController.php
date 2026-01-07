<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show()
    {
    
        return view('pages.voluntarios');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120'],
            'mensagem' => ['required', 'string', 'max:2000'],
        ]);

        // assunto fixo (mesmo que alguém tente enviar outro)
        $data['assunto'] = 'Pedido de voluntariado';

        // destino (capturado no Mailtrap)
        $destino = config('mail.from.address');


        // chama o envio do email
        Mail::to($destino)->send(new ContactMail($data));

        return back()->with('success', 'Pedido de voluntariado enviado com sucesso!');
    }
}
