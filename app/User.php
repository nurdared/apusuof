<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'avatar', 'age', 'email', 'password', 'contact', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function clubs(){
        return $this->hasMany('App\Club');
    }

    public function updates(){
        return $this->hasMany('App\Update');
    }

    public function threads(){
        return $this->hasMany('App\Thread');
    }
    
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function volunteers(){
        return $this->hasMany('App\Volunteer', 'user_id');
    }
}
