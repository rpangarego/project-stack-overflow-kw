<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title' , 'content' , 'tags'];
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments() {
        return $this->hasMany('App\CommentQuestion');
    }

    public function point() {
        return $this->hasOne('App\UpvoteDownvoteQuestion', 'point');
    }
}
