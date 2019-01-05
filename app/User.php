<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','enabled'
    ];


    //every article has any categories
    public function roles(){
        return $this->belongsToMany('App\Role','user_roles','id_user','id_role');
    }

    public function uroles(){
        return $this->hasMany('App\User_role','id_user');
    }

}
