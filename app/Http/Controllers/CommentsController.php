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

        return redirect('blog/' . $request->article_id . '#' . 'comment_' . $comment->id)->with([
            'message' => 'Comment has been created'
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
