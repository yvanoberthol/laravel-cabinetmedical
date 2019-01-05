@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="grand-titre">Enregistrer un créneau pour un médécin</h1>

            <form action="{{route('creneaus.store')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="post">
                <div class="form-group">
                    <label class="control-label">Heure de début:</label>
                    <input type="time" name="hdebut" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Heure de fin:</label>
                    <input type="time" name="hfin" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Médécin:</label>
                    <select name="medecin_id" class="form-control selectpicker">
                        @foreach($medecins as $medecin)
                            <option value="{{$medecin->id}}">{{$medecin->firstname.' '.$medecin->lastname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" style="background-color: purple; color:white"><span class="fa fa-plus-circle"></span> Ajouter</button>
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