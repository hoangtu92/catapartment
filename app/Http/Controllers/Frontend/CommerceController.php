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

        $total_items = Product::where("type",  NORMAL)->count();
        $route_name = "products";

        $products = [];
        //$products = Product::where("type",  NORMAL)->orderBy($orderBy, $order)->offset( ($page-1)*$perPage )->take($perPage)->get();

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
        $products = [];
        if($category)
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

        return redirect(route("home"))->with("message", "請聯繫、洽詢貓公寓拼圖坊！");


        $perPage = $request->filled("perPage") ? (int) $request->input("perPage") : 9;
        $orderBy = $request->filled("orderBy") ? $request->input("orderBy") : 'id';
        $order = $request->filled("order") ? $request->input("order") : 'asc';

        $products = Product::where("type", FRAME)->orderBy($orderBy, $order)->offset(($page-1)*$perPage)->take($perPage)->get();

        $total_items = Product::where("type", FRAME)->count();


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


        //Initiate auto discount regular member
        if(Auth::user()){
            if(!Auth::user()->is_vip ||  !$request->session()->get("vip_verified")){
                //$request->session()->put("member_discount", Setting::get("regular_member_discount"));
                $request->session()->put("member_discount", 20);
            }
        }



        if($request->isMethod('post')){



            foreach($request->input() as $key => $value){
                $request->session()->put($key, $value);
            }

            if($request->filled("action")){

                $request->validate([
                   'action' => 'required'
                ]);

                if($request->input("action") == '抵用' && Auth::user()){

                    $request->validate(["point_discount" => "required"]);

                    $discount = !empty($request->input("point_discount")) ? $request->input("point_discount") : 0;

                    $user_max_discount = round(Auth::user()->points/Setting::get("point_ratio"));

                    if($user_max_discount >= $discount){
                        $request->session()->put("discount", $discount);
                    }
                    else{
                        $request->session()->put("discount", 0);
                        $request->session()->put("point_discount", null);
                        return redirect(route("checkout"))->with("message", "您尚未有足夠點數可以折抵");
                    }



                }

                //Vip code discount
                if($request->input("action") == "驗證" && Auth::user() && Auth::user()->is_vip){
                    $request->validate(["vip_code"]);

                    $vipCode = $request->input("vip_code");
                    if($vipCode == Auth::user()->vip_code){
                        $request->session()->put("vip_verified", true);

                        $md = 20;//Setting::get("regular_member_discount");
                        $md += (10*20)/100;//(Setting::get("vip_member_discount")*$md) / 100;

                        $request->session()->put("member_discount", round($md));

                    }
                }

                if($request->session()->get("delivery") == 'flat_rate')
                    $request->session()->put("shipping_fee", Setting::get("shipping_fee"));
                else $request->session()->put("shipping_fee", 0);
            }

            else{

                return $this->place_order($request);
            }

        }


        return view("frontend.checkout");
    }

    public function place_order(Request $request)
    {

        $validate = [
            'term_agree' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'zipcode' => 'required',
            'address' => 'required',
            'delivery' => 'required'
        ];


        if ($request->input('create_account') == true) {

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

            if (preg_match('/^[^@]+/', $request->input('email'), $match)) {
                $user->username = $match[0];
            }

            $user->save();

            $user->sendEmailVerificationNotification();
        } else {
            $request->validate($validate);
        }


        //POint discount
        $discount = $request->session()->get("discount", 0);


        //Member discount
        $member_discount = 0;
        if (Auth::user()){
            $md = $request->session()->get("member_discount", 0);
            $member_discount = round(($md / 100) * $this->shoppingCart->cartData['total']);
        }


        //Order summary
        $shipping_fee = $request->input('delivery') == "flat_rate" ? (float) Setting::get("shipping_fee") : 0;
        $sub_total = $this->shoppingCart->cartData['total'];
        $total_amount = round($this->shoppingCart->cartData['total'] + $shipping_fee - $discount - $member_discount);

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
            //$request->session()->put("use_discount", false);
            $request->session()->put("discount", 0);
            $request->session()->put("point_discount", "");
        }

        $cart_items = $this->shoppingCart->cartData['items'];
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
                        'price' => $product->realPrice,
                        'qty' => $item->qty
                    ]);

                    $order_item->save();

                    $items[] = array(
                        'Name' => $product->name,
                        'Price' => (int) $product->realPrice,
                        'Currency' => "元",
                        'Quantity' => (int) $item->qty,
                        'URL' => $product->permalink
                    );
                }
            }

        }

        //Send email
        Mail::send(new OrderComplete($order));

        if($request->input("payment_method") == "ecpay"){
            //基本參數(請依系統規劃自行調整)
            $ecpay = new Ecpay();
            $ecpay->i()->Send['ReturnURL']         = route("order_completed") ;
            //$ecpay->i()->Send['ClientRedirectURL']         = route("thank_you") ;
            $ecpay->i()->Send['ClientBackURL']         = route("thank_you") ;
            //$ecpay->i()->Send['OrderResultURL']    = route("order_completed") ;
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

            $order->save();


            //var_dump($order->checksum);
            //echo "<textarea>{$ecpay->i()->CheckOutString()}</textarea>";


            //Go to ECPay
            //echo "緑界頁面導向中...";
            return $ecpay->i()->CheckOutString();
        }
        else{

            return redirect(route("thank_you"));
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
     * @return int
     *
     * MerchantID: 2000132
    * MerchantTradeNo: 01644089
    * PaymentDate: 2020/05/04 10:18:28
    * PaymentType: Credit_CreditCard
    * PaymentTypeChargeFee: 66
    * RtnCode: 1
    * RtnMsg: Succeeded
    * SimulatePaid: 0
    * TradeAmt: 3280
    * TradeDate: 2020/05/04 10:17:43
    * TradeNo: 2005041017434940
    * CheckMacValue: 01B2AC668617E6EDF33FBFE4B662E385
     */
    public function order_completed(Request $request){


        if($request->isMethod("post")){
            if((int) $request->input('RtnCode') == 1){
                //Payment success
                $order = Order::where("order_id", $request->input('MerchantTradeNo'))->first();
                if($order){

                    $order->payment_no = $request->input('TradeNo');
                    $order->payment_type = $request->input('PaymentType');
                    $order->payment_date = $request->input('PaymentDate');
                    $order->payment_status = PAID;
                    $order->status = COMPLETED;
                    $order->save();
                    Log::info("Order {$order->order_id}");
                    Log::info(json_encode($request->input()));

                    if($order->user){
                        //Reward
                        $reward_point = new UserPoint([
                            "user_id" => $order->user->id,
                            "amount" => $order->sub_total,
                            "created_at" => now(),
                            "notes" => "消費積分"
                        ]);

                        $reward_point->save();
                        $order->user->points += $reward_point->amount;

                        $order->user->save();
                    }


                }
            }
            //No order found in system. Probably faked order

        }

        return 1;

    }

    public function thank_you(){
        //clear cart
        $this->shoppingCart->delete();
        Session::put("cart_items", json_encode([]));
        $shoppingCart = ["count" => 0, "total" => 0];

        return view("frontend.thankyou")->with(compact("shoppingCart"));
    }

    public function payment_failed(){
        return view("frontend.payment_failed");
    }

    public  function order_post_back(Request $request){

        //Log::info(json_encode($request->input()));
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
