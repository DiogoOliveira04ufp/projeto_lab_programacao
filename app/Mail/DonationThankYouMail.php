<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public int $amountEur,
        public ?string $donorName = null
    ) {}

    public function build()
    {
        return $this->subject('Confirmamos que recebemos a sua doação. Muito Obrigado!')
            ->view('emails.donation_thank_you');
    }
}
