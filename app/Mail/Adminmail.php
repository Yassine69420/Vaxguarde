<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $prenom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom, $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     
    public function build()
    {
    
        return $this->from('yas.slimani@edu.umi.ac.ma', 'Vaxguarde')
            ->subject('vous etes admin ')
            ->view('email')
            ->with([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
            ]);
    

        
    }
}