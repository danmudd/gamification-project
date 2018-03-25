<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}