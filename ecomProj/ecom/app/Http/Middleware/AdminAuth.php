<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if($request -> session() -> has('ADMIN_LOGGED_IN')){

        }else{
            $request -> session() -> flash('error','Please login first');
            return redirect('admin');
        }
        return $next($request);
    }
}
