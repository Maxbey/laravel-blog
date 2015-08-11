<?php namespace App\Services\ArticlesService;

interface IArticlesService
{
    public function create($attributes, $tags);

    public function update($id, $attributes, $tags);

    public function prepareTags(array $tags);
}