<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
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

        $cart_items = (array) json_decode(Cookie::get("cart_items", "[]"));

        if($request->isMethod("post") ){

            $key = "p_".$request->input("product_id").$request->input("color");

            if($request->input("action") == "add_cart"){
                if($request->input("qty") > 0) {

                    if(isset($cart_items[$key])){
                        $cart_items[$key]->qty += (integer) $request->input("qty");
                    }
                    else{
                        $cart_items[$key] = (object)[
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

                    if(isset($cart_items[$k])){

                        $qty = $item['qty'];

                        if($qty > 0){
                            $cart_items[$k]->qty = $qty;
                        }
                        else{
                            unset($cart_items[$k]);
                        }
                    }

                }


            }

            Cookie::queue("cart_items", json_encode($cart_items), 86400);
        }

        $this->getCartDetails($cart_items);

        return $next($request);
    }

    public function getCartDetails($cart_items){


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

        Session::put("cart_total_amount", $cart_total_amount);
        Session::put("cart_item_count", $cart_item_count);
        Session::put("cart_items", $cart_items);

        return $cart_items;
    }
}
