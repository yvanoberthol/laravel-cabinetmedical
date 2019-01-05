@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="grand-titre">Editer créneau N° <span class="text-primary">{{$creneau->id}}</span></h1>

            <form action="{{route('creneaus.update',[$creneau->id])}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label class="control-label">Heure de début:</label>
                    <input type="time" name="hdebut" value="{{$creneau->hdebut}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Heure de fin:</label>
                    <input type="time" name="hfin" value="{{$creneau->hfin}}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Médécin:</label>
                    <select name="medecin_id" class="form-control selectpicker">
                        @foreach($medecins as $medecin)
                            <option value="{{$medecin->id}}"
                            @if ($medecin->id == $creneau->medecin->id)
                                selected
                            @endif
                            >
                                {{$medecin->firstname.' '.$medecin->lastname}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info" style="color:white"><span class="fa fa-edit"></span> Modifier</button>
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