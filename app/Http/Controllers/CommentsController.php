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
    /**
     * Set the middleware.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store']]);
        $this->middleware('commentAuthor', ['only' => ['edit', 'update']]);
        $this->middleware('commentAuthorOrAdmin', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Save comment to the storage.
     *
     * @param CommentRequest $request
     * @param $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request, $articleId)
    {
        $attributes = $request->all();
        $attributes['article_id'] = $articleId;

        $comment = $this->createComment($attributes);

        return redirect('blog/articles/' . $articleId)->with([
            'success-message' => 'Comment has been created'
        ]);
    }

    /**
     * Show edit comment form.
     *
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit')->with([
            'comment' => $comment
        ]);
    }

    /**
     * Update comment record in the database.
     *
     * @param CommentRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Create record in the storage.
     * @param $attributes
     * @return static
     */
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

    /**
     * Delete the comment.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Comment::destroy($id);

        return back()->with([
            'success-message' => 'Comment has been deleted'
        ]);
    }

    /**
     * Restore the comment.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->restore();

        return back()->with([
            'success-message' => 'Comment has been restored'
        ]);
    }
}
