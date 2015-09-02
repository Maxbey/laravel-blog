<?php namespace App\Models\Article;

use App\Comment;
use App\Tag;
use App\User;

trait ArticleModelRelations
{
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

    /**
     * A user can have many comments.
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}