<?php

namespace App\Http\Middleware;

use Closure;

class StoreRestrictionsMiddleware
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
        $slug = $request->route('slug');
        return $request->user()->stores()->whereSlug($slug)->first() ? $next($request) : abort(403);
    }
}
