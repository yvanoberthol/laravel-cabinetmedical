<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all()->sortByDesc('created_at');
        return view('role.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //
        $role_exists = role::where('name',$request->input('name'))->exists();
        if (!$role_exists){
            $roleAdd = role::create(
                [
                    'name'=>$request->input('name')
                ]
            );

            if ($roleAdd){
                return redirect()->route('roles.index')->with('addSuccess','role ajouté avec succès');
            }
        }else{
            //redirect
            $errors[0] = 'Le nom de ce role existe déjà';
            return redirect()->route('roles.create')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de la création du role';
        return redirect()->route('roles.create')->with('errors',$errors);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
    {
        //
        $cat = Role::where('id',$role)->first();
        return view('role.edit',['role'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $role)
    {
        //update category data
        $roleUpdate = Role::find($role);
        $roleUpdate = $roleUpdate->update(
            [
                'name'=>$request->input('name')
            ]
        );

        if ($roleUpdate){
            return redirect()->route('roles.index')->with('updateSuccess','Role mis à jour avec succès');
        }

        //redirect
        $errors[0] = 'Erreur de mise à jour du role '.$roleUpdate->name;
        return back()->withInput()->with('errors',$errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($role)
    {
        //delete role data
        $cat = Role::find($role);
        echo $cat;
        if ($cat){
            if ($cat->delete()) {
                return redirect()->route('roles.index')->with('deleteSuccess', 'Role supprimé avec succès');
            }
        }

        //redirect
        $errors[0] = 'Le role '.$cat->name.' ne peut pas être supprimé';
        return back()->withInput()->with('errors',$errors);
    }
}
