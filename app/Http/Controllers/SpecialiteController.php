<?php

namespace App\Http\Controllers;

use App\Medecin;
use App\Specialite;
use App\Http\Requests\SpecialiteRequest;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specialites = Specialite::paginate(5);
        return view('specialite.index')->with('specialites',$specialites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('specialite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialiteRequest $request)
    {
        //
        $specialite_exists = specialite::where('name',$request->input('name'))->exists();
        if (!$specialite_exists){
            $specialiteAdd = specialite::create(
                [
                    'name'=>$request->input('name'),
                    'description'=>$request->input('description'),
                ]
            );

            if ($specialiteAdd){
                return redirect()->route('specialites.index')->with('addSuccess','spécialité ajoutée avec succès');
            }
        }else{
            //redirect
            $errors[0] = 'Le nom de cette spécialité existe déjà';
            return redirect()->route('specialites.create')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de la création de la spécialité';
        return redirect()->route('specialites.create')->with('errors',$errors);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialite  $categorise
     * @return \Illuminate\Http\Response
     */
    public function show($specialite)
    {
        //
        $cat = Specialite::where('id',$specialite)->first();
        $medecins = $cat->medecins()->paginate(5);
        return view('specialite.show',['specialite'=>$cat,'medecins'=>$medecins]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function edit($specialite)
    {
        //
        $cat = Specialite::where('id',$specialite)->first();
        return view('specialite.edit',['specialite'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $specialite)
    {
        //update category data
        $specialiteSearch = Specialite::find($specialite);
        $specialiteUpdate = $specialiteSearch->update(
            [
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
            ]
        );

        if ($specialiteUpdate){
            return redirect()->route('specialites.show',['specialite'=>$specialite])->with('updateSuccess','Specialite mise à jour avec succès');
        }

        //redirect
        $errors[0] = 'Erreur de mise à jour de la spécialité '.$specialiteUpdate->name;
        return back()->withInput()->with('errors',$errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialite $specialite
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($specialite)
    {
        //delete specialite data
        $cat = Specialite::find($specialite);
        echo $cat;
        if ($cat){
            if ($cat->delete()) {
                return redirect()->route('specialites.index')->with('deleteSuccess', 'Specialite supprimée avec succès');
            }
        }

        //redirect
        $errors[0] = 'La specialite '.$cat->name.' ne peut pas être supprimée';
        return back()->withInput()->with('errors',$errors);
    }

    public function statMedecinSpecialite(){
        $alldomaines = Specialite::all();
        $statMedecinSpecialite = array();
        foreach ($alldomaines as $domaine){
            $stat = ['label'=>$domaine->name,'y'=>$domaine->medecins()->count()];
            array_push($statMedecinSpecialite,$stat);
        }
        return view('medecin.statcabinet')->with('statMedecinSpecialite',$statMedecinSpecialite);
    }
}
