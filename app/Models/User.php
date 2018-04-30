<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Gstt\Achievements\Achiever;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait, Filterable, Authorizable, Achiever {
        Authorizable::can as may;
        EntrustUserTrait::can insteadof Authorizable;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name',
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
     * Any pseudo-attributes to create.
     *
     * @var array
     */
    protected $appends = array('full_name');

    protected $dates = [
        'created_at', 'updated_at', 'last_login'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    // magic method for all comments the user has made
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // magic method for all modules the user is a part of
    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }

    // magic method for all works the user has created
    public function works()
    {
        return $this->hasMany('App\Models\Work');
    }

    /**
     * Gets all modules the user is a member of as a readable array
     *
     * @return array array of id to module name and code
     */
    public function getModuleArray()
    {
        return $this->getRelationValue('modules')->mapWithKeys(function($item)
        {
            return [$item->id => $item->name . ': ' . $item->code];
        });
    }
}
