<?php

namespace App\Http\Middleware;

use App\Models\CartItem;
use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Auth;
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

        if($request->isMethod("post") ){

            $cart_items =  $request->session()->get("cart_items", "[]");
            if(!is_array($cart_items)){
                $cart_items = (array) json_decode($cart_items);
            }

            if(Auth::user()){
                $userCartItem = CartItem::where("user_id", Auth::user()->id)->first();
                if($userCartItem && $userCartItem->cartData["count"] > 0)
                    $cart_items = $userCartItem->cartData["items"];

            }

            $key = base64_encode(serialize( (object) [$request->input("product_id"), $request->input("attr")] ));

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

                        if($product && $product->isAvailable) {

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

                if(Auth::user()){
                    if(!isset($userCartItem) || !$userCartItem){
                        $userCartItem = new CartItem([
                            "user_id" => Auth::user()->id,
                            "data" =>  json_encode($cart_items)
                        ]);
                    }
                    else{
                        $userCartItem->data = json_encode($cart_items);
                    }

                    $userCartItem->save();
                }
                else{

                    Session::put("cart_items", json_encode($cart_items));

                }

            }

        }


        return $next($request);
    }

}
