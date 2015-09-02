<?php

namespace App;

use App\Models\Comment\CommentModelLogic;
use App\Models\Comment\CommentModelRelations;
use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    use CommentModelRelations;
    use CommentModelLogic;

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
}
