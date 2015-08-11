<?php namespace App\Repositories\TagsRepository;

interface ITagsRepository
{
    public function create($tagName);

    public function findByTagName($id);

    public function getLists($key, $value);
}