<?php

namespace App\Http\Controllers;

// Mailable responsável pelo email de confirmação ao voluntário
use App\Mail\VolunteerConfirmationMail;

// Model que representa a candidatura de voluntariado na base de dados
use App\Models\VolunteerRequest;

// Classes base do Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Mostra a página do formulário de voluntariado
     */
    public function show()
    {
        // Apenas devolve a view com o formulário
        return view('pages.voluntarios');
    }

    /**
     * Processa o envio do formulário de voluntariado
     * 1) Valida dados
     * 2) Guarda candidatura na base de dados
     * 3) Envia email de confirmação ao utilizador
     */
    public function send(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        // O campo email é opcional porque o email real vem da sessão
        $data = $request->validate([
            'nome'     => ['required', 'string', 'max:80'],
            'mensagem' => ['required', 'string', 'max:2000'],
            'email'    => ['nullable', 'email', 'max:120'],
        ]);

        // Obtém o utilizador autenticado
        // Esta rota está protegida por middleware 'auth'
        $user = Auth::user();

        // Força o email a ser o do utilizador autenticado
        // Evita que o utilizador submeta um email diferente no formulário
        $data['email'] = $user->email;

        // Guarda a candidatura de voluntariado na base de dados
        $vr = VolunteerRequest::create([
            'user_id'  => $user->id,        // ligação ao utilizador
            'nome'     => $data['nome'],
            'email'    => $data['email'],
            'mensagem' => $data['mensagem'],
            'status'   => 'em_analise',     // estado inicial definido pelo sistema
        ]);

        // Envia email de confirmação ao voluntário
        // O envio é feito via SMTP (Mailtrap em modo de teste)
        Mail::to($data['email'])->send(
            new VolunteerConfirmationMail([
                'nome' => $data['nome'],
                'id'   => $vr->id, // opcional: número de referência do pedido
            ])
        );

        // Redireciona de volta com mensagem de sucesso
        return back()->with(
            'success', 'Pedido enviado com sucesso. Vais receber um email de confirmação.'
        );
    }
}
