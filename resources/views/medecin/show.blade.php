@extends('template')
@section('content')
    <div class="row">
        <ol class="breadcrumb col-md-12">
            <li style="margin-right: 20px">
                <a href="{{route('medecins.index')}}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                    Retour à la liste des médécins
                </a>
            </li>
            <li>
                <a href="/medecins/{{$medecin->id}}/edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Editer
                </a>
            </li>

        </ol>
    </div>

    <div class="row">
        <div class="col-md-3">
            <img class="mb-2" src="{{asset('imgs/'.$medecin->imagePath)}}" alt="pas photo" style="width: 200px; height: 200px">
            <form action="{{route('medecins.changerPhoto')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="post" >
                <input type="hidden" name="id" value="{{$medecin->id}}" >
                <div class="upload-btn-wrapper text-center" style="width: 200px">
                    <input type="file" name="file" class="inputfile"/>
                    <button class="btns">
                       <span class="fa fa-camera"></span> Changer la photo
                    </button>
                    <span id="filename"></span>
                </div>
                <div class="text-center" id="validerImage" style="width: 200px; display: none">
                    <button type="submit" class="btn btn-success">
                        <span class="fa fa-check"></span> Valider
                    </button>
                </div>
            </form>

        </div>
        <div class="col-md-8">
            <div class="row bg-primary">
                <h2 class="text-center col-md-12">{{$medecin->firstname." ".$medecin->lastname}}</h2>

            </div>
            <div class="row">
                <div class="col-md-6" style="margin-top: 10px; border-right: 5px solid darkgreen">
                    <p style="font-weight: bolder;font-size: 24px">
                       <strong>Matricule: </strong> <span class="bg-warning">{{$medecin->matricule}}</span>
                    </p>
                    <p style="font-weight: bolder;font-size: 24px">
                        <strong>Ville : </strong>  <span class="bg-warning">{{$medecin->ville_residence}}</span>
                    </p>
                    <p style="font-weight: bolder;font-size: 24px">
                        <strong>Sexe : </strong>  <span class="bg-warning">{{$medecin->sexe}}</span>
                    </p>
                </div>
                <div class="col-md-6" style="margin-top: 10px">
                    <p style="font-weight: bolder;font-size: 24px">
                        <strong>Téléphone : </strong>  <span class="bg-warning">{{$medecin->telephone}}</span>
                    </p>
                    <p style="font-weight: bolder;font-size: 24px">
                        <strong>Age : </strong>  <span class="bg-warning">{{$medecin->age}}</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 10px">
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3" style="margin-top: 10px">
                    <h5 class="text-center">
                        <strong>Spécialisé(e) en</strong>
                    </h5>
                    <div class="text-center">
                        @foreach($medecin->specialites as $specialite)
                                <a href="/deleteMedecinSpecialite/{{$medecin->id}}/{{$specialite->id}}" class="badge mb-2 btn btn-lg badge-success competence"
                                        data-toggle="tooltip" data-placement="left" title="Pour l'enlever la compétence cliquez dessus">
                                    {{$specialite->name}}
                                </a> <br>
                        @endforeach
                        <a class="badge badge-info mt-4 btn btn-lg" href="" data-toggle="modal" data-target="#addSpecialite">
                            + lui ajouter une compétence
                        </a>
                    </div>
                    <div class="modal fade" id="addSpecialite">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header text-center">
                                    <h4 class="modal-title">Ajouter une compétence</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <form action="{{route('medecins.addSpecialite')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="post">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <div class="form-group text-center">
                                                    <label class="control-label">
                                                        <h1>
                                                            <span>Ajouter une nouvelle compétence à </span><span class="text-info">{{$medecin->firstname." ".$medecin->lastname}}</span>
                                                        </h1>
                                                    </label>
                                                    <input type="hidden" name="id_medecin" value="{{$medecin->id}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Domaine:</label>
                                                    <select name="id_specialite" class="form-control text-center">
                                                        @foreach($specialites as $specialite)
                                                            <option value="{{$specialite->id}}">{{$specialite->name}}</option>
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

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" style="margin-top: 10px">
                    <h4>
                        <span><u>NB</u>: </span><span>Pour enlèver une compétence particulière à un médécin faudra juste cliquer sur celle dont il est <span class="text-danger">spécialisé</span>.</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.inputfile').on('change',function(){

            var filename = $('input[type=file]').val().split('\\').pop();
            // .. do your magic

            $('#filename').html(filename);

            $('#validerImage').css('display','block');
        });

    </script>
@stop