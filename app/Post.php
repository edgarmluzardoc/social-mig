<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date("F j, Y, g:i a", strtotime($value));
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
