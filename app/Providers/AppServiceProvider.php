<?php

namespace App\Providers;

use App\Article;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::deleting(function($article){
            foreach($article->comments as $comment)
            {
                $comment->delete();
            }
        });

        Article::restored(function($article){
            $comments = $article->comments()->onlyTrashed()->get();

            foreach($comments as $comment)
            {
                $comment->restore();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
