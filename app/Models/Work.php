<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description'
    ];

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    public function getFeedbackCountAttribute()
    {
        return count($this->feedbacks);
    }
}