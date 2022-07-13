<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegisterActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (setting('system_user_register') == 0) {
            return abort(503);
        }
        return $next($request);
    }
}//-- end class RegisterActivation
