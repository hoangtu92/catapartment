<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/getProducts", "Frontend\ApiController@getProducts");
Route::get("/frames", "Frontend\ApiController@getFrames");
Route::get("/shipping_fee", "Frontend\ApiController@getShippingFee");
Route::post("/create_customized_product", "Frontend\ApiController@create_customized_product");

Route::middleware(["api, shopping_cart"])->group(function () {
    Route::post("/apply_discount", "Frontend\FrontController@apply_discount");
});
