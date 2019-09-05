<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function club(){
        return $this->belongsTo('App\Club');
    }
}
