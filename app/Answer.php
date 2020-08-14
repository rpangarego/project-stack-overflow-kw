<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function comments_answers() {
        return $this->hasMany('App\CommentAnswer', 'comment_id');
    }
    
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
