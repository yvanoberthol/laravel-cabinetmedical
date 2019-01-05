<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    //
    protected $fillable = [
        'hdebut',
        'hfin',
        'id_medecin'
    ];

    //every user has any userProjects
    public function medecin(){
        return $this->belongsTo('App\Medecin','id_medecin');
    }
}
