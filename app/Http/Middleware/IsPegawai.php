<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPegawai
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
        if (
            (Auth::user() && Auth::user()->is_admin == null) ||
            Auth::user()->is_admin == 0
        ) {
            return $next($request);
        }

        return redirect("/admin");
    }
}
