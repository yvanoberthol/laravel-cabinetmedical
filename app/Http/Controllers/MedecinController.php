<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Medecin;
use App\Medecin_specialite;
use App\Specialite;
use App\Http\Requests\MedecinRequest;
use App\Http\Requests\MedecinUpdateRequest;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specialites = Specialite::all();
        $medecins = Medecin::paginate(5);
        return view('medecin.index',['medecins'=>$medecins,'specialites'=>$specialites,'id_search'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specialites = Specialite::all();
        return view('medecin.create',['specialites'=>$specialites]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedecinRequest $request)
    {
        //
        $medecin_exists = medecin::where('firstname',$request->input('firstname'))->exists();
        if (!$medecin_exists) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $path = public_path('imgs/');
                $file->move($path,$file->getClientOriginalName());
            }
            $medecinAdd = medecin::create(
                [
                    'matricule'=>$request->input('matricule'),
                    'firstname'=>$request->input('firstname'),
                    'lastname'=>$request->input('lastname'),
                    'date_naissance'=>$request->input('date'),
                    'ville_residence'=>$request->input('residence'),
                    'telephone'=>$request->input('telephone'),
                    'sexe'=>$request->input('sexe'),
                    'imagePath' =>$request->file('photo')->getClientOriginalName(),
                ]
            );

            $domaines = $request->specialites;
            if ($medecinAdd){
                for ($i=0;$i<count($domaines);$i++){
                    $medecin_specialite_add = Medecin_specialite::create(
                        [
                            'id_medecin'=>$medecinAdd->id,
                            'id_specialite'=>(int)$domaines[$i]
                        ]
                    );
                }
                if ($medecin_specialite_add){
                    return redirect()->route('medecins.index')->with('addSuccess','Médécin ajouté avec succès');
                }
            }
        }else{
            //redirect
            $errors[0] = 'Le nom de cet medecin existe déjà';
            return redirect()->route('medecins.create')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de la création de l\'medecin';
        return redirect()->route('medecins.create')->with('errors',$errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medecin  $medecin
     * @return \Illuminate\Http\Response
     */
    public function show($medecin)
    {
        //
        //
        $art = Medecin::where('id',$medecin)->first();
        $specialites = Specialite::all();
        return view('medecin.show',['medecin'=>$art,'specialites'=>$specialites]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medecin  $medecin
     * @return \Illuminate\Http\Response
     */
    public function edit($medecin)
    {
        //
        $specialites = Specialite::all();
        $art = Medecin::where('id',$medecin)->first();
        return view('medecin.edit',['medecin'=>$art,'specialites'=>$specialites]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medecin  $medecin
     * @return \Illuminate\Http\Response
     */
    public function update(MedecinUpdateRequest $request, $medecin)
    {
        //
        //update category data
        $medecinSearch = Medecin::find($medecin);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = public_path('imgs/');
            unlink($path.$medecinSearch->imagePath);
            $file->move($path,$file->getClientOriginalName());
            $medecinUpdate = $medecinSearch->update(
                [
                    'matricule'=>$request->input('matricule'),
                    'firstname'=>$request->input('firstname'),
                    'lastname'=>$request->input('lastname'),
                    'date_naissance'=>$request->input('date'),
                    'ville_residence'=>$request->input('residence'),
                    'telephone'=>$request->input('telephone'),
                    'sexe'=>$request->input('sexe'),
                    'imagePath' =>$request->file('photo')->getClientOriginalName(),
                    'id_specialite'=>$request->input('specialite_id')
                ]
            );

        }else{
            $medecinUpdate = $medecinSearch->update(
                [
                    'matricule'=>$request->input('matricule'),
                    'firstname'=>$request->input('firstname'),
                    'lastname'=>$request->input('lastname'),
                    'date_naissance'=>$request->input('date'),
                    'ville_residence'=>$request->input('residence'),
                    'telephone'=>$request->input('telephone'),
                    'sexe'=>$request->input('sexe'),
                    'id_specialite'=>$request->input('specialite_id')
                ]
            );
        }

        if ($medecinUpdate){
            return redirect()->route('medecins.show',['medecin'=>$medecin])->with('updateSuccess','Medecin mis à jour avec succès');
        }

        //redirect
        $errors[0] = 'Erreur de mis à jour du médécin '.$medecinUpdate->firstname.' '.$medecinUpdate->lastname;
        return back()->withInput()->with('errors',$errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medecin  $medecin
     * @return \Illuminate\Http\Response
     */
    public function destroy($medecin)
    {
        //delete medecin data
        $medecinDelete = Medecin::find($medecin);
        if ($medecinDelete){
            if ($medecinDelete->delete()) {
                $path = public_path('imgs/');
                unlink($path.$medecinDelete->imagePath);
                return redirect()->route('medecins.index')->with('deleteSuccess', 'Medecin supprimé avec succès');
            }
        }

        //redirect
        $errors[0] = 'L\'medecin '.$medecinDelete->firstname.' '.$medecinDelete->lastname.' ne peut pas être supprimé';
        return back()->withInput()->with('errors',$errors);
    }

    public function search(\Illuminate\Http\Request $request){
        //
        $specialites = Specialite::all();
        $specialite = Specialite::find($request->input('specialite_id'));
        $medecins = $specialite->medecins()->paginate(5);
        return view('medecin.index',['medecins'=>$medecins,
            'specialites'=>$specialites,'id_search'=>$request->input('specialite_id')]);
    }

    public function chargement(){
        return view('chargement');
    }

    public function suppSpecialite($medecin,$specialite){
        $uspecialite_exists = Medecin_specialite::where(['id_medecin'=>$medecin,
            'id_specialite'=>$specialite]);
        if ($uspecialite_exists){
            if ($uspecialite_exists->delete()) {
                return redirect()->route('medecins.show',['medecin'=>$medecin])->with('addSuccess', 'compétence retirée au médécin avec succès');
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer';
            return redirect()->route('medecins.show',['medecin'=>$medecin])->with('errors',$errors);
        }

        //redirect
        $errors[0] = 'Erreur lors du retrait de la compétence au médécin';
        return redirect()->route('medecins.show',['medecin'=>$medecin])->with('errors',$errors);
    }

    public function addSpecialite(Request $request){
            $uspecialite_exists = Medecin_specialite::where(['id_medecin'=>$request->input('id_medecin'),
                'id_specialite'=>$request->input('id_specialite')])->exists();
            if (!$uspecialite_exists){
                $uspecialiteAdd = Medecin_specialite::create(
                    [
                        'id_medecin'=>$request->input('id_medecin'),
                        'id_specialite'=>$request->input('id_specialite')
                    ]
                );


                if ($uspecialiteAdd) {
                    return redirect()->route('medecins.show',['medecin'=>$request->input('id_medecin')])->with('addSuccess', 'nouvelle compétence attribuée au médécin avec succès');
                }
            }else{
                //redirect
                $errors[0] = 'ce médécin a déja cette compétence';
                return redirect()->route('medecins.show',['medecin'=>$request->input('id_medecin')])->with('errors',$errors);
            }
        //redirect
        $errors[0] = 'Erreur lors de l\'ajout d\'une compétence au médécin';
        return redirect()->route('medecins.show',['medecin'=>$request->input('id_medecin')])->with('errors',$errors);
    }

    public function changerPhoto(PhotoRequest $request){
        $medecinSearch = Medecin::find($request->input('id'));
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = public_path('imgs/');
            unlink($path.$medecinSearch->imagePath);
            $file->move($path,$file->getClientOriginalName());
            $medecinUpdate = $medecinSearch->update(
                [
                    'imagePath' =>$request->file('file')->getClientOriginalName(),
                ]
            );
            if ($medecinUpdate){
                return redirect()->route('medecins.show',['medecin'=>$request->input('id')])->with('updateSuccess','Photo mise à jour avec succès');
            }

            //redirect
            $errors[0] = 'Erreur de mis à jour de la photo du médécin '.$medecinUpdate->firstname.' '.$medecinUpdate->lastname;
            return back()->withInput()->with('errors',$errors);
        }
    }

}
