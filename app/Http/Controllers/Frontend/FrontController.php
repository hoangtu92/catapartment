<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\Advertisement;
use App\Models\Faq;
use App\Models\News;
use App\Models\ProductCategory;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class FrontController extends CatController
{

    //Index
    /**
     * FrontController constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    public function home(){
        $slides = Slide::all();

        return view("frontend.home")->with(compact(['slides']));
    }

    public function news(){

        $news = News::where("display", 1)->get();

        return view("frontend.news")->with(compact("news"));
    }

    public function news_detail($slug){
        return view("frontend.news_detail");
    }

    public function products(){
        return view("frontend.products");
    }

    public function product_category($category_name){
        $category = ProductCategory::where("name", $category_name)->first();
        return view("frontend.products")->with(compact("category"));
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
        $payment_faqs = Faq::where("type", "PAYMENT")->get();
        $shopping_faqs = Faq::where("type", "SHOPPING")->get();
        return view("frontend.faq")->with(compact("payment_faqs", "shopping_faqs"));
    }

    public function contact(Request $request){

        if($request->isMethod("post") && $request->filled("action")){
            $contact_info = (object) $request->only(["customer_name", "customer_email", "customer_phone", "customer_free_time", "customer_message"]);

            Mail::send(new ContactUs($contact_info));

            $request->session()->flash('message', trans("frontend.contact_us_success"));
        }

        return view("frontend.contact");
    }





}
