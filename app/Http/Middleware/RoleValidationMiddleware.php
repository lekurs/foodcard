<?php

namespace App\Http\Middleware;

use Closure;

class RoleValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 2)
    {
        if($request->user()->user_role_id <= $role) {
            return $next($request);
        }

        return abort(403);
    }
}
