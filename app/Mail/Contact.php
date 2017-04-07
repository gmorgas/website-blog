<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $bodyMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $bodyMessage)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->bodyMessage = $bodyMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->email)
            ->subject($this->subject)
            ->view('emails.contact');
    }
}
