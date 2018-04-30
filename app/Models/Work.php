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

    // magic method for all the attachments the work has
    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

    // magic method for the user who created the work
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // magic method for the module the work is a part of
    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }

    // magic method for the feedbacks the work has
    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    // magic method defining a custom attribute
    public function getFeedbackCountAttribute()
    {
        return count($this->feedbacks);
    }
}