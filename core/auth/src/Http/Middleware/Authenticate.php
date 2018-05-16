<?php

namespace Youtube\Auth\Http\Middleware;

use Closure;
use Sentinel;

class Authenticate
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
        if (!Sentinel::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('access.login'));
            }
        }

        $route = $request->route()->getAction();
        if (array_key_exists('permission', $route)) {
            if ($route['permission'] && !Sentinel::getUser()->hasAccess($route['permission'])) {
                abort(401);
            }
        } elseif (array_key_exists('as', $route)) {
            if (!Sentinel::getUser()->hasAccess($route['as'])) {
                abort(401);
            }
        }

        return $next($request);
    }
}
