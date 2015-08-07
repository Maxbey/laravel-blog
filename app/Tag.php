<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Tag extends Model
{
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

    public function setNameAttribute($tag)
    {
        $this->attributes['name'] = str_slug($tag, '_');
    }
}
