<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title' , 'content' , 'tags'];
    public function author() {
        return $this->belongsTo('App\User', 'id');
    }
}
