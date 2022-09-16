<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class nuevaContrasenaMailable extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subjetc = "Contraseña temporal";
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 

        // Esta vista es la que se vera en el correo electronico..
        return $this->view('password.nuevoCodigo');
    }

}
