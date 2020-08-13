<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title' , 'content' , 'tags' , 'user_id'];
    public function author() {
        return $this->belongsTo('App\User', 'id');
    }
}
