<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Article;
use App\Permission;
use App\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface
{
    use Authenticatable, CanResetPassword;
    use SluggableTrait;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['login', 'permission_id', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /** Sluggable column.
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'login',
        'save_to'    => 'slug',
    ];

    /**
     * Carbon instances
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Appends for more convenient use in json format.
     * @return array
     */
    protected $appends = ['permissions', 'deleted'];

    /**
     * deleted attribute getter.
     * @return bool
     */
    public function getDeletedAttribute()
    {
        if($this->isDeleted())
        {
            return true;
        }

        return false;
    }

    /**
     * permissions attribute getter.
     * @return string
     */
    public function getPermissionsAttribute()
    {
        return $this->permission->group_name;
    }

    /**
     * A user can have many articles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * A user can have many comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Return user`s permission instance
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Check whether the user is an administrator.
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->permission->id === 1)
        {
            return true;
        }

        return false;
    }

    /**
     * Check whether the user is removed.
     * @return bool
     */
    public function isDeleted()
    {
        if($this->deleted_at)
        {
            return true;
        }

        return false;
    }

    /**
     * Checks whether this user is the author of the comment.
     *
     * @param $commentId
     * @return bool
     */
    public function commentAuthor($commentId)
    {
        $userCommentsIds = $this->comments()->lists('id');

        if ($userCommentsIds->contains($commentId))
        {
            return true;
        }

        return false;
    }

    /**
     * Hash password.
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
