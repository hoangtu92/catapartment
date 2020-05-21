<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/products/{page?}', "Frontend\FrontController@products")->name("products");
Route::get('/product-category/{category_name}/{page?}', "Frontend\FrontController@product_category")->name("product_cat");
Route::get('/pre-order-products/{page?}', "Frontend\FrontController@pre_order_products")->name("pre_order_products");
Route::get('/recommend-products/{page?}', "Frontend\FrontController@recommend_products")->name("recommend_products");
Route::get('/customized-products', "Frontend\FrontController@customized_products")->name("customized_products");
Route::get('/products/detail/{slug?}', "Frontend\FrontController@product_detail")->name("product_detail");

Route::any('/checkout', "Frontend\FrontController@checkout")->name("checkout");

Route::post('/subscribe', "Frontend\FrontController@subscribe")->name("subscribe");

Route::get('/faq', "Frontend\FrontController@faq")->name("faq");
Route::any('/contact-us', "Frontend\FrontController@contact")->name("contact");

Route::any('/wishlist', "Frontend\FrontController@wishlist")->name("wishlist");

Route::any("/shopping-cart", "Frontend\FrontController@cart")->name("cart");
Route::any("/order/{order_id}", "Frontend\FrontController@order_detail")->name("order_detail");


Route::any("/order-complete", "Frontend\FrontController@order_completed")->name("order_completed");
Route::post("/order-post-back", "Frontend\FrontController@order_post_back")->name("order_post_back");

Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::middleware(["verified"])->prefix('account')->group(function () {
    Route::get('/', "Frontend\UserController@dashboard")->name("account");
    Route::get('/points', "Frontend\UserController@points")->name("points");
    Route::get('/address', "Frontend\UserController@address")->name("address");
    Route::get('/profile', "Frontend\UserController@profile")->name("profile");
    Route::any('/change-password', "Frontend\UserController@change_password")->name("change_password");
    Route::get('/orders', "Frontend\UserController@orders")->name("orders");
    Route::post('/update', "Frontend\UserController@update")->name("update_user");

});
