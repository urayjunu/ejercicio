<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ColasEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $arrayDatos = $this->datos;

        return $this->subject($arrayDatos['asunto'])
                    ->from($arrayDatos['email_from'], $arrayDatos['nombre_from'])
                    ->view('mails.send_mail')->with(compact('arrayDatos'));
        
    }
}
