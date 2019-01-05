@extends('template')
@section('content')
    <div class="row">
        <ol class="breadcrumb col-md-12">
            <li style="margin-right: 20px">
                <a href="{{route('specialites.index')}}">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                    Retour à la liste des domaines
                </a>
            </li>
            <li>
                <a href="" data-toggle="modal" data-target="#formDescription">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Editer sa description
                </a>
            </li>
            <div class="modal" id="formDescription">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header text-center">
                            <h4 class="modal-title">Modifier la description de ce domaine</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <form action="{{route('specialites.update',[$specialite->id])}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="put">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <h1><span class="text-info">{{$specialite->name}}</span></h1>
                                        <input type="hidden" name="name" value="{{$specialite->name}}">
                                        <div class="form-group">
                                            <label class="control-label">Description de la spécialité</label>
                                            <textarea rows="10" cols="15" name="description"  id="description-domain" >
                                                {{$specialite->description}}
											</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info"><span class="fa fa-edit"></span> Modifier</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </ol>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row bg-primary">
                <h2 class="text-center col-md-12">{{$specialite->name}}</h2>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 10px">
                    <hr/>
                </div>
            </div>
            <p>
                <strong>Description: </strong><br>
            </p>
            <div class="p-3 mb-5" style="font-size: 20px; border:black 2px solid">
                @if ($specialite->description != null)
                    {!! $specialite->description !!}
                @else
                    Aucune description ...
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <ol class="breadcrumb col-md-12">
            <li>
                <a href="" data-toggle="collapse" data-target="#medecinDomain">
                   <span class="fa fa-user-circle-o"></span> Avoir la liste des médecins de ce domaine
                </a>
            </li>
        </ol>
    </div>
    <div id="medecinDomain" class="collapse fade">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th colspan="2">
                        Nom(s) et prénom(s) des médécins de ce domaine
                    </th>
                    <th>
                        Total: <span class="text-info">{{$medecins->count()}}</span>
                    </th>
                </tr>
                @if ($medecins->count() >0)
                    @foreach($medecins as $medecin)
                        <tr class="text-center" >
                            <td colspan="2" class="text-uppercase text-success font-weight-bold">{{$medecin->firstname.' '.$medecin->lastname}}</td>
                            <td><a href="/medecins/{{$medecin->id}}">Avoir des détails</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center"><h3 class="text-danger">Aucun médécin trouvé ...</h3></td>
                    </tr>
                @endif

            </table>
        </div>
        <div class="col-md-6 text-center offset-md-4">
            {!!$medecins->links('vendor.pagination.bootstrap-4',['elements'=>$medecins])!!}
        </div>
    </div>
    <script>

        $(document).ready(function(){
            $("#description").collapse('show');
            $("#description").on("show.bs.collapse", function(){
                $(".coulisseur").html('<span class="fa fa-minus"></span> Cacher');
                $(".coulisseur").removeClass("btn-info").addClass("btn-danger");
            });
            $("#description").on("hide.bs.collapse", function(){
                $(".coulisseur").html('<span class="fa fa-plus-circle"></span> Afficher');
                $(".coulisseur").removeClass("btn-danger").addClass("btn-info");
            });
            $("#medecinDomain").collapse('hide');
        });
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description-domain' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop