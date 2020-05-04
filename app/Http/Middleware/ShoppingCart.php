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
        $result = $this->getCartDetails();

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
