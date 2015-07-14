<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Article extends Model
{

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
        'title',
        'body',
        'excerpt',
        'published_at'
    ];

    /**
     * Carbon instances
     * @var array
     */
    protected $dates = ['published_at'];

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
     * Article owned by user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
