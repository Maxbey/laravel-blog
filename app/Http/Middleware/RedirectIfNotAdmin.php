<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAdmin
{
    /**
     * Check whether the user is an administrator.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->isAdmin())
        {
            return $next($request);
        }

        return back()->with([
            'error-message' => 'Only the administrator can visit this part'
        ]);
    }
}
