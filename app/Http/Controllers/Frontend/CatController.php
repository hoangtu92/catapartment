<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Announcement;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class CatController extends Controller
{

    public $cart_items;
    public $cart_total_amount = 0;
    public $cart_item_count = 0;

    public function __construct(){
        $product_categories = ProductCategory::all();
        $announcements = Announcement::getVisibleList();
        $advertisements = Advertisement::getVisibleList();

        $sub_menu = SubMenu::all();

        View::share('product_categories', $product_categories);
        View::share('announcements', $announcements);
        View::share('advertisements', $advertisements);
        View::share('sub_menu', $sub_menu);

    }

    public function getCartDetails(){

        $this->cart_items = (array) json_decode(Cookie::get("cart_items", "[]"));

        foreach ($this->cart_items as &$item){

            $product = Product::find($item->product_id);
            $permalink = $product->permalink;

            $item->product = $product->toArray();
            $item->product['permalink'] = $permalink;

            $item->product = (object) $item->product;

            $this->cart_item_count += $item->qty;
            $this->cart_total_amount += $item->product->sale_price*$item->qty;
        }

        return $this->cart_items;
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
