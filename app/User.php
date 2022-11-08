<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;
    //development = admin
    //planing
    //district
    const ACTIVE_TYPE = 'active';
    const ADMIN_TYPE = 'admin';
    const PLANING_TYPE = 'planing';



    //------------------------getting user active status----------------------------------
    public function isActive(){
        return $this->status === self::ACTIVE_TYPE;
    }

    //------------------------middleware admin type----------------------------------
    public function isAdmin(){
        return $this->role === self::ADMIN_TYPE;
    }

    //------------------------middleware planing type----------------------------------
    public function isPlaning(){
        return $this->role === self::PLANING_TYPE;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','designation'
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

    //------------------------ has many locations--------------------------
    public function locations(){
        return $this->hasMany('App\UserLocations');
    }

}
