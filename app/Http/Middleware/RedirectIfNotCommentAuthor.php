<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCommentAuthor
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

        if(!$user->commentAuthor($commentId))
        {
            return back()->with([
                'error-message' => 'You can`t edit someone else`s comment'
            ]);
        }


        return $next($request);
    }
}
