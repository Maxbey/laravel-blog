<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Article;
use App\Permission;
use App\Comment;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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
        return $this->belongsTo(User::class);
    }

    /**
     * Query scope for select user by given login.
     *
     * @param $query
     * @param $login
     */
    public function scopeByLogin($query, $login)
    {
        $query->where('login', '=', $login);
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
}
