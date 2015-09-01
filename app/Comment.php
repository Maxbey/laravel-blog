<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * Table name
     * @var string
     */
    protected $table = 'comments';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'user_id',
        'article_id',
        'author',
        'body'
    ];

    /**
     * Carbon instances.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Appends for more convenient use in json format.
     * @return array
     */
    protected $appends = ['articleTitle', 'urls'];

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
     * Comment owned by user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The article to which the comment belongs.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
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
