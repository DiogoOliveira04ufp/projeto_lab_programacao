<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class DonationController extends Controller
{
    /**
     * Cria uma sessão Stripe Checkout e redireciona o utilizador para a página de pagamento.
     */
    public function checkout(Request $request)
    {
        // 1) Validar valor vindo do formulário (em euros)
        $data = $request->validate([
            'amount' => ['required', 'integer', 'min:1', 'max:500'],
        ]);

        $amountEur = (int) $data['amount'];
        $amountCents = $amountEur * 100;

        // 2) Definir a chave secreta da Stripe (modo teste)
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // 3) Se estiver autenticado, preenche o email no checkout
        $email = auth()->check() ? auth()->user()->email : null;

        // 4) Criar sessão do Checkout
        $session = CheckoutSession::create([
            'mode' => 'payment',

            // email pré-preenchido no Stripe Checkout (se houver user autenticado)
            'customer_email' => $email,

            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $amountCents,
                    'product_data' => [
                        'name' => 'Doação ao Gatil',
                    ],
                ],
            ]],
            // util se mais tarde quiser guardar a doaçao
            'success_url' => route('doacoes.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('doacoes.cancel'),
        ]);

        // 5) Ir para a página de pagamento da Stripe
        return redirect()->away($session->url);
    }

    /**
     * Página de sucesso (após pagamento concluído).
     */
    public function success(Request $request)
    {
        return view('pages.doacoes_sucesso');
    }

    /**
     * Página de cancelamento (utilizador cancelou pagamento).
     */
    public function cancel()
    {
        return view('pages.doacoes_cancelado');
    }
}
