<?php namespace App\Repositories\ArticlesRepository;

use App\Article;

interface IArticlesRepository
{
    public function create(array $attributes, array $tagIds);

    public function update($id, array $input, array $tags);

    public function syncTags(Article $article, array $tags);
}