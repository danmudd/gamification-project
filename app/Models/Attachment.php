<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'work_id', 'name'
    ];

    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }
}