<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $fillable = [
        'name'
    ];


    //every article has any categories
    public function users(){
        return $this->belongsToMany('App\User');
    }

}
