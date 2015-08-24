<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    public function articles($tagName)
    {
        $tag = Tag::findBySlugOrFail($tagName);
        $articles = $tag->articles()->published()->get();

        return view('articles.index')->with('articles', $articles);
    }
}
