<?php

namespace App\Http\Middleware;

use App\Models\CustomizedProduct;
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

        $sort = $request->filled("sort") ? $request->input("sort") : "latest";
        View::share('sort', $sort);

        $cart_items = (array) json_decode(Cookie::get("cart_items", "[]"));

        if($request->isMethod("post") ){

            $key = base64_encode(serialize( (object) [$request->input("product_id"), $request->input("customized_product_id"), $request->input("attr")] ));

            if($request->input("action") == "add_cart"){
                if($request->input("qty") > 0) {

                    $product = Product::find($request->input("product_id"));

                    if($product && $product->isAvailable) {

                        if(isset($cart_items[$key])){
                            $cart_items[$key]->qty += (integer) $request->input("qty");
                        }
                        else{

                            $cart_items[$key] = (object)[
                                "product_id" => $request->input("product_id"),
                                "customized_product_id" => $request->input("customized_product_id"),
                                "qty" => $request->input("qty"),
                                "attr" => $request->input("attr")
                            ];

                        }
                    }

                }
            }

            if($request->input("action") == "update_cart"){

                $items = $request->input("cart_items");

                foreach($items as $k => $item){

                    if(isset($cart_items[$k])){

                        $product = Product::find($cart_items[$k]->product_id);

                        if($product && $product->is_available) {

                            $qty = $item['qty'];

                            if ($qty > 0) {
                                $cart_items[$k]->qty = $qty;
                            } else {
                                unset($cart_items[$k]);
                            }
                        }
                    }

                }
            }

            //Get notify
            if($request->input("action") == "貨到通知"){
                //var_dump($request->input());
            }
            else{
                Cookie::queue("cart_items", json_encode($cart_items), 86400);
            }


        }

        $this->getCartDetails($cart_items);

        return $next($request);
    }

    public function getCartDetails($cart_items){


        $cart_item_count = 0;
        $cart_total_amount = 0;

        foreach ($cart_items as &$item){

            $cart_item_count += $item->qty;

            if(isset($item->product_id) && $item->product_id != null){
                $product = Product::find($item->product_id);

                if($product){
                    $permalink = $product->permalink;

                    $item->product = $product->toArray();
                    $item->product['permalink'] = $permalink;

                    $item->product = (object) $item->product;

                    $cart_total_amount += $item->product->sale_price*$item->qty;
                }


            }
            if(isset($item->customized_product_id) && $item->customized_product_id != null){
                $item->customized_product = CustomizedProduct::find($item->customized_product_id);

                if($item->customized_product)
                    $cart_total_amount += $item->customized_product->price*$item->qty;
            }



        }


        //$cart_items = [];

        View::share('cart_items', $cart_items);
        View::share('cart_total_amount', $cart_total_amount);
        View::share('cart_item_count', $cart_item_count);

        Session::put("cart_total_amount", $cart_total_amount);
        Session::put("cart_item_count", $cart_item_count);
        Session::put("cart_items", $cart_items);

        return $cart_items;
    }
}
