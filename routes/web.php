<?php


use App\Classes\ImportProduct;
use App\Models\Brand;
use App\Models\Origin;
use App\Models\Piece;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', "Frontend\FrontController@home")->name("home");
Route::get('/search', "Frontend\FrontController@search")->name("search");

Route::get('/news/{page?}', "Frontend\FrontController@news")->name("news");
Route::get('/news/tag/{tagName}/{page?}', "Frontend\FrontController@news_tag")->name("news_tag");
Route::get('/news/detail/{slug}', "Frontend\FrontController@news_detail")->name("news_details");

Route::get('/page/{slug}', "Frontend\FrontController@page")->name("page");

Route::get('/faq', "Frontend\FrontController@faq")->name("faq");
Route::get('/contact-us', "Frontend\FrontController@contact")->name("contact");
Route::post('/contact-us', "Frontend\FrontController@contact")->name("contact_post")->middleware("g_captcha");

Route::get('/products/{page?}', "Frontend\CommerceController@products")->name("products");
Route::get('/product-category/{category_name}/{page?}', "Frontend\CommerceController@product_category")->name("product_cat");
Route::get('/pre-order-products/{page?}', "Frontend\CommerceController@pre_order_products")->name("pre_order_products");
Route::get('/recommend-products/{page?}', "Frontend\CommerceController@recommend_products")->name("recommend_products");
Route::get('/customized-products', "Frontend\CommerceController@customized_products")->name("customized_products");
Route::get('/products/detail/{slug?}', "Frontend\CommerceController@product_detail")->name("product_detail");

Route::any('/checkout', "Frontend\CommerceController@checkout")->name("checkout");

Route::any('/subscribe', "Frontend\FrontController@subscribe")->name("subscribe");
Route::any('/product_notify', "Frontend\FrontController@product_notify")->name("product_notify");

Route::any('/wishlist', "Frontend\CommerceController@wishlist")->name("wishlist");

Route::any("/shopping-cart", "Frontend\CommerceController@cart")->name("cart");
Route::any("/order/{order_id}", "Frontend\CommerceController@order_detail")->name("order_detail");


Route::any("/order-complete", "Frontend\CommerceController@order_completed")->name("order_completed");
Route::any("/arcrma-order-complete", "Frontend\CommerceController@arcrma_order_completed")->name("arcrma_order_completed");
Route::post("/order-post-back", "Frontend\CommerceController@order_post_back")->name("order_post_back");
Route::get("/thank_you", "Frontend\CommerceController@thank_you")->name("thank_you");
Route::get("/payment_failed", "Frontend\CommerceController@payment_failed")->name("payment_failed");
Route::post("/validate_vip", "Frontend\CommerceController@validate_vip")->name("validate_vip");

Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get("/test", function (){
    $arcrma = new \App\Classes\ARCRMA();
    //$order = \App\Models\Order::find(1);
    $product = \App\Models\Product::find(1261);

  echo $arcrma->updateProduct($product, "delete")->asXML();
  exit();

});


Route::get("/test-order", function (){
    $arcrma = new \App\Classes\ARCRMA();
    $order = \App\Models\Order::find(8);

    echo $arcrma->sendOrderForm($order);
    exit();

});

Route::get("/clear-products", function (){
    $products = \App\Models\Product::all();
    foreach ($products as $product){
        $product->delete();
    }
});
Route::get("/import-products", function (){

    set_time_limit(0);
    ini_set('max_execution_time', 0);

    $import_lists = [
        //"products.xlsx",
        //"Ensky excel.xlsx",
        "galison excel.xlsx",

        //"mudpuppy excel.xlsx",
        //"Tenyo excel.xlsx",
        //"台旺excel.xlsx",
        //"品圖藝術excel.xlsx",

        //"拼圖總動員 excel.xlsx",
        //"貓公寓_商品批次匯入Castorland.xlsx",
        //"貓公寓_商品批次匯入CobbleHill.xlsx",

        //"貓公寓_商品批次匯入EPOCH.xlsx",
        //"貓公寓_商品批次匯入Eurographics.xlsx",
        //"貓公寓_商品批次匯入grafika.xlsx",

        //"new/bluebird.xlsx",
        //"new/Clementoni.xlsx",
        //"new/dToys.xlsx",
        //"new/educa.xlsx",
        //"new/Gibsons.xlsx",
        //"new/OtterHouse.xlsx",
        //"new/SunsOut.xlsx",
    ];
    foreach ($import_lists as $p){

        echo "Importing $p<br>";
        ImportProduct::import($p);
    }

});


Route::middleware(["verified"])->prefix('account')->group(function () {
    Route::get('/', "Frontend\UserController@dashboard")->name("account");
    Route::get('/points', "Frontend\UserController@points")->name("points");
    Route::get('/address', "Frontend\UserController@address")->name("address");
    Route::get('/profile', "Frontend\UserController@profile")->name("profile");
    Route::any('/change-password', "Frontend\UserController@change_password")->name("change_password");
    Route::get('/orders', "Frontend\UserController@orders")->name("orders");
    Route::post('/update', "Frontend\UserController@update")->name("update_user");
});
