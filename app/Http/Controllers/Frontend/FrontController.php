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
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RecommendProduct;
use App\Models\Slide;
use App\Models\Transaction;
use App\Models\UserPoint;
use App\User;
use Backpack\Settings\app\Models\Setting;
use Cassandra\Date;
use ECPay_CheckMacValue;
use flamelin\ECPay\Ecpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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
            ->take(5)
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

        $news = News::where("title", "=", $slug)->firstOrFail();

        $tags = NewsTag::all();
        $recentNews = News::orderBy("created_at", "desc")->take(5)->get();

        return view("frontend.news_detail")->with(compact("news", "tags", "recentNews"));
    }

    public function page($slug){
        $page = Page::where("slug", $slug)->firstOrFail();

        return view("frontend.page_detail")->with(compact("page"));
    }

    public function products($page = 1, Request $request){
        //Pagination variables
        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $total_items = Product::count();
        $route_name = "products";

        $products = Product::offset( ($page-1)*$perPage )->take($perPage)->get();

        return view("frontend.products", compact("products", "page", "perPage", "total_items", "route_name"));
    }

    public function product_category($category_name, $page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;

        $category = ProductCategory::where("name", $category_name)->first();
        $products = Product::where("category_id", $category->id)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Product::where("category_id", $category->id)->count();
        $route_name = "product_cat";


        return view("frontend.products")->with(compact("category", "products", "page", "perPage", "total_items", "route_name"));
    }

    public function pre_order_products($page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;

        $products = Product::where("status", PRE_ORDER)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Product::where("status", PRE_ORDER)->count();


        $route_name = "pre_order_products";
        return view("frontend.pre_order_products")->with(compact("products","page", "perPage", "total_items", "route_name"));
    }

    public function recommend_products($page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;

        $rmd = RecommendProduct::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })
            ->orderBy("lft", "ASC")
            ->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = RecommendProduct::where("display", true)
            ->orWHere(function ($query){
                $query->whereNotNull("valid_from")
                    ->whereNotNull("valid_until")
                    ->where("valid_from", "<=", now())
                    ->where("valid_until", ">=", now());
            })->count();

        $products = [];
        for($i=0; $i < count($rmd); $i++){
            $products[] = $rmd[$i]->product;
        }


        $route_name = "recommend_products";

        return view("frontend.recommend_products")->with(compact("products","page", "perPage", "total_items", "route_name"));
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

        return view("frontend.cart");
    }

    public function checkout(Request$request){

        if($request->isMethod('post')){

            foreach($request->input() as $key => $value){
                $request->session()->put($key, $value);
            }

            if(Auth::user() && $request->input("use_discount") == true && $request->filled("apply_discount") && $request->input("apply_discount") == "抵用"){

                $discount = $request->filled("point_discount") ? $request->input("point_discount") : 0;

                if(Auth::user()->points >= $discount){
                    $request->session()->put("discount", $discount);
                    $request->session()->flash('message', null);
                }
                else{
                    $request->session()->flash('message', __("Your point is not enough"));
                    $request->session()->put("discount", 0);
                    $request->session()->put("point_discount", "");
                }

            }
            else{
                return $this->place_order($request);
            }

        }

        return view("frontend.checkout");
    }

    public function place_order(Request $request){

        if(!$request->filled("term_agree") || !$request->input("term_agree")){

            $request->session()->flash('message', __("Please check term and conditions"));

            return view("frontend.checkout");
        }

        if($request->input('create_account') == true){

            if($request->input("password") != $request->input("password2")){
                $request->session()->flash('message', __("Password mismatched!"));

                return view("frontend.checkout");
            }

            $user = new User();
            $user->name = $request->input("name");
            $user->phone = $request->input("phone");
            $user->email = $request->input("email");
            $user->zipcode = $request->input('zipcode');
            $user->address = $request->input('address');
            $user->password = bcrypt($request->input("password"));

            if(preg_match('/^[^@]+/', $request->input('email'), $match)){
                $user->username = $match[0];
            }

            $user->save();

            $user->sendEmailVerificationNotification();
        }


        $discount = $request->session()->get("discount", 0);

        //Creating order
        $order = new Order([
            'order_id' => $this->randomNumber(),
            'user_id' => isset($user) ? $user->id : Auth::id() != null ? Auth::id() : null,
            'shipping_fee' => Setting::get("shipping_fee"),
            'total_amount' => Session::get("cart_total_amount") + (float) Setting::get("shipping_fee") - $discount,
            'discount' => $discount,

            'company_name'      => $request->input('company_name'),
            'country'      => $request->input('country'),
            'state'      => $request->input('state'),
            'email'      => $request->input('email'),

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

        if(Auth::user() && $discount > 0){

            Auth::user()->points -= $discount;
            Auth::user()->save();

            $point = new UserPoint([
                "user_id" => Auth::id(),
                "amount" => -$discount,
                "created_at" => now(),
                "notes" => "PLACE_ORDER"
            ]);

            $point->save();

            //Reset discount
            $request->session()->put("use_discount", false);
            $request->session()->put("discount", 0);
            $request->session()->put("point_discount", "");
        }

        $cart_items = Session::get("cart_items");
        foreach($cart_items as $item) {

            $product = Product::find($item->product_id);

            $order_item = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'color' => $item->color,
                'price' => $product->sale_price,
                'qty' => $item->qty
            ]);

            $order_item->save();

        }

        if($request->input("payment_method") == "ecpay"){
            //基本參數(請依系統規劃自行調整)
            $ecpay = new Ecpay();
            $ecpay->i()->Send['ReturnURL']         = route("order_post_back") ;
            //$ecpay->i()->Send['ClientRedirectURL']         = route("order_completed") ;
            //$ecpay->i()->Send['ClientBackURL']         = route("order_completed") ;
            $ecpay->i()->Send['OrderResultURL']    = route("order_completed") ;
            $ecpay->i()->Send['MerchantTradeNo']   = $order->order_id;           //訂單編號
            $ecpay->i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
            $ecpay->i()->Send['TotalAmount']       = $order->total_amount;                     //交易金額
            $ecpay->i()->Send['TradeDesc']         = "Online goods" ;         //交易描述
            $ecpay->i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式

            $ecpay->i()->Send['Items'] = [];



            //訂單的商品資料
            foreach($cart_items as $item){

                array_push($ecpay->i()->Send['Items'], array(
                        'Name' => $product->name,
                        'Price' => (int) $product->sale_price,
                        'Currency' => "元",
                        'Quantity' => (int) $item->qty,
                        'URL' => $product->permalink
                    )
                );
            }

            //Generate order checksum
            $arParameters = $this->getParameters($ecpay->i()->MerchantID, $ecpay->i()->Send);
            $order->checksum = \ECPay_CheckMacValue::generate($arParameters,$ecpay->i()->HashKey ,$ecpay->i()->HashIV, $arParameters['EncryptType']);
            Log::info(json_encode($arParameters));
            $order->save();

            //var_dump($order->checksum);
            //echo "<textarea>{$ecpay->i()->CheckOutString()}</textarea>";


            //Go to ECPay
            //echo "緑界頁面導向中...";
            return $ecpay->i()->CheckOutString();
        }
        else{

            return view("frontend.thankyou");
        }

    }

    private function getParameters($MerchantID, $arParameters, $arExtend = []){
        //宣告付款方式物件
        $PaymentMethod    = 'ECPay_'.$arParameters['ChoosePayment'];
        $PaymentObj = new $PaymentMethod;

        $arParameters["MerchantID"] = $MerchantID;

        //檢查參數
        $arParameters = $PaymentObj->check_string($arParameters);

        //檢查商品
        $arParameters = $PaymentObj->check_goods($arParameters);

        //檢查各付款方式的額外參數&電子發票參數
        $arExtend = $PaymentObj->check_extend_string($arExtend,$arParameters['InvoiceMark']);

        //過濾
        $arExtend = $PaymentObj->filter_string($arExtend,$arParameters['InvoiceMark']);

        //合併共同參數及延伸參數
        return array_merge($arParameters,$arExtend) ;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
    MerchantID: 2000132
    MerchantTradeNo: 01644089
    PaymentDate: 2020/05/04 10:18:28
    PaymentType: Credit_CreditCard
    PaymentTypeChargeFee: 66
    RtnCode: 1
    RtnMsg: Succeeded
    SimulatePaid: 0
    TradeAmt: 3280
    TradeDate: 2020/05/04 10:17:43
    TradeNo: 2005041017434940
    CheckMacValue: 01B2AC668617E6EDF33FBFE4B662E385
     */
    public function order_completed(Request $request){

        if($request->isMethod("post")){
            if($request->input("RtnCode") == 1){
                //Payment success
                $order = Order::where("order_id", $request->input('MerchantTradeNo'))->first();
                if($order){

                    $transaction = new Transaction();
                    $transaction->order_id = $order->id;

                    $transaction->payment_no = $request->input('TradeNo');
                    $transaction->payment_type = $request->input('PaymentType');
                    $transaction->payment_date = $request->input('PaymentDate');
                    $transaction->checksum = $request->input('CheckMacValue');

                    $transaction->save();

                    $order->status = PROCESSING;
                    $order->save();

                    return view("frontend.thankyou");

                }
                //No order found in system. Probably faked order
                else{
                    echo "Order not found";
                    redirect("/");
                }

            }
            else{
                //payment failed
                return view("frontend.payment_failed");
            }
        }
        else{
            return view("frontend.thankyou");
        }


    }

    public  function order_post_back(Request $request){

        Log::info(json_encode($request->input()));
    }

    public function order_detail($order_id, Request $request){
        $order = Order::where("order_id", $order_id)->first();

        if($request->isMethod("post")){
            if($request->input("item") && is_array($request->input("item"))){
                foreach ($request->input("item") as $id => $value) {
                    $order_item = OrderItem::find($id);
                    if($order_item){

                        if(isset($value["rating"]))
                            $order_item->rating = $value["rating"];

                        if(isset($value["review"]))
                            $order_item->review = $value["review"];

                        $order_item->review_date = now();
                        $order_item->save();

                        if($request->filled("redirect")){
                            return redirect($request->input("redirect"));

                        }
                    }
                }
            }
        }

        return view("frontend.order_detail", compact("order"));
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


    public function wishlist()
    {
        return view("frontend.wishlist");
    }



}
