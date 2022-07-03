<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsCreatedByUser extends Mailable
{
    use Queueable, SerializesModels;
    public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
        $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        logger($this->maildata);
        return $this->from($this->maildata['user_email'])->markdown('mail.newsCreatedByUser')
        ->subject('News added by '.$this->maildata['user'] )
        ->with('maildata', $this->maildata);;
    }
}
