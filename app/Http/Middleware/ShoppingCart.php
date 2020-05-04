<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class ShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->isMethod("post") && ($request->input("action") == 'add_cart'
                || $request->input("action") == 'update_cart') ){

            $key = "p_".$request->input("product_id").$request->input("color");

            if($request->input("action") == "add_cart"){
                if($request->input("qty") > 0) {

                    if(isset($this->cart_items[$key])){
                        $this->cart_items[$key]->qty += (integer) $request->input("qty");
                    }
                    else{
                        $this->cart_items[$key] = (object)[
                            "product_id" => $request->input("product_id"),
                            "qty" => $request->input("qty"),
                            "color" => $request->input("color")
                        ];
                    }

                }
            }

            if($request->input("action") == "update_cart"){

                $items = $request->input("cart_items");

                foreach($items as $k => $item){


                    if(isset($this->cart_items[$k])){

                        $qty = $item['qty'];

                        if($qty > 0){
                            $this->cart_items[$k]->qty = $qty;
                        }
                        else{
                            unset($this->cart_items[$k]);
                        }
                    }

                }


            }

            Cookie::queue("cart_items", json_encode($this->cart_items), 86400);
        }

        $this->getCartDetails();

        return $next($request);
    }

    public function getCartDetails(){

        $cart_items = (array) json_decode(Cookie::get("cart_items", "[]"));
        $cart_item_count = 0;
        $cart_total_amount = 0;

        foreach ($cart_items as &$item){

            $product = Product::find($item->product_id);
            $permalink = $product->permalink;

            $item->product = $product->toArray();
            $item->product['permalink'] = $permalink;

            $item->product = (object) $item->product;

            $cart_item_count += $item->qty;
            $cart_total_amount += $item->product->sale_price*$item->qty;
        }

        View::share('cart_items', $cart_items);
        View::share('cart_total_amount', $cart_total_amount);
        View::share('cart_item_count', $cart_item_count);

        return $cart_items;
    }
}
