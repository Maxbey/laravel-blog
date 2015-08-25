<?php namespace App\Services\CommentsService;

interface ICommentsService
{
    public function create($attributes, $articleId, $user);

    public function update($id, $attributes, $user);
}