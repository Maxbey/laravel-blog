<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;

class CommentsController extends Controller
{

    public function store(CommentRequest $request)
    {
        $comment = $this->createComment($request);

        return redirect('blog/articles/' . $request->article_id)->with([
            'success-message' => 'Comment has been created'
        ]);
    }

    private function createComment($request)
    {



        if(\Auth::check())
        {
            $comment = \Auth::user()->comments()->create($request->all());
        }
        else
        {
            $comment = Comment::create($request->all());
        }
        return $comment;
    }
}
