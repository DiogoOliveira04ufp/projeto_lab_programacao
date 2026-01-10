<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolunteerRequest;
use App\Mail\VolunteerConfirmationMail;
use App\Models\VolunteerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Mostra a página do formulário de voluntariado
     */
    public function show()
    {
        return view('pages.voluntarios');
    }

    /**
     * Processa o envio do formulário de voluntariado
     * 1) Autoriza + valida via StoreVolunteerRequest
     * 2) Guarda candidatura na BD
     * 3) Envia email de confirmação ao utilizador
     */
    public function send(StoreVolunteerRequest $request)
    {
        // Já vem validado aqui
        $data = $request->validated();

        $user = Auth::user();

        // Segurança: força email/nome a serem os do user autenticado
        $data['email'] = $user->email;
        $data['nome']  = $user->name;

        $vr = VolunteerRequest::create([
            'user_id'  => $user->id,
            'nome'     => $data['nome'],
            'email'    => $data['email'],
            'mensagem' => $data['mensagem'],
            'status'   => 'em_analise',
        ]);

        Mail::to($data['email'])->send(
            new VolunteerConfirmationMail([
                'nome' => $data['nome'],
                'id'   => $vr->id,
            ])
        );

        return back()->with(
            'success',
            'Pedido enviado com sucesso. Vais receber um email de confirmação.'
        );
    }
}
