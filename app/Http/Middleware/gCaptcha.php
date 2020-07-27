<?php

namespace App\Http\Middleware;

use Closure;

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
                "_g_token" => "required"
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

            $response = json_decode($server_output);

            if ($response->success) {

            }
            else{
                return redirect(route("home"));
            }
        }
        return $next($request);
    }
}
