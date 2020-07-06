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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends CatController
{
    public function __construct()
    {
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

    public function points()
    {
        return view("frontend.points");
    }

    public function orders()
    {
        return view("frontend.orders");
    }

    public function address()
    {
        return view("frontend.address");
    }

    public function profile()
    {
        return view("frontend.profile");
    }



    public function update(Request $request)
    {



        if ($request->filled("action")) {
            if ($request->input("action") === "update_profile") {

                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'name' => ['required', 'string', 'max:255']
                ]);

                $params = $request->only(["name", "email", "phone", "birthday", "city", "gender", "address", "zipcode", "vip_code"]);
            } else {
                $params = $request->only(["city", "address", "zipcode"]);
            }

            $redirect = redirect($request->header("referer"));

            if (Auth::user()->hasNotUpdatedAddress()) {
                event(new UpdatedAddress());
                $request->session()->flash("message", "會員資料填寫完成！恭喜您獲得回饋點數5點！");
                $redirect = redirect(route("points"));
            }

            DB::table("users")
                ->where("id", Auth::id())
                ->update($params);
        }

        return $redirect;
    }

    public function change_password(Request $request)
    {

        if ($request->isMethod("post")) {

            $user = Auth::user();

            $request->validate([
                'old_password' => [function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => 'required|confirmed|min:6'
            ]);

            DB::table("users")
                ->where("id", Auth::id())
                ->update([
                    "password" => bcrypt($request->input("password"))
                ]);

            $request->session()->flash('message', __("password has been changed successfully"));


        }

        return view("frontend.change_password");

    }

    public function setup_vip_code(){

    }


}
