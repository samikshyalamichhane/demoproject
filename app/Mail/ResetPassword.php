<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$details)
    {
        $this->data = $data;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // logger($this->data);
        logger(url('customer/reset-password/' . $this->data));
        return $this->markdown('mail.reset-password')
        ->subject('Reset Password')
        ->with([
            'name' => $this->details->name,
            'link' => url('customer/reset-password/' . $this->data),
        ]);
    }
}
