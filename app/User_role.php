<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    //
    protected $fillable = [
        'id_user',
        'id_role',
    ];

    //every user has any userProjects
    public function user(){
        return $this->belongsTo('App\User','id_user');
    }


    //every user has any userProjects
    public function role(){
        return $this->belongsTo('App\Role','id_role');
    }
}
