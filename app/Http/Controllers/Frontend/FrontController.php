<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //Index
    public function home(){
        return view("frontend.home");
    }

    public function news(){
        return view("frontend.news");
    }

    public function news_detail($slug){
        return view("frontend.news_detail");
    }

    public function products(){
        return view("frontend.products");
    }

    public function pre_order_products(){
        return view("frontend.pre_order_products");
    }

    public function recommend_products(){
        return view("frontend.recommend_products");
    }

    public function customized_products(){
        return view("frontend.customized_products");
    }

    public function product_detail($slug){
        return view("frontend.product_detail");
    }

    public function checkout(){
        return view("frontend.checkout");
    }

    public function wishlist(){
        return view("frontend.wishlist");
    }

    public function faq(){
        return view("frontend.faq");
    }

    public function contact(){
        return view("frontend.contact");
    }




}
