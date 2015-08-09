<?php namespace App\Repositories\ArticlesRepository;

use App\Article;

class ArticlesRepository implements IArticlesRepository
{
    private $articleModel;

    public function __construct(Article $articleModel)
    {
        $this->articleModel = $articleModel;
    }

    /**
     * Save a new article.
     *
     * @param array $attributes
     * @param array $tagIds
     * @return Article
     */
    public function create(array $attributes, array $tagIds)
    {
        $article = \Auth::user()->articles()->create($attributes);

        $this->syncTags($article, $tagIds);

        return $article;
    }

    /**
     * Sync up the list of tags in the database
     *
     * @param Article $article
     * @param array $tags
     * @return Article
     */
    public function syncTags(Article $article, array $tags)
    {
        $article->tags()->sync($tags);

        return $article;
    }

    /**
     * Update article attributes and sync up tags.
     * @param $id
     * @param array $input
     * @param array $tagIds
     * @return Article
     */
    public function update($id, array $input, array $tagIds)
    {
        $article = $this->articleModel->findOrFail($id);
        $article->update($input);

        return $this->syncTags($article, $tagIds);
    }
}
