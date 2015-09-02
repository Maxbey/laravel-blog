<?php

namespace App\Http\Controllers;

use App\Article;
use App\Repositories\KeysRepository\KeysRepository;
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

    /**
     * Show admin dashboard.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show articles management page.
     * @return \Illuminate\View\View
     */
    public function articlesControl()
    {
        $articles = Article::withTrashed()->get();

        return view('admin.articles')->with([
            'articles' => $articles
        ]);
    }

    /**
     * Show users management page.
     * @return \Illuminate\View\View
     */
    public function usersControl()
    {
        $users = User::withTrashed()->get();

        return view('admin.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show invitation keys management page.
     */
    public function keysControl(KeysRepository $repository)
    {
        $keys = $repository->all();

        return view('admin.keys')->with([
            'keys'  =>  $keys
        ]);
    }
}
