<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    //
    protected $fillable = [
        'matricule',
        'firstname',
        'lastname',
        'date_naissance',
        'ville_residence',
        'telephone',
        'sexe',
        'imagePath'
    ];

    public function getAgeAttribute($date_naissance)
    {
        $age = date('Y') - date('Y',strtotime($this->date_naissance));

        return $age;

    }

    public function specialites(){
        return $this->belongsToMany('App\Specialite','medecin_specialites','id_medecin','id_specialite');
    }

    public function uspecialites(){
        return $this->hasMany('App\Medecin_specialite','id_medecin');
    }

    public function creneaus(){
        return $this->hasMany('App\Creneau','id_medecin');
    }
}
