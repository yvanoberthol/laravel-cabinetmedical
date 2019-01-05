<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use App\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all()->sortByDesc('created_at');
        $roles = Role::all();
        $role = '';


        return view('user.index')->with('users',$users)->with('role',$role)->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('user.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $user_exists = User::where('username',$request->input('name'))->exists();
        if (!$user_exists){
            $userAdd = User::create(
                [
                    'username'=>$request->input('name'),
                    'password'=>bcrypt($request->input('password'))
                ]
            );

            if ($userAdd){
                $userRoleAdd = User_role::create(
                    [
                        'id_user'=>$userAdd->id,
                        'id_role'=>$request->input('id_role')
                    ]
                );

                if ($userRoleAdd) {
                    return redirect()->route('users.index')->with('addSuccess', 'Utilisateur ajouté avec succès');
                }
            }
        }else{
            //redirect
            $errors[0] = 'Le nom de cet utilisateur existe déjà';
            return redirect()->route('users.create')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors de la création de l\'utilisateur';
        return redirect()->route('users.create')->with('errors',$errors);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //
        $user = User::where('id',$user)->first();
        return view('user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $user)
    {
        //update user data
        $userUpdate = User::find($user);
        $userUpdate = $userUpdate->update(
            [
                'name'=>$request->input('name'),
                'password'=>bcrypt($request->input('password'))
            ]
        );

        if ($userUpdate){
            return redirect()->route('users.index')->with('updateSuccess','Compte mis à jour avec succès');
        }

        //redirect
        $errors[0] = 'Erreur de mise à jour du compte '.$userUpdate->name;
        return back()->withInput()->with('errors',$errors);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($user)
    {
        //delete user data
        $userSearch = User::find($user);
        if (count($userSearch->roles) < 2 && $userSearch->roles[0]['id']== 1 || $userSearch->id == Auth::id()){
            $uroles = User_role::where('id_user',$user);
            if ($uroles){
                if ($uroles->delete()) {
                    $user = User::find($user);
                    if ($user){
                        if ($user->delete()) {
                            return redirect()->route('users.index')->with('deleteSuccess', 'compte utilisateur supprimé avec succès');
                        }
                    }
                }
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer sur un super administrateur';
            return redirect()->route('users.index')->with('errors',$errors);
        }
        //redirect
        $errors[0] = 'L\'utilisateur '.$user->name.' ne peut pas être supprimé';
        return back()->withInput()->with('errors',$errors);
    }

    public function show($user){

    }

    public function formaddrole(){

        $users = User::all();
        $roles = Role::all();

        return view('user.addrole',compact('users','roles'));

    }
    public function suppRole($user,$role){
        $userSearch = User::find($user);
        if (count($userSearch->roles) < 2 && $userSearch->roles[0]['id']== 1 || $userSearch->id == Auth::id()){
            $urole_exists = User_role::where(['id_user'=>$user,
                'id_role'=>$role]);
            if ($urole_exists){
                if ($urole_exists->delete()) {
                    return redirect()->route('users.index')->with('addSuccess', 'rôle retiré à l\'utilisateur avec succès');
                }
            }else{
                //redirect
                $errors[0] = 'Action impossible à effectuer';
                return redirect()->route('users.index')->with('errors',$errors);
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer sur un super administrateur';
            return redirect()->route('users.index')->with('errors',$errors);
        }


        //redirect
        $errors[0] = 'Erreur lors du retrait du role à l\'utilisateur';
        return redirect()->route('users.index')->with('errors',$errors);
    }

    public function addRole(Request $request){
        $userSearch = User::find($request->input('id_user'));
        if (($userSearch->roles) < 2 && $userSearch->roles[0]['id']== 1 || $userSearch->id == Auth::id()){

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
                return redirect()->route('users.formaddrole')->with('errors',$errors);
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer sur un super administrateur';
            return redirect()->route('users.index')->with('errors',$errors);
        }
        //redirect
        $errors[0] = 'Erreur lors de l\'ajout du role à l\'utilisateur';
        return redirect()->route('users.formaddrole')->with('errors',$errors);
    }

    public function activeUser(Request $request){

        $userSearch = User::find($request->input('id'));
        if (count($userSearch->roles) < 2 && $userSearch->roles[0]['id']== 1 || $userSearch->id == Auth::id()){
            if ($userSearch){
                $userUpdate = $userSearch->update(
                  [
                      'enabled'=>1
                  ]
                );

                if ($userUpdate){
                    return redirect()->route('users.index')->with('addSuccess', 'le compte de '.$userSearch->username.' a été activé avec succès');
                }
            }else{
                //redirect
                $errors[0] = 'cet utilisateur n\'existe pas';
                return redirect()->route('users.index')->with('errors',$errors);
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer sur un super administrateur';
            return redirect()->route('users.index')->with('errors',$errors);
        }

        //redirect
        $errors[0] = 'Erreur lors de l\'activation du compte de l\'utilisateur';
        return redirect()->route('users.index')->with('errors',$errors);

    }

    public function desactiveUser(Request $request){
        $userSearch = User::find($request->input('id'));
        if (count($userSearch->roles) < 2 && $userSearch->roles[0]['id']== 1 || $userSearch->id == Auth::id()){
            if ($userSearch){
                $userUpdate = $userSearch->update(
                    [
                        'enabled'=>0
                    ]
                );

                if ($userUpdate){
                    return redirect()->route('users.index')->with('addSuccess', 'le compte de '.$userSearch->username.' a été désactivé avec succès');
                }
            }else{
                //redirect
                $errors[0] = 'cet utilisateur n\'existe pas';
                return redirect()->route('users.index')->with('errors',$errors);
            }
        }else{
            //redirect
            $errors[0] = 'Action impossible à effectuer sur un super administrateur';
            return redirect()->route('users.index')->with('errors',$errors);
        }
        //redirect
        $errors[0] = 'Erreur lors de la désactivation du compte de l\'utilisateur';
        return redirect()->route('users.index')->with('errors',$errors);
    }
}
