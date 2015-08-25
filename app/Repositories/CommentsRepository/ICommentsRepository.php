<?php namespace App\Repositories\CommentsRepository;

use App\Comment;

interface ICommentsRepository
{
    public function create(array $attributes);

    public function update($id, array $attributes);
}