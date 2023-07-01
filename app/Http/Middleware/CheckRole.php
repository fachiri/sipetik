<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
            return redirect(route('dashboard'));
        }
        return redirect(route('login'));
    }
}
