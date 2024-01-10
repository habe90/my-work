<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginLinkEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $loginLink;

    /**
     * Create a new message instance.
     *
     * @param string $loginLink
     */
    public function __construct($loginLink)
    {
        $this->loginLink = $loginLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Login Link Email')
                    ->view('emails.login_link')
                    ->with([
                        'loginLink' => $this->loginLink,
                    ]);
    }
}
