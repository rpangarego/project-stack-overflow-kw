<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function comments_answers() {
        return $this->hasMany('App\CommentAnswer', 'comment_id');
    }
}
