<?php namespace App\Models\Comment;

trait CommentModelLogic
{
    /**
     * article attribute getter.
     * @return string
     */
    public function getArticleTitleAttribute()
    {
        return $this->article->title;
    }

    /**
     * urls attribute getter.
     * @return array
     */
    public function getUrlsAttribute(){
        return  [
            'articleUrl' => action('ArticlesController@show', ['id' => $this->article->id]),
            'editUrl' => action('CommentsController@edit', ['id' => $this->id]),
            'commentUrl' => action('ArticlesController@show', ['id' => $this->article->id]) . '#comment_' . $this->id
        ];
    }

    /**
     * Return true if user_id attribute sets.
     * @return bool
     */
    public function byUser()
    {
        if ($this->user_id !== NULL) {
            return true;
        }

        return false;
    }
}