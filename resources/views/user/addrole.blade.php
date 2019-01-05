@extends('template')
@section('content')
    <div class="col-md-9 offset-md-1">
        <div class="card">
            <div class="card-header text-white bg-dark">
                <strong>Ajout un rôle à un utilisateur</strong>
            </div>
            <div class="card-body" style="background-color: #b0d4f1">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form id="form" method="post" action="{{route('users.addRole')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="post">
                            <div class="form-group">
                                <label for="id_user">Utilisateurs:</label>
                                <select id="id_user" name="id_user" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_role">Roles:</label>
                                <select id="id_role" name="id_role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection