<?php

namespace App\Providers;

use App\Article;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private function deleteResources($resources)
    {
        foreach($resources as $resource)
        {
            $resource->delete();
        }
    }

    private function restoreResources($resources)
    {
        foreach($resources as $resource)
        {
            $resource->restore();
        }
    }

    private function handleArticleEvents()
    {
        Article::deleting(function($article){
            $this->deleteResources($article->comments);
        });

        Article::restored(function($article){
            $comments = $article->comments()->onlyTrashed()->get();

            $this->restoreResources($comments);
        });
    }

    private function handleUserEvents()
    {
        User::deleting(function($user){
            $this->deleteResources($user->comments);
        });

        User::restored(function($user){
            $comments = $user->comments()->onlyTrashed()->get();

            $this->restoreResources($comments);
        });
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleArticleEvents();
        $this->handleUserEvents();
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
