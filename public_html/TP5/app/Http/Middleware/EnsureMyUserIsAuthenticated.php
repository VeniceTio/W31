<?php

namespace App\Http\Middleware;

use Closure;

class EnsureMyUserIsAuthenticated
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
        if (!($request->session()->has('user'))) {
            return redirect('signin')->with('message',$_SESSION['message'] ?? null);
        }
        return $next($request);
    }
}
