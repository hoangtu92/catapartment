<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ContactUs;
use App\Models\Faq;
use App\Models\LatestProduct;
use App\Models\Message;
use App\Models\News;
use App\Models\Newsletter;
use App\Models\NewsTag;
use App\Models\Page;
use App\Models\Product;
use App\Models\RecommendProduct;
use App\Models\Slide;
use App\Models\StockNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $ltp = LatestProduct::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })
            ->orderBy("lft", "ASC")
            ->take(5)
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

        $latest_products = [];
        for($i=0; $i < count($ltp); $i++){
            if(!isset($latest_products[$ltp[$i]->lft]))

            $latest_products[$ltp[$i]->lft] = $ltp[$i];
        }

        return view("frontend.home")->with(compact(['slides', 'news', 'latest_products', 'recommend_products']));
    }

    public function search(Request $request){


        if($request->filled("s")){

            $s = $request->input("s");

            if($request->filled("cat")){
                $cat = $request->input("cat");


                if($cat === 'faq'){
                    $results = DB::table("faqs")
                        ->where("question", "like", "%$s%")
                        ->orWhere("answer", "like", "%$s%")
                        ->selectRaw("'faq' as type, faqs.id as id, faqs.question as name, faqs.answer as description")
                        ->orderByDesc("created_at")
                        ->get();
                }
                else if($cat === 'news'){
                    $results = DB::table("news")
                        ->where("display", "=", "1")
                        ->where("title", "like", "%$s%")
                        ->orWhere("content", "like", "%$s%")
                        ->selectRaw("'news_details' as type, news.title as slug, news.id as id, news.title as name, news.content as description, news.image as thumbnail")
                        ->orderByDesc("created_at")
                        ->get();
                }
                else{
                    //Search for product only
                    $results = DB::table("products")
                        ->join("product_categories", "products.category_id", "=", "product_categories.id")
                        ->where("product_categories.id", "=", $cat)
                        ->where("products.name", "like", "%$s%")
                        ->selectRaw("'product_detail' as type, products.slug as slug, products.name as name, products.id as id, products.image as thumbnail, products.price as price")
                        ->orderByDesc("created_at")
                        ->get();
                }
            }
            else{

                $products = DB::table("products")
                    ->where("name", "like", "%$s%")
                    ->selectRaw("'product_detail' as type, products.slug as slug, products.name as name, products.id as id, products.image as thumbnail, products.price as price")
                    ->get();

                $faqs = DB::table("faqs")
                    ->where("question", "like", "%$s%")
                    ->orWhere("answer", "like", "%$s%")
                    ->selectRaw("'faq' as type, faqs.id as id, faqs.question as name, faqs.answer as description")
                    ->orderByDesc("created_at")
                    ->get();

                $news = DB::table("news")
                    ->where("display", "=", "1")
                    ->where("title", "like", "%$s%")
                    ->orWhere("content", "like", "%$s%")
                    ->selectRaw("'news_details' as type, news.title as slug, news.id as id, news.title as name, news.content as description, news.image as thumbnail")
                    ->orderByDesc("created_at")
                    ->get();

                $results = $products->concat($faqs)->concat($news);

            }

            return view("frontend.search")->with(compact("results"));
        }
        else{
            return $this->home();
        }
    }

    public function news($page = 1, Request $request){

        //Pagination variables
        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $total_items = News::where("display", 1)->count();
        $route_name = "news";

        $news = News::where("display", 1)->offset(($page-1)*$perPage)->take($perPage)->get();

        return view("frontend.news")->with(compact("news", "page", "perPage", "total_items", "route_name"));
    }

    public function news_tag($tagName, $page, Request $request){

        $tag = NewsTag::where("name", "=", $tagName)->firstOrFail();

        //Pagination variables
        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $total_items = $tag->news()->count();
        $route_name = "news_tag";

        $news = $tag->news()->offset( ($page-1) * $perPage)->take($perPage)->get();

        return view("frontend.news")->with(compact("news", "page", "perPage", "total_items", "route_name"));
    }

    public function news_detail($slug){

        $slug = html_entity_decode($slug);

        $news = News::whereRaw("title LIKE '%{$slug}%'")->firstOrFail();

        $tags = NewsTag::all();
        $recentNews = News::orderBy("created_at", "desc")->take(5)->get();

        return view("frontend.news_detail")->with(compact("news", "tags", "recentNews"));
    }

    public function page($slug){
        $page = Page::where("slug", $slug)->firstOrFail();

        return view("frontend.page_detail")->with(compact("page"));
    }


    public function faq(){
        $payment_faqs = Faq::where("type", "付款資訊")->orderByDesc("created_at")->get();
        $shopping_faqs = Faq::where("type", "購物資訊")->orderByDesc("created_at")->get();
        $membership_faq = Faq::where("type", "會員問題")->orderByDesc("created_at")->get();
        $service_faq = Faq::where("type", "客服諮詢")->orderByDesc("created_at")->get();
        return view("frontend.faq")->with(compact("payment_faqs", "shopping_faqs", "membership_faq", "service_faq"));
    }

    public function subscribe(Request $request){
        if($request->filled("email")){

            $newsletter = Newsletter::where("email", $request->input("email"))->first();


            if($request->filled("action")){

                if($request->input("action") == "unsubscribe"){
                    //Unsubscribe
                    if($newsletter) $newsletter->delete();
                    $request->session()->flash('message', "已成功加入貨到通知");
                    return redirect(route("home"));
                }
                else{
                    if(!$newsletter){
                        $newsletter = new Newsletter([
                            "email" => $request->input("email"),
                        ]);
                        $newsletter->save();
                    }

                }

            }



        }

        return redirect(route("home"));
    }

    public function product_notify(Request $request){
        $request->validate([
           "product_id" => "required",
           "email" => "required",
        ]);
        $product = Product::find($request->input("product_id"));

        if($product){
            $exist = StockNotify::where("product_id", $product->id)->where("email", $request->email)->first();

            if(!$exist){
                StockNotify::create([
                    'email' => $request->email,
                    'product_id' => $product->id,
                    'name' => $request->filled("name") ? $request->name : null,
                    'phone' => $request->filled("phone") ? $request->phone : null,
                ]);
            }

            $request->session()->flash('message', "已成功加入貨到通知");
            return redirect($product->permalink);

        }
    }

    public function register_notify_product(Request $request){
        if($request->filled("email")){

            $newsletter = Newsletter::where("email", $request->input("email"))->first();




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
            /*if(env("RECEIVE_CONTACT_EMAIL") == 1)
                Mail::send(new ContactUs($contact_info));*/

            $request->session()->flash('message', __("Your message has been sent successfully"));
        }

        return view("frontend.contact");
    }



}
