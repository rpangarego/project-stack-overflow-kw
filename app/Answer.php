<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
<<<<<<< HEAD
    public function comments_answers() {
        return $this->hasMany('App\CommentAnswer', 'comment_id');
=======
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
>>>>>>> 324bfbfcd27d9dde661537b95e8af2fc747e33c6
    }
}
