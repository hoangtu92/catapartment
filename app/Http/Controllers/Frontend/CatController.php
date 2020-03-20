<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Announcement;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CatController extends Controller
{
    public function __construct(){
        $product_categories = ProductCategory::all();
        $announcements = Announcement::all();
        $advertisements = Advertisement::all();

        View::share('product_categories', $product_categories);
        View::share('announcements', $announcements);
        View::share('advertisements', $advertisements);
    }
}
