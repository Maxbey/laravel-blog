<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use App\Article;

class Tag extends Model implements SluggableInterface
{
    use SluggableTrait;

    /** Sluggable column.
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    /**
     * Table name.
     * @var string
     */
    protected $table = 'tags';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the articles associated with given tag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
