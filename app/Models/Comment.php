<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'application_id'
    ];

    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}