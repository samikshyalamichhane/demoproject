<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerification extends Mailable
{
    use Queueable, SerializesModels;

    
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        logger(url('customer/verify/' . $this->user->verification_hash));
        return $this->markdown('mail.account-verification')
        ->subject('Account Verification')
        ->with([
            'name' => $this->user->name,
            'link' => url('customer/verify/' . $this->user->verification_hash),
        ]);
    }
}
