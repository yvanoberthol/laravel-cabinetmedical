@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="grand-titre">Editer infos médécin N° {{$medecin->id}}</h1>

            <form action="{{route('medecins.update',[$medecin->id])}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label class="control-label">Matricule:</label>
                    <input type="text" name="matricule" value="{{$medecin->matricule}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Nom:</label>
                    <input type="text" name="firstname" value="{{$medecin->firstname}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Prénom:</label>
                    <input type="text" name="lastname" value="{{$medecin->lastname}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Date de naissance:</label>
                    <input type="date" name="date" value="{{$medecin->date_naissance}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Ville de résidence:</label>
                    <input type="text" name="residence" value="{{$medecin->ville_residence}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">N° Téléphone:</label>
                    <input type="number" name="telephone" value="{{$medecin->telephone}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Sexe:</label>
                    <select name="sexe" class="form-control selectpicker">
                        <option value="homme" @if ($medecin->sexe == 'homme')
                        selected
                                @endif>Masculin</option>
                        <option value="femme" @if ($medecin->sexe == 'femme')
                        selected
                                @endif>Feminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" style="background-color: purple; color:white"><span class="fa fa-plus-circle"></span> Modifier</button>
                    <a href="{{route('medecins.index')}}">Retour à la liste des médécins</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection