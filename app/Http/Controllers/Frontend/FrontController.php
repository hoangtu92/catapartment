<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ContactUs;
use App\Models\Faq;
use App\Models\LatestProduct;
use App\Models\Message;
use App\Models\News;
use App\Models\Newsletter;
use App\Models\NewsTag;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RecommendProduct;
use App\Models\Slide;
use App\User;
use Backpack\Settings\app\Models\Setting;
use flamelin\ECPay\Ecpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $product->view++;
        $product->save();

        $hot_products = Product::orderByDesc("view")->limit(6)->get();

        foreach ($hot_products as $hot_product){
            if($hot_product->id == $product->id){
                $product->is_hot = true;
            }
        }

        return view("frontend.product_detail", compact("product"));
    }


    public function cart(Request $request){

       $this->getCartDetails();

        if($request->isMethod("post")){

            $key = "p_".$request->input("product_id").$request->input("color");

            if($request->input("action") == "add"){
                if($request->input("qty") > 0) {

                    if(isset($this->cart_items[$key])){
                        $this->cart_items[$key]->qty += (integer) $request->input("qty");
                    }
                    else{
                        $this->cart_items[$key] = (object)[
                            "product_id" => $request->input("product_id"),
                            "qty" => $request->input("qty"),
                            "color" => $request->input("color"),
                            "product" => (object) Product::find($request->input("product_id"))->toArray()
                        ];
                    }

                }
            }

            if($request->input("action") == "Update"){

                $items = $request->input("cart_items");

                foreach($items as $k => $item){


                    if(isset($this->cart_items[$k])){

                        $qty = $item['qty'];

                        if($qty > 0){
                            $this->cart_items[$k]->qty = $qty;
                        }
                        else{
                            unset($this->cart_items[$k]);
                        }
                    }

                }


            }

            Cookie::queue("cart_items", json_encode($this->cart_items), 68400);
        }

        View::share('cart_items', $this->cart_items);
        View::share('cart_total_amount', $this->cart_total_amount);
        View::share('cart_item_count', $this->cart_item_count);

        return view("frontend.cart");
    }

    public function checkout(Request$request){

        if($request->isMethod('post')){
            $this->getCartDetails();
            return $this->place_order($request);
        }

        return view("frontend.checkout");
    }

    public function place_order(Request $request){

        if($request->input('create_account') == true){
            $user = new User();
            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->zipcode = $request->input('zipcode');
            $user->address = $request->input('address');

            $password = $this->randomPassword();
            $user->password = bcrypt($password);
            if(preg_match('/^[^@]+/', $request->input('email'), $match)){
                $user->username = $match[0];
            }

            $user->save();

            $user->sendEmailVerificationNotification();
            $user->sendPasswordResetNotification(null);
        }

        //Creating order
        $order = new Order([
            'order_id' => $this->randomNumber(),
            'user_id' => Auth::id() != null ? Auth::id() : isset($user) ? $user->id : null,
            'shipping_fee' => Setting::get("shipping_fee"),
            'total_amount' => $this->cart_total_amount + (float) Setting::get("shipping_fee"),

            'company_name'      => $request->input('company_name'),
            'country'      => $request->input('country'),
            'state'      => $request->input('state'),

            'billing_name' => $request->input('name'),
            'billing_address' => $request->input('address'),
            'billing_address2' => $request->input('address2'),
            'billing_zipcode' => $request->input('zipcode'),
            'billing_phone' => $request->input('phone'),

            'shipping_name' => $request->input('name'),
            'shipping_address' => $request->input('address'),
            'shipping_address2' => $request->input('address2'),
            'shipping_zipcode' => $request->input('zipcode'),
            'shipping_phone' => $request->input('phone'),
            'notes'             => $request->input('notes'),

            'delivery'      => $request->input('delivery'),
            'payment_method'      => $request->input('payment_method'),
            "status" => 'pending'
        ]);

        $order->save();


        //基本參數(請依系統規劃自行調整)
        $ecpay = new Ecpay();
        $ecpay->i()->Send['ReturnURL']         = url("/payment-complete") ;
        $ecpay->i()->Send['MerchantTradeNo']   = $order->order_id;           //訂單編號
        $ecpay->i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
        $ecpay->i()->Send['TotalAmount']       = $order->total_amount;                     //交易金額
        $ecpay->i()->Send['TradeDesc']         = "Online goods" ;         //交易描述
        $ecpay->i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::CVS ;     //付款方式

        $ecpay->i()->Send['Items'] = [];

        //訂單的商品資料
        foreach($this->cart_items as $item){

            $product = Product::find($item->product_id);

            $order_item = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'color'     => $item->color,
                'price' => $product->sale_price,
                'qty' => $item->qty
            ]);

            $order_item->save();

            array_push($ecpay->i()->Send['Items'], array(
                    'Name' => $product->name,
                    'Price' => (int) $product->sale_price,
                    'Currency' => "元",
                    'Quantity' => (int) $item->qty,
                    'URL' => $product->permalink
                )
            );
        }

        //Go to ECPay
        //echo "緑界頁面導向中...";
        return $ecpay->i()->CheckOutString();
    }

    public  function payment_complete(Request $request){
        echo json_encode($request->input());
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
