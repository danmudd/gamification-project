<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait, Filterable;

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

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }
}
