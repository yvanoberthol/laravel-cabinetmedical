@extends('template')

@section('content')
    <div class="row bg-dark">
        <h1 class="col-md-12 text-white text-center">Liste des roles(<b class="text-success">{{$roles->count()}}</b>)</h1>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Id</td>
                <td>Nom</td>
                <td colspan="2">Actions</td>
            </tr>
            @if ($roles->count() > 0)
            @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>
                    {{$role->name}}
                </td>
                <td>
                    <a class="badge badge-info" href="/roles/{{$role->id}}/edit">
                        <span class="fa fa-pencil"></span> Modifier
                    </a>
                </td>
                <td>
                    <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#s{{$role->id}}">
                        <i class="fa fa-close"></i> Delete
                    </button>
                    <div class="modal fade" id="s{{$role->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: royalblue">
                                    <h4 class="modal-title">Supprimer un role</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez vous vraiment supprimer le role <strong> <span class="text-info">{{$role->name}}</span></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{route('roles.destroy',[$role->id])}}" method="post">
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
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-info">
                        <h3>Aucun role ....</h3>
                    </td>
                </tr>
            @endif
        </table>
    </div>
@stop