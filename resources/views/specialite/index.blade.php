@extends('template')

@section('content')
    <div class="row bg-dark">
        <h1 class="col-md-12 text-white text-center">Liste des spécialités(<b class="text-success">{{$specialites->total()}}</b>)</h1>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Id</td>
                <td>Nom</td>
                <td colspan="2">Actions</td>
            </tr>
            @if ($specialites->count() > 0)
            @foreach($specialites as $specialite)
            <tr>
                <td>{{$specialite->id}}</td>
                <td>
                    <a href="/specialites/{{$specialite->id}}">
                        {{$specialite->name}}
                    </a>

                </td>
                <td>
                    <a class="badge badge-info" href="/specialites/{{$specialite->id}}/edit">
                        <span class="fa fa-pencil"></span> Modifier
                    </a>
                </td>
                <td>
                    <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#s{{$specialite->id}}">
                        <i class="fa fa-close"></i> Delete
                    </button>
                    <div class="modal fade" id="s{{$specialite->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: royalblue">
                                    <h4 class="modal-title">Supprimer une spécialité</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez vous vraiment supprimer la spécialité <strong> <span class="text-info">{{$specialite->name}}</span></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="{{route('specialites.destroy',[$specialite->id])}}" method="post">
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
                        <h3>Aucun domaine médical....</h3>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 text-center offset-md-4">
            {!!$specialites->links('vendor.pagination.bootstrap-4',['elements'=>$specialites])!!}
        </div>
    </div>
    <ul class="pagination justify-content-end">
        <li class="page-item">
            <a class="btn" style="background-color: purple; color:white" href="specialites/create">
                <span class="fa fa-plus"></span> Ajouter un nouveau domaine médical
            </a>
        </li>
    </ul>
@stop