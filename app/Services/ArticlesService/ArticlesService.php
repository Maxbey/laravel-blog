<?php namespace App\Services\ArticlesService;

use App\Repositories\ArticlesRepository\ArticlesRepository;
use App\Repositories\TagsRepository\TagsRepository;

class ArticlesService implements IArticlesService
{
    private $articlesRepository;
    private $tagsRepository;

    public function __construct(ArticlesRepository $articlesRepository, TagsRepository $tagsRepository)
    {
        $this->articlesRepository = $articlesRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function create($attributes, $tags)
    {
        $prepared = $this->prepareTags($tags);

        return $this->articlesRepository->create($attributes, $prepared);
    }

    public function update($id, $attributes, $tags)
    {
        $prepared = $this->prepareTags($tags);

        return $this->articlesRepository->update($id, $attributes, $prepared);
    }

    /**
     * Accepts an array of tag names.
     *
     * @param array $tags
     * @return array
     */
    public function prepareTags(array $tags)
    {
        if(!count($tags)){
            return [];
        }

        $prepared = [];
        $available = $this->tagsRepository->getLists('name');

        foreach($tags as $tagName){
            if(!$available->contains($tagName))
            {
                $tag = $this->tagsRepository->create($tagName);
                $prepared[] = $tag->id;
            }
            else
            {
                $tag = $this->tagsRepository->findByTagName($tagName);
                $prepared[] = $tag->id;
            }
        }

        return $prepared;
    }
}