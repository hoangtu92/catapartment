<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Announcement;
use App\Models\CartItem;
use App\Models\ProductCategory;
use App\Models\SubMenu;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CatController extends Controller
{

    public $shoppingCart;
    public $wishlist;

    public function __construct(){

        parent::middleware(["shopping_cart", "wish_list"]);

        $this->middleware(function ($request, $next) {

            //Default get cart from cookie
            $cartData = Session::get("cart_items", "[]");

            if(!is_array($cartData)){
                $cartData = json_decode($cartData);
            }

            $this->shoppingCart = new CartItem();
            $this->shoppingCart->data = json_encode($cartData);

            /*************************/

            //Get wishlist
            $wishlist = Session::get("wishlist", "[]");
            if(!is_array($wishlist)){
                $wishlist = json_decode($wishlist);
            }

            $this->wishlist = new WishList();
            $this->wishlist->data = json_encode($wishlist);



            /*************************/
            //Try to get cart item from database if user is logged in
            if(Auth::user()){

                //cart
                $userCartItems = CartItem::where("user_id", Auth::user()->id)->first();
                if($userCartItems){
                    if($userCartItems->cartData['count'] > 0){
                        $this->shoppingCart = $userCartItems;
                    }
                    else{
                        $this->shoppingCart->user_id = $userCartItems->user_id;
                    }
                }
                else{
                    $this->shoppingCart->user_id = Auth::user()->id;
                }

                if($this->shoppingCart->cartData['count'] > 0){
                    $this->shoppingCart->save();
                }

                /*************************/
                //wishlist
                $userWishlist = WishList::where("user_id", Auth::user()->id)->first();
                if($userWishlist){
                    if(count($userWishlist->wishlistData["ids"]) > 0){
                        $this->wishlist = $userWishlist;
                    }
                    else{
                        $this->wishlist->user_id = $userWishlist->user_id;
                    }
                }

                if(count($this->wishlist->wishlistData['ids']) > 0){
                    $this->shoppingCart->save();
                }


            }

            /*************************/

            //var_dump($this->shoppingCart->cartData);

            View::share('shoppingCart', $this->shoppingCart->cartData);
            View::share('wishlist', $this->wishlist->wishlistData);


            return $next($request);
        });

        $product_categories = ProductCategory::all();
        $announcements = Announcement::getVisibleList();
        $advertisements = Advertisement::getVisibleList();


        $sub_menu = SubMenu::all();


        View::share('product_categories', $product_categories);
        View::share('announcements', $announcements);
        View::share('advertisements', $advertisements);
        View::share('sub_menu', $sub_menu);

    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function randomNumber() {
        $alphabet = '1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }




}
