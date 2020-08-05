<?php

namespace App\Mail;

use App\Models\User;
use Backpack\Settings\app\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AdminNotifyInventory extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        //
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $admin_email = Setting::get("contact_email");

        Log::info("Send email to admin about product #{$this->product->id}");

        return $this->to($admin_email)
            ->from("admin@catsapt.com", "貓公寓管理系統")
            ->subject("[{$this->product->name}]庫存不足警示")
            ->bcc("ml.codesign1@gmail.com")
        ->view('emails.admin_inventory_notify');
    }
}
