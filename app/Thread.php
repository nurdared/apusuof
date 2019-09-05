<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable=['subject', 'thread', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($filterQuery,ThreadFilters $threadFilters)
    {
        $threadFilters->apply($filterQuery);
    }
}
