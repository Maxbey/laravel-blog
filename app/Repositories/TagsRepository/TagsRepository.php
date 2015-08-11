<?php namespace App\Repositories\TagsRepository;

use App\Tag;

class TagsRepository implements ITagsRepository
{
    private $tagModel;

    public function __construct(Tag $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    public function create($tagName)
    {
        return $this->tagModel->create(['name' => $tagName]);
    }

    public function findByTagName($name)
    {
        return $tag = $this->tagModel->where('name', '=', $name)->first();
    }

    public function getLists($key, $value = null)
    {
        return $this->tagModel->lists($key, $value);
    }
}