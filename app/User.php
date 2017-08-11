<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get the created date formatted with time
    */
    function getFormattedCreatedDateTime()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    /**
    * Get the updated date formatted with time
    */
    function getFormattedUpdatedDateTime()
    {
        return $this->updated_at->format('d/m/Y H:i:s');
    }

    /**
    * Get the created date string formatted
    */
    function getCreatedDateTime()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    /**
    * Get the updated date string formatted
    */
    function getUpdatedDateTime()
    {
        return $this->updated_at->format('Y-m-d H:i:s');
    }

}
