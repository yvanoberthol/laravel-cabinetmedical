<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medecin_specialite extends Model
{
    //
    protected $fillable = [
        'id_medecin',
        'id_specialite',
    ];

    //every user has any userProjects
    public function medecin(){
        return $this->belongsTo('App\Medecin','id');
    }


    //every user has any userProjects
    public function specialite(){
        return $this->belongsTo('App\Specialite','id');
    }
}
