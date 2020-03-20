<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends CatController
{
    public function __construct(){
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //
        return view("frontend.user_dashboard");
    }

    public function points(){
        return view("frontend.points");
    }

    public function orders(){
        return view("frontend.orders");
    }


}
