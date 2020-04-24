<?php

namespace App\Mail;

use Backpack\Settings\app\Models\Setting;
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
        return $this->to(Setting::get("contact_email") )
            ->replyTo($this->contact_info->customer_email, $this->contact_info->customer_name)
            ->view('emails.contact_us');
    }
}
