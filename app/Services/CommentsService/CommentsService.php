<?php namespace App\Services\CommentsService;

use App\Repositories\CommentsRepository\CommentsRepository;

class CommentsService implements ICommentsService
{
    private $commentsRepository;

    public function __construct(CommentsRepository $repository)
    {
        $this->commentsRepository = $repository;
    }

    public function create($attributes, $articleId, $user)
    {
        $attributes['article_id'] = $articleId;

        if($user)
        {
            $attributes['author'] = $user->login;
            $comment = $user->comments()->create($attributes);
        }
        else
        {
            $comment = $this->commentsRepository->create($attributes);
        }

        return $comment;
    }

    public function update($id, $attributes, $user)
    {
        $attributes['author'] = $user->login;
        $comment = $this->commentsRepository->update($id, $attributes);

        return  $comment;
    }
}