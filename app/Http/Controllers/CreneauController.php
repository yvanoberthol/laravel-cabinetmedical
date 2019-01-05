<?php

namespace App\Http\Controllers;

use App\Creneau;
use App\Http\Requests\CreneauRequest;
use App\Medecin;
use Illuminate\Http\Request;

class CreneauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $creneaus = Creneau::paginate(10);
        $medecins = Medecin::all();
        return view('creneau.index')->with('creneaus',$creneaus)->with('medecins',$medecins)->with('id_search',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $medecins = Medecin::all();
        return view('creneau.create')->with('medecins',$medecins);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param CreneauRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreneauRequest $request)
    {
        //
        $creneau_exists = Creneau::where('hdebut',$request->input('hdebut'))
            ->orWhere('hfin',$request->input('hfin'))->where('id_medecin',$request->input('medecin_id'))->exists();


        if (!$creneau_exists){
            $hdebut = $request->input('hdebut');
            $hfin = $request->input('hfin');
            $id_medecin = $request->input('medecin_id');
            if ($hdebut <= $hfin){
                $creneaux_hfin = Creneau::all()->where('id_medecin',$id_medecin);
                foreach ($creneaux_hfin as $creneau_fin){
                    if ($creneau_fin->hfin > $hdebut){
                        $have_hfin = true;
                    }
                }
                if (!$have_hfin){
                    $creneauAdd = creneau::create(
                        [
                            'hdebut'=>$request->input('hdebut'),
                            'hfin'=>$request->input('hfin'),
                            'id_medecin'=>$request->input('medecin_id')
                        ]
                    );
                    if ($creneauAdd){
                        return redirect()->route('creneaus.index')->with('addSuccess','créneau ajouté avec succès');
                    }
                }else{
                    //redirect
                    $errors[0] = 'un créneau accède déja à cette intervalle de temps';
                    return redirect()->route('creneaus.create')->with('errors',$errors);
                }


            }else{
                //redirect
                $errors[0] = 'l\'heure de début doit être inférieur à l\'heure de fin';
                return redirect()->route('creneaus.create')->with('errors',$errors);
            }

        }else{
            //redirect
            $errors[0] = 'ce créneau existe déjà';
            return redirect()->route('creneaus.create')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de la création du créneau';
        return redirect()->route('creneaus.create')->with('errors',$errors);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Creneau  $categorise
     * @return \Illuminate\Http\Response
     */
    public function show($creneau)
    {
        //
        $cat = Creneau::where('id',$creneau)->first();
        return view('creneau.show',['creneau'=>$cat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Creneau  $creneau
     * @return \Illuminate\Http\Response
     */
    public function edit($creneau)
    {
        //
        $medecins = Medecin::all();
        $cat = Creneau::where('id',$creneau)->first();
        return view('creneau.edit',['creneau'=>$cat])->with('medecins',$medecins);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Creneau  $creneau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $creneau)
    {
        //update creneau data
        $hdebut = $request->input('hdebut');
        $hfin = $request->input('hfin');
        $id_medecin = $request->input('medecin_id');
        if ($hdebut <= $hfin){
            $creneauUpdate = Creneau::find($creneau);
            $creneau_firsts = Creneau::where('hdebut','<',$request->input('hdebut'))
                ->where('hfin','>=',$request->input('hdebut'))->where('id_medecin',$request->input('medecin_id'));
                $creneau_first_exists = false;
                if ($creneau_firsts->exists()){
                    foreach ($creneau_firsts as $creneau_first) {
                        if ($creneau_first->id == $creneauUpdate->id) {
                            $creneau_first_exists = true;
                        }
                    }
                }
                if (!$creneau_first_exists) {
                    $creneaux_hfin = Creneau::all()->where('id_medecin', $id_medecin);
                    $have_hfin = false;
                    foreach ($creneaux_hfin as $creneau_fin) {
                        if ($creneau_fin->hfin > $hdebut && $creneau_fin->hdebut < $hdebut && $creneau_fin->id != $creneauUpdate->id) {
                            $have_hfin = true;
                        }
                    }
                    if (!$have_hfin) {
                        $creneauUpdate = $creneauUpdate->update(
                            [
                                'hdebut' => $request->input('hdebut'),
                                'hfin' => $request->input('hfin'),
                                'id_medecin' => $request->input('medecin_id'),
                            ]
                        );

                        if ($creneauUpdate){
                            return redirect()->route('creneaus.index')->with('updateSuccess','Creneau mis à jour avec succès');
                        }

                    } else {
                        //redirect
                        $errors[0] = 'un créneau accède déja à cette intervalle de temps';
                        return redirect()->route('creneaus.edit',['creneau'=>$creneau])->with('errors', $errors);
                    }

                } else {
                    //redirect
                    $errors[0] = 'un créneau accède déja à cette intervalle de temps';
                    return redirect()->route('creneaus.edit',['creneau'=>$creneau])->with('errors', $errors);
                }

                //test sur l'existance d'un créneau de cette intervalle
                $creneaux_hfin = Creneau::all()->where('id_medecin', $id_medecin);
                foreach ($creneaux_hfin as $creneau_fin) {
                    if ($creneau_fin->hfin > $hdebut && $creneau_fin->id != $id_medecin) {
                        $have_hfin = true;
                    }
                }
                if (!$have_hfin) {
                    $creneauUpdate = $creneauUpdate->update(
                        [
                            'hdebut' => $request->input('hdebut'),
                            'hfin' => $request->input('hfin'),
                            'id_medecin' => $request->input('medecin_id'),
                        ]
                    );

                    if ($creneauUpdate){
                        return redirect()->route('creneaus.index',['creneau'=>$creneau])->with('updateSuccess','Creneau mis à jour avec succès');
                    }

                } else {
                    //redirect
                    $errors[0] = 'un créneau accède déja à cette intervalle de temps';
                    return redirect()->route('creneaus.edit')->with('errors', $errors);
                }

        }else{
            //redirect
            $errors[0] = 'l\'heure de début doit être inférieur à l\'heure de fin';
            return redirect()->route('creneaus.edit')->with('errors',$errors);
        }

        //redirect
        $errors[0] = 'Erreur de mise à jour du créneau de '.$creneauUpdate->medecin->firstname;
        return back()->withInput()->with('errors',$errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Creneau $creneau
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($creneau)
    {
        //delete creneau data
        $cat = Creneau::find($creneau);
        echo $cat;
        if ($cat){
            if ($cat->delete()) {
                return redirect()->route('creneaus.index')->with('deleteSuccess', 'Creneau supprimé avec succès');
            }
        }

        //redirect
        $errors[0] = 'Le creneau '.$cat->id.' ne peut pas être supprimé';
        return back()->withInput()->with('errors',$errors);
    }

    public function search(Request $request){
        //
        $medecins = Medecin::all();
        $medecin = Medecin::find($request->input('medecin_id'));
        $creneaus = $medecin->creneaus()->paginate(5);
        return view('creneau.index',['medecins'=>$medecins,
            'creneaus'=>$creneaus,'id_search'=>$request->input('medecin_id')]);
    }
}
