<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Wishlist
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
        $wishlist = (array) json_decode(Cookie::get("wishlist", "[]"));

        if($request->isMethod("post") ){

            if($request->input("action") == "add_wishlist"){
                if(!in_array($request->input("product_id"), $wishlist)){
                    $wishlist[] = $request->input("product_id");
                }
            }
            if($request->input("action") == "remove_wishlist"){
                if(in_array($request->input("product_id"), $wishlist)){
                    array_splice($wishlist, array_search($request->input("product_id"), $wishlist), 1);
                }
            }

            Cookie::queue("wishlist", json_encode($wishlist), 86400);
        }

        $this->getWishlistDetails($wishlist);

        return $next($request);
    }

    public function getWishlistDetails($wishlist){

        $result = [];

        foreach ($wishlist as $item){

            $product = Product::find($item);
            $permalink = $product->permalink;

            $product = $product->toArray();
            $product['permalink'] = $permalink;

            $result[] = (object) $product;
        }

        View::share('wishlist', $result);

        Session::put("wishlist", $result);

        return $result;
    }
}
