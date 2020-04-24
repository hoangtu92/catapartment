<?php

namespace App\Http\Controllers\Frontend;

use App\Events\UpdatedAddress;
use App\Http\Controllers\Controller;
use App\Listeners\UserUpdatedAddress;
use App\Models\ProductCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function address(){
        return view("frontend.address");
    }

    public function profile(){
        return view("frontend.profile");
    }

    public function wishlist(){
        return view("frontend.wishlist");
    }

    public function update(Request $request){
        if($request->filled("action")){
            if($request->input("action") === "update_profile"){
                $params = $request->only(["name", "email", "phone", "birthday", "city", "gender", "address", "zipcode"]);
            }
            else{
                $params = $request->only(["city","address", "zipcode"]);
            }

            $redirect = redirect($request->header("referer"));

            if(Auth::user()->hasNotUpdatedAddress()){
                event(new UpdatedAddress());
                $request->session()->flash("message", "會員資料填寫完成！恭喜您獲得回饋點數5點！");
                $redirect =  redirect(route("points"));
            }

            DB::table("users")
                ->where("id", Auth::id())
                ->update($params);
        }

        return $redirect;
    }


}
