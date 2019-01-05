@extends('template')
@section('content')
    <div class="col-md-9 offset-md-1">
        <div class="card">
            <div class="card-header text-white bg-dark">
                <strong>Editer Domaine N° <span class="text-success">{{$specialite->id}}</span></strong>
            </div>
            <div class="card-body" style="background-color: #b0d4f1">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form id="form" method="post" action="{{route('specialites.update',[$specialite->id])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="name">Nom:</label>
                                <input type="text" class="form-control" spellcheck="false" id="name" name="name" value="{{$specialite->name}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control text-justify" rows="5" id="description" name="description">
                                    {{$specialite->description}}
                                </textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-info" type="submit"><i class="fa fa-edit"></i> Mettre à jour</button>
                                <a href="{{route("specialites.index")}}">Retour à la liste des domaines</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection