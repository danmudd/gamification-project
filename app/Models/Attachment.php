<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'name'
    ];

    // magic method defining work relationship
    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }
}