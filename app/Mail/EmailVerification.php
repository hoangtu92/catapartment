<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $verifyUrl;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $verifyUrl
     */
    public function __construct($verifyUrl, $user)
    {
        //
        $this->user = $user;
        $this->verifyUrl = $verifyUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("貓公寓會員註冊驗證信")
            ->to($this->user->email, $this->user->name)
            ->from("no-reply@catapartment.com", "貓公寓拼圖坊")
            ->markdown('emails.verify-email');
    }
}
