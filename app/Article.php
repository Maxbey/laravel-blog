<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Tag;
use App\Comment;

class Article extends Model implements SluggableInterface
{
    use SluggableTrait;
    use SoftDeletes;

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
     * Article owned by user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tags associated with given article
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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


    public function isPublished()
    {
        return $this->published_at < Carbon::now() ? true : false;
    }


}
