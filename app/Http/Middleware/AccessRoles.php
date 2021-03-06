<?php

namespace App\Http\Middleware;

use Closure;

class AccessRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(auth()->check() && !auth()->user()->hasRole($role)) {
            return redirect()->route('meniu');
        }
        return $next($request);
    }
}
