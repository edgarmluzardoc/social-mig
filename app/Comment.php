<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date("F j, Y, g:i a", strtotime($value));
    }

    public function post()
    {
        $this->belongsTo('App\Post');
    }
}
