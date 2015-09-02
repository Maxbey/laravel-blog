<?php namespace App\Models\Article;

use Carbon\Carbon;

trait ArticleModelLogic
{
    /**
     * deleted attribute getter.
     * @return bool
     */
    public function getDeletedAttribute()
    {
        if($this->isDeleted())
        {
            return true;
        }

        return false;
    }

    /**
     * inQueue attribute getter.
     * @return bool
     */
    public function getInQueueAttribute()
    {
        if($this->isPublished())
        {
            return false;
        }

        return true;
    }

    /**
     * Author attribute getter.
     * @return string
     */
    public function getAuthorAttribute()
    {
        return $this->user->login;
    }

    public function getUrlsAttribute()
    {
        return  [
            'showUrl' => action('ArticlesController@show', ['id' => $this->id]),
            'editUrl' => action('ArticlesController@edit', ['id' => $this->id]),
        ];
    }

    /**
     * Set the published_at attribute
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    /**
     * Get the published_at attribute
     * @param $date
     * @return string
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Fetching only published articles
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Fetching only unpublished articles
     * @param $query
     */
    public function scopeUnPublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    /**
     * Get a tag list associated with given article.
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags()->lists('name');
    }


    /**
     * Check whether the article is published.
     * @return bool
     */
    public function isPublished()
    {
        return $this->published_at < Carbon::now() ? true : false;
    }

    /**
     * Check whether the article is removed.
     * @return bool
     */
    public function isDeleted()
    {
        if($this->deleted_at)
        {
            return true;
        }

        return false;
    }
}