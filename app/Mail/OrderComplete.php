<?php

namespace App\Mail;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderComplete extends Mailable
{
    use Queueable, SerializesModels;

    public $to;
    public $order;
    /**
     * Create a new message instance.
     *
     * @param $to
     */
    public function __construct($order)
    {
        //

        $this->order = $order;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->email)
            ->subject("貓公寓拼圖坊訂單通知".$this->order->order_id)
            ->replyTo(Setting::get("contact_email"), "貓公寓拼圖坊")
            ->view('emails.order_completed');
    }
}
