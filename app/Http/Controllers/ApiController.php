<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Return all articles in json format.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function articles()
    {
        $articles = Article::withTrashed()->get();

        return $articles;
    }
}
