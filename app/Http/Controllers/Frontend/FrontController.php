<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\Advertisement;
use App\Models\Faq;
use App\Models\LatestProduct;
use App\Models\Message;
use App\Models\News;
use App\Models\Newsletter;
use App\Models\NewsTag;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RecommendProduct;
use App\Models\ShippingMethod;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
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
        $slides = Slide::getVisibleList();
        $news = News::where("display", true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $latest_products = LatestProduct::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })
            ->orderBy("lft", "ASC")
            ->get();

        $rmd = RecommendProduct::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })
            ->orderBy("lft", "ASC")
            ->get();

        $recommend_products = [];
        for($i=0; $i < count($rmd); $i++){
            if(!isset($recommend_products[$rmd[$i]->category]))
                $recommend_products[$rmd[$i]->category] = [];

            $recommend_products[$rmd[$i]->category][] = $rmd[$i];
        }


        return view("frontend.home")->with(compact(['slides', 'news', 'latest_products', 'recommend_products']));
    }

    public function search(Request $request){

        if($request->filled("s")){

            $s = $request->input("s");

            if($request->filled("cat")){
                $cat = $request->input("cat");

                //Search for product only
                $results = DB::table("products")
                    ->join("product_categories", "products.category_id", "=", "product_categories.id")
                    ->where("product_categories.id", "=", $cat)
                    ->where("products.name", "like", "%$s%")
                    ->selectRaw("'product' as type, products.name as name, products.id as id, products.image as thumbnail, products.price as price")
                    ->get();
            }
            else{

                $products = DB::table("products")
                    ->where("name", "like", "%$s%")
                    ->selectRaw("'product' as type, products.name as name, products.id as id, products.image as thumbnail, products.price as price")
                    ->get();

                $faqs = DB::table("faqs")
                    ->where("question", "like", "%$s%")
                    ->orWhere("answer", "like", "%$s%")
                    ->selectRaw("'faq' as type, faqs.id as id, faqs.question as name, faqs.answer as description")
                    ->get();

                $news = DB::table("news")
                    ->where("display", "=", "1")
                    ->where("title", "like", "%$s%")
                    ->orWhere("content", "like", "%$s%")
                    ->selectRaw("'news' as type, news.id as id, news.title as name, news.content as description, news.image as thumbnail")
                    ->get();

                $results = $products->concat($faqs)->concat($news);

            }

            return view("frontend.search")->with(compact("results"));
        }
        else{
            return view("frontend.home");
        }
    }

    public function news(){

        $news = News::where("display", 1)->get();

        return view("frontend.news")->with(compact("news"));
    }

    public function news_tag($tagName){

        $tag = NewsTag::where("name", "=", $tagName)->firstOrFail();
        $news = $tag->news;

        return view("frontend.news")->with(compact("news"));
    }

    public function news_detail($slug){


        $news = News::where("title", "=", $slug)->firstOrFail();

        $tags = NewsTag::all();
        $recentNews = News::orderBy("created_at", "desc")->take(5)->get();

        return view("frontend.news_detail")->with(compact("news", "tags", "recentNews"));
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

        $product = Product::where("slug", $slug)->firstOrFail();
        $shipping_methods = ShippingMethod::all();

        $product->view++;
        $product->save();

        $hot_products = Product::orderByDesc("view")->limit(6)->get();

        foreach ($hot_products as $hot_product){
            if($hot_product->id == $product->id){
                $product->is_hot = true;
            }
        }

        return view("frontend.product_detail", compact("product", "shipping_methods"));
    }

    private function getCartDetails($cart_items){

        foreach ($cart_items as $item){

            $item->product = (object) Product::find($item->product_id)->toArray();
        }

        return $cart_items;
    }

    private function combine_cart($cart_items){

        return array_reduce($cart_items, function ($t, $e){

            if(isset($t[$e->product_id.$e->color])){
                $t[$e->product_id.$e->color]->qty+= $e->qty;
            }
            else{
                $t[$e->product_id.$e->color] = $e;
            }

            return $t;
        }, []);

    }

    public function cart(Request $request){

        $cart_items = (array) json_decode(Cookie::get("cart_items", "[]"));

        if(!$cart_items) $cart_items = [];


        // $cart_items = $this->combine_cart($cart_items);

        if($request->isMethod("post")){

            $key = "p_".$request->input("product_id").$request->input("color");

            if($request->input("action") == "add"){
                if($request->input("qty") > 0) {
                    $cart_items[$key] = (object)[
                        "product_id" => $request->input("product_id"),
                        "qty" => $request->input("qty"),
                        "color" => $request->input("color")
                    ];
                }
            }

            if($request->input("action") == "Update"){

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



            Cookie::queue("cart_items", json_encode($cart_items), 68400);
        }


        $cart_items = $this->getCartDetails($cart_items);



        return view("frontend.cart", compact("cart_items"));
    }

    public function checkout(){
        return view("frontend.checkout");
    }

    public function faq(){
        $payment_faqs = Faq::where("type", "付款資訊")->get();
        $shopping_faqs = Faq::where("type", "購物資訊")->get();
        $membership_faq = Faq::where("type", "會員問題")->get();
        return view("frontend.faq")->with(compact("payment_faqs", "shopping_faqs", "membership_faq"));
    }

    public function subscribe(Request $request){
        if($request->filled("email")){
            Newsletter::create([
                "email" => $request->input("email")
            ]);
        }

        return redirect(route("home"));
    }

    public function contact(Request $request){

        if($request->isMethod("post") && $request->filled("action")){
            $contact_info = (object) $request->only(["customer_name", "customer_email", "customer_phone", "customer_free_time", "customer_message"]);


            try{
                Message::create([
                    "customer_ip"   => $request->ip(),
                    "customer_name" => $contact_info->customer_name,
                    "customer_email" => $contact_info->customer_email,
                    "customer_phone" => $contact_info->customer_phone,
                    "customer_free_time" => $contact_info->customer_free_time,
                    "customer_message" => $contact_info->customer_message
                ]);
            }
            catch(\Exception $e){

            }
            if(env("RECEIVE_CONTACT_EMAIL") == 1)
                Mail::send(new ContactUs($contact_info));

            $request->session()->flash('message', __("Your message has been sent successfully"));
        }

        return view("frontend.contact");
    }





}
