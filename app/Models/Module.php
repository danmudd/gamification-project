<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    // magic method defining works within that module
    public function works()
    {
        return $this->hasMany('App\Models\Work');
    }

    // magic method defining users that are in that module
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}