<?php namespace App\Models\User;

trait UserModelLogic
{
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