<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
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
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'You do not have permission to do this action');

        return $next($request);
    }
}
