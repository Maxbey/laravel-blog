<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = [
        'group_name'
    ];

    /**
     * All users with this permission_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
