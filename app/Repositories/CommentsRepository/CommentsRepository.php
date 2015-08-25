<?php namespace App\Repositories\CommentsRepository;

use App\Comment;

class CommentsRepository implements ICommentsRepository
{
    private $commentModel;

    public function __construct(Comment $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function create(array $attributes)
    {
        return $this->commentModel->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $comment = $this->commentModel->findOrFail($id);

        return $comment->update($attributes);
    }
}