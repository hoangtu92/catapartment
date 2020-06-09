<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\OrderComplete;
use App\Models\Brand;
use App\Models\CustomizedProduct;
use App\Models\Frame;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Origin;
use App\Models\Piece;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RecommendProduct;
use App\Models\Transaction;
use App\Models\UserPoint;
use App\User;
use Backpack\Settings\app\Models\Setting;
use flamelin\ECPay\Ecpay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CommerceController extends CatController
{

    //Index
    /**
     * FrontController constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    public function products($page = 1, Request $request){
        //Pagination variables
        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';

        $total_items = Product::count();
        $route_name = "products";

        $products = Product::orderBy($orderBy, $order)->offset( ($page-1)*$perPage )->take($perPage)->get();

        $brands = Brand::all();
        $origins = Origin::all();
        $pieces = Piece::all();

        return view("frontend.products", compact("products", "brands", "origins", "pieces", "page", "perPage", "total_items", "route_name", "order", "orderBy"));
    }

    public function product_category($category_name, $page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';

        $category = ProductCategory::where("name", $category_name)->first();
        $products = Product::where("category_id", $category->id)->orderBy($orderBy, $order)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Product::where("category_id", $category->id)->count();
        $route_name = "product_cat";
        $route_params = ['category_name' => $category_name];

        $brands = Brand::all();
        $origins = Origin::all();
        $pieces = Piece::all();


        return view("frontend.products")->with(compact("category", "products", "brands", "origins", "pieces", "page", "perPage", "total_items", "route_name", "order", "orderBy", "route_params"));
    }

    public function pre_order_products($page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';

        $products = Product::where("status", PRE_ORDER)->orderBy($orderBy, $order)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Product::where("status", PRE_ORDER)->count();


        $route_name = "pre_order_products";
        return view("frontend.pre_order_products")->with(compact("products","page", "perPage", "total_items", "route_name", "order", "orderBy"));
    }

    public function customized_products($page = 1, Request $request){

        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';

        $products = Frame::orderBy($orderBy, $order)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Frame::count();


        $route_name = "customized_products";

        return view("frontend.customized_products")->with(compact("products","page", "perPage", "total_items", "route_name", "order", "orderBy"));;
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

    public function product_detail($slug){

        $product = Product::where("slug", $slug)->firstOrFail();

        $product->view++;
        $product->save();

        $hot_products = Product::orderByDesc("view")->limit(6)->get();

        $recent_view_products = Session::get("recent_view_products", []);

        $recent_view_products[$product->id] = $product;

        Session::put("recent_view_products", $recent_view_products);


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

        if(Auth::user() && \App\Models\User::find(Auth::id())->isVip()){
            $md = Setting::get("vip_member_discount");
        }
        else{
            $md = Setting::get("regular_member_discount");
        }

        $request->session()->put("member_discount", $md);

        if($request->isMethod('post')){



            foreach($request->input() as $key => $value){
                $request->session()->put($key, $value);
            }

            if($request->filled("action")){

                $request->validate([
                   'action' => 'required',
                    'point_discount' => 'required'
                ]);

                if($request->input("action") == '抵用' && Auth::user() && $request->input("use_discount") == true){
                    $discount = $request->filled("point_discount") ? $request->input("point_discount") : 0;

                    $discount = $discount/100;

                    if(Auth::user()->points >= $discount){
                        $request->session()->put("discount", $discount);
                        $request->session()->flash('message', null);
                    }
                    else{
                        $request->session()->flash('message', __("Your point is not enough"));
                        $request->session()->put("discount", 0);
                        $request->session()->put("point_discount", null);
                    }

                }

                if($request->session()->get("delivery") == 'flat_rate') $request->session()->put("shipping_fee", Setting::get("shipping_fee"));
                else $request->session()->put("shipping_fee", 0);
            }

            else{

                return $this->place_order($request);
            }

        }


        return view("frontend.checkout");
    }

    public function place_order(Request $request){

        /*if(!$request->filled("term_agree") || !$request->input("term_agree")){

            $request->session()->flash('message', __("Please check term and conditions"));

            return view("frontend.checkout");
        }*/

        $validate = [
            'term_agree' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'zipcode' => 'required',
            'address' => 'required'
        ];


        if($request->input('create_account') == true){

            $validate['password'] = 'required|confirmed|min:6';
            $validate['password_confirmation'] = 'same:password';
            $validate['email'] = "email|required|unique:users";

            $request->validate($validate);


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
        else{
            $request->validate($validate);
        }


        //POint discount
        $discount = $request->session()->get("discount", 0);


        //Member discount
        if(Auth::user() && \App\Models\User::find(Auth::id())->isVip()){
            $md = Setting::get("vip_member_discount");
        }
        else{
            $md = Setting::get("regular_member_discount");
        }

        $member_discount = ($md/100)*Session::get("cart_total_amount");

        //Order summary
        $shipping_fee = $request->input('delivery') == "flat_rate" ? (float) Setting::get("shipping_fee") : 0;
        $sub_total = Session::get("cart_total_amount");
        $total_amount = Session::get("cart_total_amount") + $shipping_fee - $discount - $member_discount;

        //Creating order
        $order = new Order([
            'order_id' => $this->randomNumber(),
            'user_id' => isset($user) ? $user->id : Auth::id() != null ? Auth::id() : null,
            'shipping_fee' => $shipping_fee,
            'total_amount' => $total_amount,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'member_discount' => $member_discount,

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


        //Deduce discount
        if(Auth::user() && $discount > 0){

            Auth::user()->points -= $discount;
            Auth::user()->save();

            $point = new UserPoint([
                "user_id" => Auth::id(),
                "amount" => -$discount,
                "created_at" => now(),
                "notes" => "使用消費積分扣抵"
            ]);

            $point->save();

            //Reset discount
            $request->session()->put("use_discount", false);
            $request->session()->put("discount", 0);
            $request->session()->put("point_discount", "");
        }

        $cart_items = Session::get("cart_items");
        $items = [];
        foreach($cart_items as $item) {

            if($item->product_id){
                $product = Product::find($item->product_id);

                if($product){
                    $order_item = new OrderItem([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_image' => $product->image,
                        'product_name' => $product->name,
                        'attr' => isset($item->attr) ? $item->attr : [],
                        'price' => $product->sale_price,
                        'qty' => $item->qty
                    ]);

                    $order_item->save();

                    $items[] = array(
                        'Name' => $product->name,
                        'Price' => (int) $product->sale_price,
                        'Currency' => "元",
                        'Quantity' => (int) $item->qty,
                        'URL' => $product->permalink
                    );
                }
            }

            else if($item->customized_product_id){
                $customized_product = CustomizedProduct::find($item->customized_product_id);

                if($customized_product){
                    $order_item = new OrderItem([
                        'order_id' => $order->id,
                        'customized_product_id' => $item->customized_product_id,
                        'product_image' => $customized_product->frame->image,
                        'product_name' => $customized_product->frame->name,
                        'attr' => $item->attr,
                        'price' => $customized_product->price,
                        'qty' => $item->qty
                    ]);

                    $order_item->save();

                    $items[] = array(
                        'Name' => $customized_product->frame->name,
                        'Price' => (int) $customized_product->price,
                        'Currency' => "元",
                        'Quantity' => (int) $item->qty,
                        'URL' => ""
                    );
                }


            }


        }

        //Send email
        Mail::send(new OrderComplete($order));


        if($request->input("payment_method") == "ecpay"){
            //基本參數(請依系統規劃自行調整)
            $ecpay = new Ecpay();
            $ecpay->i()->Send['ReturnURL']         = route("order_post_back") ;
            //$ecpay->i()->Send['ClientRedirectURL']         = route("order_completed") ;
            //$ecpay->i()->Send['ClientBackURL']         = route("order_completed") ;
            $ecpay->i()->Send['OrderResultURL']    = route("order_completed") ;
            $ecpay->i()->Send['MerchantTradeNo']   = $order->order_id;           //訂單編號
            $ecpay->i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
            $ecpay->i()->Send['TotalAmount']       = round($order->total_amount);                     //交易金額
            $ecpay->i()->Send['TradeDesc']         = "Online goods" ;         //交易描述
            $ecpay->i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式

            $ecpay->i()->Send['Items'] = [];



            //訂單的商品資料
            $ecpay->i()->Send['Items'] = $items;

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

                    if(Auth::user()){
                        //Reward
                        $reward_point = new UserPoint([
                            "user_id" => Auth::id(),
                            "amount" => $order->sub_total,
                            "created_at" => now(),
                            "notes" => "消費積分"
                        ]);

                        $reward_point->save();
                        Auth::user()->points += $reward_point->amount;

                        Auth::user()->save();
                    }

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


    public function wishlist()
    {
        return view("frontend.wishlist");
    }



}
