<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'privacy'
    ];

    public function setPrivacyAttribute($value)
    {
        $this->attributes['privacy'] = strtolower($value);
    }

    public function getPrivacyAttribute($value)
    {
        return ucwords($value);
    }

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likesUsers()
    {
        $likesUsers = '';
        $likesUsersArray = [];

        foreach ($this->likes as $like) {
            $user = User::find($like->user_id);
            $likesUsersArray[] = $user->name;
        }
        
        if (!empty($likesUsersArray)) {
            $likesUsers = implode(', ', $likesUsersArray);
        }
        return $likesUsers;
    }
}
