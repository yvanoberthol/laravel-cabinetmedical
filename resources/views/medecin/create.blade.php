@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="grand-titre">Enregistrer un nouveau médécin</h1>

            <form action="{{route('medecins.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="post">
                <div class="form-group">
                    <label class="control-label">Matricule:</label>
                    <input type="text" name="matricule" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Nom:</label>
                    <input type="text" name="firstname" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Prénom:</label>
                    <input type="text" name="lastname" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Date de naissance:</label>
                    <input type="date" name="date" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Ville de résidence:</label>
                    <input type="text" name="residence" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">N° Téléphone:</label>
                    <input type="number" name="telephone" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Sexe:</label>
                    <select name="sexe" class="form-control selectpicker">
                        <option value="homme">Masculin</option>
                        <option value="femme">Feminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Photo:</label>
                    <input type="file" name="photo"
                           value="" class="form-control" accept="image/x-png,image/png,image/jpeg">
                </div>
                <div class="form-group">
                    <label class="control-label">Domaines:</label>
                    <select name="specialites[]" class="form-control selectpicker"
                            multiple data-live-search="true" data-max-options="5">
                        @foreach($specialites as $specialite)
                            <option value="{{$specialite->id}}">{{$specialite->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" style="background-color: purple; color:white"><span class="fa fa-plus-circle"></span> Ajouter</button>
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