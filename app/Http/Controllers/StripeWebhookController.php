<?php

namespace App\Http\Controllers;

use App\Mail\DonationThankYouMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        $secret = env('STRIPE_WEBHOOK_SECRET');
        if (!$secret) {
            return response('Missing STRIPE_WEBHOOK_SECRET', 500);
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

            $email = $session->customer_details->email
                ?? $session->customer_email
                ?? null;

            if ($email) {
                $amountCents = (int) ($session->amount_total ?? 0);
                $amountEur = (int) round($amountCents / 100);
                $name = $session->customer_details->name ?? null;

                Mail::to($email)->send(new DonationThankYouMail($amountEur, $name));
            }
        }

        return response()->json(['received' => true]);
    }
}
