<?php


namespace App\Classes;


use App\Models\Product;

class ShoppingCart
{
    public $total_amount = 0;
    public $total_items = 0;
    public $items;

    public function __construct()
    {
        $this->items = (array) json_decode(request()->cookie("cart_items", "[]"));

        foreach ($this->items as &$item){
            $item->product = (object) Product::find($item->product_id)->toArray();
            $this->total_amount += $item->product->sale_price;
            $this->total_items += $item->qty;
        }
    }

}
