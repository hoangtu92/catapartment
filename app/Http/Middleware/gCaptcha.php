<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class gCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->isMethod("post")){
            $request->validate([
                "_g_token" => "present"
            ]);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query([
                "secret" => env("g_secret_key"),
                "response" => $request->_g_token,
                "remoteip" => $request->getClientIp()
            ]));


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);

            Log::info($server_output);

            $response = json_decode($server_output);

            if ($response->success) {
                return $next($request);
            }
            else{
                return Redirect::back()->with("message", "There is a problem during verify your identify");
            }
        }
        return $next($request);
    }
}
