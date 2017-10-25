<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ProfileAuth
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

        $r = str_replace('%20', ' ', $request->path());
        
        if (!preg_match('/'.auth()->user()->name.'/', $r))
        {
            return redirect('/');
        }

        return $next($request);
    }
}
