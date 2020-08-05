<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class RecentProduct
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

        $recent_view_products = Session::get("recent_view_products", []);

        View::share('recent_view_products', $recent_view_products);

        return $next($request);
    }
}
