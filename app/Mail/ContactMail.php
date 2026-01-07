<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// define como vai ser o email
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // define o assunto do email e a view 
        return $this
            ->subject('Novo contacto: ' . $this->data['assunto'])
            ->view('emails.contact');
    }
}
