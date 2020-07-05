<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\Product;
use App\Models\StockNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Logger;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class InventoryNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    /**
     * Create a new message instance.
     *
     * @param $product

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

        $emails = [];

        $subscribes = StockNotify::where("product_id", $this->product->id)->get();
        foreach($subscribes as $subscribe){
            $emails[] = $subscribe->newsletter->email;
        }

        Log::info("Send email to users about product #{$this->product->id}");
        Log::info(json_encode($emails));

        return $this->subject("[$this->product->name]已經補貨了，歡迎再回來逛逛")
            ->from("no-reply@catapartment.com", "貓公寓管理系統")
            ->to($emails)
            ->view('emails.inventory_notify');
    }
}
