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

    public function works()
    {
        return $this->hasMany('App\Models\Work');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User');
    }
}