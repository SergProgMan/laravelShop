<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;

class OrdersIsEmptyCart
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
        $start = Cart::get();

        if($cart->isEmpty()){
            return redirect('/');
        }

        return $next($request);
    }
}
