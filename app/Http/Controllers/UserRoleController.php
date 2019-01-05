<?php

namespace App\Http\Controllers;

use App\User_role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $urole_exists = User_role::where(['id_user'=>$request->input('id_user'),
            'id_role'=>$request->input('id_role')])->exists();
        if (!$urole_exists){
            $uroleAdd = User_role::create(
                [
                    'id_user'=>$request->input('id_user'),
                    'id_role'=>$request->input('id_role')
                ]
            );


            if ($uroleAdd) {
                return redirect()->route('users.index')->with('addSuccess', 'role ajouté à l\'utilisateur avec succès');
            }
        }else{
            //redirect
            $errors[0] = 'cet utilisateur a déja ce rôle';
            return redirect()->route('users.index')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de l\'ajout du role à l\'utilisateur';
        return redirect()->route('users.index')->with('errors',$errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function show(User_role $user_role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function edit(User_role $user_role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_role $user_role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_role $user_role)
    {

    }
}
