<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CatController;

use App\Models\CartItem;
use App\Models\Newsletter;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Hoangtu92\LaravelLineLogin\Line\API\v2\LineAPIService;
use Hoangtu92\LaravelLineLogin\Line\API\v2\Response\AccessToken;
use Hoangtu92\LaravelLineLogin\Line\API\v2\Response\Profile;
use Hoangtu92\LaravelLineLogin\Utils\CommonUtils;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends CatController
{


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Where to redirect users after login.
     *
     * @return string
     * @var string
     */
    protected function redirectTo(){

        //$user = Auth::user();

        return RouteServiceProvider::HOME;

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
        //$this->middleware("g_captcha")->except('logout');
        $this->username = $this->findUsername();
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }


    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @param $getInfo
     * @param $provider
     * @return mixed
     */
    function createUser($getInfo, $provider){
        $user = User::where('username', $getInfo->id)->orWhere("email", $getInfo->email)->first();

        if (!$user) {

            $newsletter = Newsletter::where("email", $getInfo->email)->first();

            if(!$newsletter)
                Newsletter::create([
                    "email" => $getInfo->email
                ]);

            $user = User::create([
                'username' => $getInfo->id,
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider
            ]);
        }
        return $user;
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param Request $request
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(Request $request, $provider)
    {
        if($provider === "facebook"){
            return Socialite::driver("facebook")->redirect();
        }
        else if($provider === "line"){
            //Redirect to line auth
            $commonUtils = new CommonUtils;
            $state = $commonUtils->getToken();
            $lineAPIService = new LineAPIService;
            $url = $lineAPIService->getLineWebLoginUrl($state);
            return Redirect::to($url);
        }
        else{
            return redirect(route("login"));
        }

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param Request $request
     * @param $provider
     * @return array
     */
    public function handleProviderCallback(Request $request, $provider)
    {

        if($provider === "facebook"){
            try{
                $getInfo = Socialite::driver($provider)->user();
                // $user->token;
                // OAuth One Providers
                //$token = $user->token;
                //$tokenSecret = $user->tokenSecret;

                $user = $this->createUser($getInfo, "facebook");
                auth()->login($user);

                if(!$user->hasVerifiedEmail()){
                    try{
                        $user->sendEmailVerificationNotification();
                    }
                    catch(\Exception $e){
                        logger($e->getMessage());
                    }

                }


            }
            catch (\Exception $e){
                $request->session()->flash("message", __("An error occurred, please try again later").$e->getMessage());
                return redirect(route("register"));
            }

        }
        else if($provider === "line"){

            //var_dump($request->input());
            //exit();

            try{
                $code = $request->input('code');
                $state = $request->input('state');
                $scope = $request->input('scope');
                $error = $request->input('error');
                $errorCode = $request->input('errorCode');
                $errorMessage = $request->input('errorMessage');

                if (is_null($code) || !is_null($errorCode) || !is_null($errorMessage)){
                    return redirect(route('register'));
                }

                $lineAPIService = new LineAPIService;
                $token = new AccessToken($lineAPIService->accessToken($code));

                //$request->session()->put('ACCESS_TOKEN', $token->access_token);
                //$request->session()->put('REFRESH_TOKEN', $token->refresh_token);
                //$token = $request->session()->get('ACCESS_TOKEN');

                if (is_null($token->access_token)){
                    return redirect(route("home"));
                }

                $profile = $lineAPIService->profile($token->access_token);
                $info = $lineAPIService->verifyIdToken($token->id_token);

                $username = $profile['id'];

                if(preg_match("/^[^@]+/", $info['email'], $match)){
                    $username = $match[0];
                }

                $getInfo = (object) [
                    'id' => $username,
                    'email' => $info['email'],
                    'name' => $info['name']
                ];

                $user = $this->createUser($getInfo, "line");

                Auth::login($user);

                if(!$user->hasVerifiedEmail()){
                    try{
                        $user->sendEmailVerificationNotification();
                    }catch(\Exception $e){
                        logger($e->getMessage());
                    }

                }

                //exit();
                return redirect(route("address"));
            }
            catch(\Exception $e){
                //echo $e->getTraceAsString();
                return redirect(route("register"));
            }

        }
        else{
            //Redirect to home
            redirect(route("home"));
        }

        return redirect(route("address"));

    }

    protected function loggedOut(Request $request)
    {
        if($request->filled("action") && $request->input("action") !== 'save_logout'){
            //delete cart in database
            $this->shoppingCart->delete();

            Cookie::queue("wishlist", json_encode([]), 86400);
        }

    }

    protected function authenticated(Request $request, $user)
    {
        if($user->isAdmin()){
            Auth::logout();
            return \redirect(route("home"));
        }
        $usrObj = \App\Models\User::find($user->id);
        //Log::info("User #{$usrObj->id}. Total spent: {$usrObj->total}");
        if($usrObj->total >= 4000){
            $usrObj->is_vip = true;
            $usrObj->save();
            Log::info("User #{$usrObj->id} has became vip member. Total spent: {$usrObj->total}");
        }
    }


}
