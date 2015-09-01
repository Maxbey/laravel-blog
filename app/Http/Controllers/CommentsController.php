<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentsService\CommentsService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    private $commentsService;

    /**
     * Set the middleware.
     */
    public function __construct(CommentsService $service)
    {
        $this->commentsService = $service;

        $this->middleware('auth', ['except' => ['store']]);
        $this->middleware('commentAuthor', ['only' => ['edit', 'update']]);
        $this->middleware('commentAuthorOrAdmin', ['only' => ['destroy', 'restore']]);
        $this->middleware('ajax', ['only' => ['destroy', 'restore']]);
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
        $user = $request->user();
        $session = $request->session();

        $this->commentsService->create($attributes, $articleId, $user, $session);

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
        $attributes = $request->all();
        $user = $request->user();

        $this->commentsService->update($id ,$attributes, $user);

        return back()->with([
            'success-message' => 'Comment has been updated'
        ]);

    }

    /**
     * Delete the comment.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $comment = Comment::findOrFail($request['id']);
        $comment->delete();

        return response('Comment has been deleted', 202);
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

        return response('Comment has been restored', 202);
    }
}
