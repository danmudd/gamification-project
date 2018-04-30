<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    // magic method defining distant relation to works
    public function works()
    {
        return $this->hasManyThrough('App\Models\Work', 'App\Models\User');
    }
}