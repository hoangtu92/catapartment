<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\Cast\Object_;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $contact_info;

    /**
     * Create a new message instance.
     *
     * @param $contact_info
     */
    public function __construct(Object $contact_info)
    {
        //
        $this->contact_info = $contact_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->contact_info->customer_email, $this->contact_info->customer_name)
            ->view('email.contact_us');
    }
}
