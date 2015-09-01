<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Set the middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax', ['only' => ['comments']]);
    }

    /**
     * Show profile page
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile.index')->with(['user' => $user]);
    }

    /**
     * Return user`s comments.
     */
    public function comments()
    {
        $user = Auth::user();

        return $user->comments;
    }

}
