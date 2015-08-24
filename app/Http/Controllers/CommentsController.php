<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'update']]);
        $this->middleware('commentAuthor', ['only' => ['edit', 'update']]);
    }

    public function store(CommentRequest $request, $articleId)
    {
        $attributes = $request->all();
        $attributes['article_id'] = $articleId;

        $comment = $this->createComment($attributes);

        return redirect('blog/articles/' . $articleId)->with([
            'success-message' => 'Comment has been created'
        ]);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit')->with([
            'comment' => $comment
        ]);
    }

    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $attributes = $request->all();
        $attributes['author'] = Auth::user()->login;


        $comment->update($attributes);


        return redirect('im')->with([
            'success-message' => 'Comment has been updated'
        ]);

    }

    private function createComment($attributes)
    {
        if(Auth::check())
        {
            $attributes['author'] = Auth::user()->login;
            $comment = Auth::user()->comments()->create($attributes);
        }
        else
        {
            $comment = Comment::create($attributes);
        }
        return $comment;
    }
}
