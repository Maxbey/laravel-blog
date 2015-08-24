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
