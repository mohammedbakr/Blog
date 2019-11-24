<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image',
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

    public function articles(){

        return $this->hasMany('App\Models\Article');
    }

    public function comments(){

        return $this->hasMany('App\Models\Comment');
    }

    public function roles(){

        return $this->belongsToMany('App\Models\Role');
    }

    public function hasAnyRoles($roles){ // passing array

        return null !==$this->roles()->whereIn('name', $roles)->first();
    }

    public function hasAnyRole($role){ // passing string

        return null !==$this->roles()->where('name', $role)->first();
    }
}
