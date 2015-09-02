<?php

namespace App;

use App\Models\Article\ArticleModelLogic;
use App\Models\Article\ArticleModelRelations;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model implements SluggableInterface
{
    use SluggableTrait;
    use SoftDeletes;

    /**
     * Article model traits.
     */
    use ArticleModelRelations;
    use ArticleModelLogic;

    /** Sluggable column.
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    /**
     * Table name
     * @var string
     */
    protected $table = 'articles';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'user_id',
        'excerpt',
        'title',
        'body',
        'published_at'
    ];

    /**
     * Carbon instances
     * @var array
     */
    protected $dates = ['published_at', 'deleted_at'];

    /**
     * Appends for more convenient use in json format.
     * @return array
     */
    protected $appends = ['author', 'urls', 'deleted', 'inQueue'];
}
