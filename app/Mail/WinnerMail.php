<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WinnerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tournament;

    public function __construct($tournament)
    {
        $this->tournament = $tournament;
    }
    
    public function build()
    {
        return $this->markdown('emails.winnerMail');
    }
}
