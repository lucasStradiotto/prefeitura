<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notificate extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;
    public $template;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados, $template)
    {
        $this->dados = $dados;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Atualização de Status')
            ->view('email.'.$this->template);
    }
}
