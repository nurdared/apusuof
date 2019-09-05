<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function updates(){
        return $this->hasMany('App\Update');
    }

}
