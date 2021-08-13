<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Restablecimiento de Contraseña - Kari Te Lo Compra";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        //
        $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reset_password_mail')->with(['urlId'=>$this->url]);
    }
}
