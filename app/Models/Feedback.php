<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'work_id',
        'positive_feedback',
        'negative_feedback',
        'misc_feedback',
    ];

    // Magic method defining work relationship
    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }

    // Magic method defining user who owns feedback
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}