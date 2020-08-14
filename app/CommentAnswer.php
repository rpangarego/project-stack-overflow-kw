<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $table = 'comments_answers';

    public function answer() {
        return $this->belongsTo('App\Answer', 'answer_id');
    }
}
