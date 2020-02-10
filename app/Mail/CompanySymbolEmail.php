<?php

namespace App\Mail;

 
use Illuminate\Mail\Mailable;

class CompanySymbolEmail extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $data;

    public function __construct($data)
    {
         $this->data = $data;

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sender@example.com')->view('emails.company_symbol');
    }
}

