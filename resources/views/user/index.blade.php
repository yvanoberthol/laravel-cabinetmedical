@extends('template')

@section('content')
    <div class="row bg-dark">
        <h1 class="col-md-12 text-white text-center">Liste des comptes utilisateurs(<b class="text-success">{{$users->count()}}</b>)</h1>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Id</td>
                <td>Nom</td>
                <td>Rôles</td>
                <td>Etat</td>
                <td colspan="2">Actions</td>
            </tr>
            @if ($users->count() > 0)
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>
                    {{$user->username}}
                </td>
                <td class="text-center">
                    [--
                    @foreach($user->roles as $urole)
                    <a class="badge badge-pill badge-secondary" href="deleteUserRole/{{$user->id}}/{{$urole->id}}">{{$urole->name}}</a>--
                    @if ($urole->name == 'superadmin')
                            <?php  $role = $urole->name ?>
                    @endif

                    @endforeach
                    ]
                    <span>
                        <a class="badge badge-info" href="" data-toggle="modal" data-target="#m{{$user->id}}">
                            Ajouter un rôle
                        </a>
                    </span>
                    <div class="modal fade" id="m{{$user->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header text-center">
                                    <h4 class="modal-title">Ajouter un rôle</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <form action="{{route('userRoles.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="post">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <div class="form-group text-center">
                                                    <label class="control-label">
                                                        <h1><span>Ajouter un nouveau rôle à </span>
                                                            <span class="text-info">{{$user->username}}</span>
                                                        </h1>
                                                    </label>
                                                    <input type="hidden" name="id_user" value="{{$user->id}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Role</label>
                                                    <select name="id_role" class="form-control text-center">
                                                        @foreach($roles as $urole)
                                                        <option value="{{$urole->id}}">{{$urole->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="submit" name="ajouter" class="btn btn-primary">
                                                        <span class="fa fa-plus"></span> Ajouter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </td>
                @if ($user->enabled == 0)
                    <td>
                        <form action="{{route('users.activeUser')}}" method="post">
                            <div class="form-group text-center">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="post">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-warning">
                                    Désactivé
                                </button>
                            </div>
                        </form>
                    </td>
                @else
                    <td>
                        <form action="{{route('users.desactiveUser')}}" method="post">
                            <div class="form-group text-center">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="post">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-success">
                                    Activé
                                </button>
                            </div>
                        </form>
                    </td>
                @endif
                @if ($role != 'superadmin')
                    <td>
                        <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#s{{$user->id}}">
                            <i class="fa fa-close"></i> Delete
                        </button>
                        <div class="modal fade" id="s{{$user->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: royalblue">
                                        <h4 class="modal-title">Supprimer un utilisateur</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Voulez vous vraiment supprimer l'utilisateur <strong> <span class="text-info">{{$user->username}}</span></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{route('users.destroy',[$user->id])}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
                @endif
                {{$role=""}}
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-info">
                        <h3>Aucun utilisateur ....</h3>
                    </td>
                </tr>
            @endif
        </table>
    </div>
@stop