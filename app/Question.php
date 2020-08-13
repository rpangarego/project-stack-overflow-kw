<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function author() {
        return $this->belongsTo('App\User', 'id');
    }
}
