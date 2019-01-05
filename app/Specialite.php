<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    //
    protected $fillable = [
        'name', 'description'
    ];


    public function medecins(){
        return $this->belongsToMany('App\Medecin','medecin_specialites','id_specialite','id_medecin');
    }

    public function uspecialites(){
        return $this->hasMany('App\Medecin_specialite','id_medecin');
    }

}
