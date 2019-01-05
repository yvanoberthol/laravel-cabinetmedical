@extends('template')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6 offset-md-3">
            <form  action="{{route('creneaus.searchBy')}}" method="get">
                <div class="form-inline text-center">
                    <select id="medecin_id" name="medecin_id" class="form-control-lg mr-3">
                        @foreach($medecins as $medecin)
                            <option value="{{$medecin->id}}"
                            @if ($medecin->id == $id_search)
                                selected
                            @endif
                            >
                                {{$medecin->firstname.' '.$medecin->lastname}}
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
        <h1 class="col-md-12 text-white text-center">Liste des créneaux horaires(<b class="text-success">{{$creneaus->total()}}</b>)</h1>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="margin:auto">
                <tr>
                    <td>Heure de début</td>
                    <td>Heure de fin</td>
                    <td>Médécin</td>
                    <td colspan="2">Actions</td>
                </tr>
                @if ($creneaus->count() > 0)
                    @foreach($creneaus as $creneau)
                        <tr>
                            <td>
                                {{$creneau->hdebut}}
                            </td>
                            <td>
                                {{$creneau->hfin}}
                            </td>
                            <td class="text-success text-uppercase font-weight-bold">
                                {{$creneau->medecin->firstname.' '.$creneau->medecin->lastname}}
                            </td>
                            <td>
                                <a class="badge badge-info" href="/creneaus/{{$creneau->id}}/edit">
                                    <span class="fa fa-pencil"></span> Modifier
                                </a>
                            </td>
                            <td>
                                <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#s{{$creneau->id}}">
                                    <i class="fa fa-close"></i> Delete
                                </button>
                                <div class="modal fade" id="s{{$creneau->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: royalblue">
                                                <h4 class="modal-title">Supprimer un créneau</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Voulez vous vraiment supprimer le creneau [{{$creneau->hdebut.' -- '.$creneau->hfin}}] du médécin <strong> <span class="text-info">{{$creneau->medecin->firstname.' '.$creneau->medecin->lastname}}</span></strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('creneaus.destroy',[$creneau->id])}}" method="post">
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
                            <h3>Aucun créneau ....</h3>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-2">
            <a class="btn btn-secondary" href="{{route('creneaus.index')}}">Tous les créneaux</a>
        </div>
        <div class="col-md-6 text-center offset-md-4">
            {!!$creneaus->links('vendor.pagination.bootstrap-4',['elements'=>$creneaus])!!}
        </div>
    </div>
    <ul class="pagination justify-content-end">
        <li class="page-item">
            <a class="btn" style="background-color: purple; color:white" href="creneaus/create">
                <span class="fa fa-plus"></span> Ajouter un nouveau créneau horaire
            </a>
        </li>
    </ul>
@stop