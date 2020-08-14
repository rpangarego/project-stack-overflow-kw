<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpvoteDownvoteQuestion extends Model
{
    protected $fillable = ['point' , 'user_id' , 'question_id'];
    protected $table = 'upvotes_downvotes_questions';
}
