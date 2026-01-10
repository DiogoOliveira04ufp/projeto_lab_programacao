<?php

namespace App\Http\Controllers;

use App\Mail\DonationThankYouMail;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        // Melhor prática: usar config/services.php (com fallback para env)
        $secret = config('services.stripe.webhook_secret') ?: env('STRIPE_WEBHOOK_SECRET');

        if (!$secret) {
            return response('Missing STRIPE_WEBHOOK_SECRET', 500);
        }

        if (!$sigHeader) {
            return response('Missing Stripe-Signature header', 400);
        }

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $sessionId = $session->id ?? null;
            if (!$sessionId) {
                return response('Missing session id', 400);
            }

            $email = $session->customer_details->email
                ?? $session->customer_email
                ?? null;

            $name = $session->customer_details->name ?? null;

            $amountCents = (int) ($session->amount_total ?? 0);
            $currency = (string) ($session->currency ?? 'eur');

            $paymentIntentId = $session->payment_intent ?? null;
            
            $paidAt = isset($session->created)
                ? Carbon::createFromTimestamp((int) $session->created)
                : now();

            // tentar associar a um user existente (pelo email)
            $userId = null;
            if ($email) {
                $userId = User::where('email', $email)->value('id');
            }

            // Guardar na BD (idempotente por stripe_session_id)
            Donation::updateOrCreate(
                ['stripe_session_id' => $sessionId],
                [
                    'user_id' => $userId,
                    'donor_email' => $email,
                    'donor_name' => $name,
                    'stripe_payment_intent_id' => $paymentIntentId,
                    'amount_total' => $amountCents,
                    'currency' => $currency,
                    'status' => 'paid',
                    'paid_at' => $paidAt,
                ]
            );

            // Email de agradecimento (mantém o teu comportamento)
            if ($email) {
                $amountEur = (int) round($amountCents / 100);
                Mail::to($email)->send(new DonationThankYouMail($amountEur, $name));
            }
        }

        return response()->json(['received' => true]);
    }
}
