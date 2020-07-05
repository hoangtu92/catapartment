<?php

namespace App\Http\Middleware;

use App\Models;
use Closure;
use Illuminate\Support\Facades\Auth;
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

        if($request->isMethod("post") ){

            $wishlist = $request->session()->get("wishlist", "[]");

            if(!is_array($wishlist)){
                $wishlist = (array) json_decode($wishlist);
            }

            if(Auth::user()) {
                $userWishlist = Models\WishList::where("user_id", Auth::user()->id)->first();
                if($userWishlist && count($userWishlist->wishlistData["ids"]) > 0){
                    $wishlist = $userWishlist->wishlistData['ids'];
                }
            }


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

            if(Auth::user()){
                if(!isset($userWishlist) || !$userWishlist){
                    $userWishlist = new Models\WishList([
                        "user_id" => Auth::user()->id,
                        "data" => json_encode($wishlist)
                    ]);
                }
                else{
                    $userWishlist->data = json_encode($wishlist);
                }

                if(count($userWishlist->wishlistData['ids']) > 0){
                    $userWishlist->save();
                }

            }
            else{
                $request->session()->put("wishlist", json_encode($wishlist));
            }


        }



        return $next($request);
    }
}
