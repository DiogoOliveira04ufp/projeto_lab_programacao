<?php

namespace App\Http\Controllers;

use App\Models\Donation;
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

        // 3) Se estiver autenticado, tenta pré-preencher email (apenas se for válido)
        $email = auth()->check() ? auth()->user()->email : null;
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = null;
        }

        // 4) Criar sessão do Checkout
        $params = [
            'mode' => 'payment',
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
            // útil para ligar à doação guardada no webhook
            'success_url' => route('doacoes.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('doacoes.cancel'),
        ];

        // email pré-preenchido (se válido)
        if ($email) {
            $params['customer_email'] = $email;
        }

        $session = CheckoutSession::create($params);

        // 5) Ir para a página de pagamento da Stripe
        return redirect()->away($session->url);
    }

    /**
     * Página de sucesso (após pagamento concluído).
     * Mostra botão para download do recibo (PDF) quando a doação já estiver registada via webhook.
     */
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        $donation = null;
        if ($sessionId) {
            $donation = Donation::where('stripe_session_id', $sessionId)->first();
        }

        return view('pages.doacoes_sucesso', compact('donation'));
    }

    /**
     * Página de cancelamento (utilizador cancelou pagamento).
     */
    public function cancel()
    {
        return view('pages.doacoes_cancelado');
    }
}
