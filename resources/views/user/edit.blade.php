@extends('template')
@section('content')
    <div class="col-md-9 offset-md-1">
        <div class="card">
            <div class="card-header text-white bg-dark">
                <strong>Modifier mon compte</strong>
            </div>
            <div class="card-body" style="background-color: #b0d4f1">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form id="form" method="post" action="{{route('users.update',[$user->id])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="name">Nom:</label>
                                <input type="text" class="form-control" spellcheck="false" id="name" name="name" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe:</label>
                                <input type="password" class="form-control" spellcheck="false" id="password" name="password" value="">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-info" type="submit"><i class="fa fa-edit"></i> Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection