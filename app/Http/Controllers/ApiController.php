<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('ajax');
    }

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

    /**
     * Return all users in json format.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function users()
    {
        $users = User::withTrashed()->get();

        return $users;
    }
}
