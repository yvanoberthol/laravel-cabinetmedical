@extends('template')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6 offset-md-3">
            <form  action="{{route('medecins.searchBy')}}" method="get">
                <div class="form-inline text-center">
                    <select id="specialite_id" name="specialite_id" class="form-control-lg mr-3">
                        @foreach($specialites as $specialite)
                            <option value="{{$specialite->id}}"
                            @if ($specialite->id == $id_search)
                                selected
                            @endif
                            >
                                {{$specialite->name}}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-success form-control">
                        <span class="fa fa-search"></span> Rechercher
                    </button>
                </div>
            </form>
        </div>

    </div>
    <div class="row bg-dark">
        <h1 class="col-md-12 text-white text-center">Liste des médécins(<b class="text-success">{{$medecins->total()}}</b>)</h1>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="margin:auto">
                <tr>
                    <td>Nom complet</td>
                    <td>Date de naissance</td>
                    <td>Ville de résidence</td>
                    <td colspan="2">Actions</td>
                </tr>
                @if ($medecins->count() > 0)
                    @foreach($medecins as $medecin)
                        <tr>
                            <td>
                                <a href="/medecins/{{$medecin->id}}">
                                    {{$medecin->firstname." ".$medecin->lastname}}
                                </a>
                            </td>
                            <td>
                                {{$medecin->date_naissance}}
                            </td>
                            <td>
                                {{$medecin->ville_residence}}
                            </td>
                            <td>
                                <a class="badge badge-info" href="/medecins/{{$medecin->id}}/edit">
                                    <span class="fa fa-pencil"></span> Modifier
                                </a>
                            </td>
                            <td>
                                <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#s{{$medecin->id}}">
                                    <i class="fa fa-close"></i> Delete
                                </button>
                                <div class="modal fade" id="s{{$medecin->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: royalblue">
                                                <h4 class="modal-title">Supprimer un médécin</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Voulez vous vraiment supprimer le médécin <strong> <span class="text-info">{{$medecin->firstname." ".$medecin->lastname}}</span></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('medecins.destroy',[$medecin->id])}}" method="post">
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
                            <h3>Aucun médécin ....</h3>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-2">
            <a class="btn btn-secondary" href="{{route('medecins.index')}}">Tous les médécins</a>
        </div>
        <div class="col-md-6 text-center offset-md-4">
            {!!$medecins->links('vendor.pagination.bootstrap-4',['elements'=>$medecins])!!}
        </div>
    </div>
    <ul class="pagination justify-content-end">
        <li class="page-item">
            <a class="btn" style="background-color: purple; color:white" href="medecins/create">
                <span class="fa fa-plus"></span> Ajouter un nouveau médécin
            </a>
        </li>
    </ul>
@stop