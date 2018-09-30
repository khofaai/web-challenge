<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthoriseClient
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

        if (Auth::check()) {

            return $next($request);
        }
        abort(403, 'not allowed for this action');
    }
}
