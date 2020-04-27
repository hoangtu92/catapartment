<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('news', 'NewsCrudController');
    Route::crud('news-tag', 'NewsTagCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('product-category', 'ProductCategoryCrudController');
    Route::crud('slide', 'SlideCrudController');
    Route::crud('transaction', 'TransactionCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('faq', 'FaqCrudController');
    Route::crud('newsletter', 'NewsletterCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('announcement', 'AnnouncementCrudController');
    Route::crud('advertisement', 'AdvertisementCrudController');
    Route::crud('message', 'MessageCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('submenu', 'SubMenuCrudController');
    Route::crud('latest-product', 'LatestProductCrudController');
    Route::crud('recommend-product', 'RecommendProductCrudController');
    Route::crud('color', 'ColorCrudController');
    Route::crud('brand', 'BrandCrudController');
}); // this should be the absolute last line of this file
