<?php

namespace Youtube\Auth\Http\Middleware;

use Closure;
use Sentinel;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @return mixed
     * @author Toinn
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check()) {
            return redirect(route('dashboard.index'));
        }

        return $next($request);
    }
}
