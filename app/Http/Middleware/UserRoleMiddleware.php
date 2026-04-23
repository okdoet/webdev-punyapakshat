<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(array_intersect($roles, $request->user()->roles()->pluck('role')->toArray())){
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
