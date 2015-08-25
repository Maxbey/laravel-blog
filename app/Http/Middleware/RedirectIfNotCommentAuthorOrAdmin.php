<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotCommentAuthorOrAdmin
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
        $user = $request->user();
        $commentId = $request->route()->getParameter('comments');

        if(!$user->commentAuthor($commentId) && !$user->isAdmin())
        {
            return back()->with([
                'error-message' => 'Access Denied'
            ]);
        }

        return $next($request);
    }
}
