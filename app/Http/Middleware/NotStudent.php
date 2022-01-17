<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = strtolower(auth()->user()->role_name);

        if ($role !== 'student' && $role !== 'undefined') return $next($request);

        abort(403);
    }
}
