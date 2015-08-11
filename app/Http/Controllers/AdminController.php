<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Set the middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function articlesControl()
    {
        $articles = Article::withTrashed()->get();

        return view('admin.articles')->with([
            'articles' => $articles
        ]);
    }

    public function usersControl()
    {
        $users = User::all();

        return view('admin.users')->with([
            'users' => $users
        ]);
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.delete_article')->with([
            'article' => $article
        ]);
    }
}
