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

Route::get('/news', "Frontend\FrontController@news")->name("news");
Route::get('/news/tag/{tagName}', "Frontend\FrontController@news_tag")->name("news_tag");
Route::get('/news/{slug}', "Frontend\FrontController@news_detail")->name("news_details");

Route::get('/products', "Frontend\FrontController@products")->name("products");
Route::get('/product-category/{category_name}', "Frontend\FrontController@product_category")->name("product_cat");
Route::get('/pre-order-products', "Frontend\FrontController@pre_order_products")->name("pre_order_products");
Route::get('/recommend-products', "Frontend\FrontController@recommend_products")->name("recommend_products");
Route::get('/customized-products', "Frontend\FrontController@customized_products")->name("customized_products");
Route::get('/products/{slug}', "Frontend\FrontController@product_detail");

Route::get('/checkout', "Frontend\FrontController@checkout")->name("checkout");

Route::post('/subscribe', "Frontend\FrontController@subscribe")->name("subscribe");

Route::get('/faq', "Frontend\FrontController@faq")->name("faq");
Route::any('/contact-us', "Frontend\FrontController@contact")->name("contact");

Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::middleware(["verified"])->prefix('account')->group(function () {
    Route::get('/', "Frontend\UserController@dashboard")->name("account");
    Route::get('/points', "Frontend\UserController@points")->name("points");
    Route::get('/address', "Frontend\UserController@address")->name("address");
    Route::get('/profile', "Frontend\UserController@profile")->name("profile");
    Route::get('/orders', "Frontend\UserController@orders")->name("orders");
    Route::post('/update', "Frontend\UserController@update")->name("update_user");
    Route::get('/wishlist', "Frontend\UserController@wishlist")->name("wishlist");
});
