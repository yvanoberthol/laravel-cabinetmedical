<!DOCTYPE html>
<html>
<head>
    <title>Menu principal</title>
    @include('partials.css')
</head>
<body>
<a href="#" title="Haut de page" class="scrollup rounded"><span class="fa fa-arrow-up"></span></a>
<span id="name-authenticate" style="display:none">{{\Illuminate\Support\Facades\Auth::user()->username}}</span>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark" style="margin-top:20px; color:white; border-bottom: 10px solid royalblue">
        <div class="container text-center">
            <h1 style="color:royalblue">Espace d'administration à la gestion de notre cabinet</h1>
            <p>Organisation et gestion des activités relatives au cabinet médical.</p>
            <h3>
                @if (\Illuminate\Support\Facades\Auth::check())
                    <span>
	                Bienvenue <span class="text-warning" id="myName"></span> |
	                <button class="btn btn-danger" href="{{route('logout')}}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out">
                        </i>Déconnexion
                    </button>
                    </span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif

            </h3>
            <p>
                Les rôles à votre disposition:
                [--
                @foreach($user->roles as $urole)
                    <span style="color:grey">{{$urole->name}}</span>--
                @endforeach
]
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top:20px">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-info">
                    Domaines médicaux
                </div>
                <div class="card-body text-center">
                    <img class="card-img-top"
                         src="{{asset("imgs/programme_medical.jpg")}}"
                         alt="Spécialité médicale" style="width:200px; height:200px">
                </div>
                <div class="card-footer text-center">
                    <a href="{{route("specialites.index")}}">
                        Gestion des différentes spécialités médicales
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top:20px">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-info">
                    Créneaux Horaires
                </div>
                <div class="card-body text-center">
                    <img class="card-img-top"
                         src="{{asset("imgs/creneau.jpg")}}"
                         alt="utilisateurs" style="width:200px; height:200px">
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('creneaus.index')}}">
                        Gestion des créneaux horaires des médecins du cabinet médical
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top:20px">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-info">
                    Médécins
                </div>
                <div class="card-body text-center">
                    <img class="card-img-top"
                         src="{{asset("imgs/medecin.jpg")}}"
                         alt="utilisateurs" style="width:200px; height:200px">
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('medecins.index')}}">
                        Gestion des médécins du cabinet médical
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4" style="margin-top:20px">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-info">
                    Utilisateurs
                </div>
                <div class="card-body text-center">
                    <img class="card-img-top"
                         src="{{asset("imgs/comptes_utilisateurs.png")}}"
                         alt="utilisateurs" style="width:200px; height:200px">
                </div>
                <div class="card-footer text-center">
                    <a href="{{route('users.index')}}">
                        Gestion des utilisateurs de cette application
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</div>
@include('partials.script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#page-effect').fadeIn(1000);
        var url = "http://localhost:8000/menuPrincipal";
        $("#loader").fadeOut(15000,function(){
            $(location).attr('href', url);
        });

        var name = $('#name-authenticate').html();
        console.log(name);
        //ecrire automatiquement le nom
        $('#myName').typing(
            {
                sentences:[name],
                caretChar: '',
                caretClass: 'typingjs__caret',
                ignoreContent: false,
                ignorePrefix: false,
                typeDelay: 800,
                sentenceDelay: 1500,
                humanize: true
            }
        );
    });

    ScrollToTop=function() {
        var s = $(window).scrollTop();
        if (s > 250) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }

        $('.scrollup').click(function () {
            $("html, body").animate({ scrollTop: 0 }, 500);
            setTimeOut(500);
            $('html, body').stop();
            return false;
        });
    }

    $(window).scroll(function() {
        ScrollToTop();
    });
</script>
</body>
</html>