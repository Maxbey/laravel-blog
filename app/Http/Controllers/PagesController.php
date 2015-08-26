<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();
        $comments = Comment::take(10)->get();

        return view('pages.home')->with([
            'articles' => $articles,
            'comments' => $comments
        ]);
    }
}
