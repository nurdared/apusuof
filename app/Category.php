<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'tb_category';
    // protected $primaryKey = 'category_id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function clubs(){
        return $this->hasMany('App\Club');
    }
}
