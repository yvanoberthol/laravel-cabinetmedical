<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Cabinet médical</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    @include('partials.css')
    @include('partials.script')
</head>
<body>
<div class="container">

    <div class="row mb-4 mt-2">
        <nav class="col-md-12 navbar navbar-icon-top navbar-expand-lg navbar-dark bg-secondary p-3">
            <a class="navbar-brand" href="/menuPrincipal"><span class="fa fa-ambulance badge-info text-danger p-3"></span> Gestion du cabinet médical</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-o">
                            </i>
                            Médécins
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/medecins">Liste des médécins</a>
                            <a class="dropdown-item" href="/medecins/create">Ajouter un médécin</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-file-zip-o">
                            </i>
                            Spécialités
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/specialites">Liste des spécialités</a>
                            <a class="dropdown-item" href="/specialites/create">Ajouter une spécialité</a>
                            <a class="dropdown-item" href="/statMedecinSpecialite">Statistique sur les spécialités</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-hourglass-end">
                            </i>
                            Créneaux
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/creneaus">Liste des créneaux</a>
                            <a class="dropdown-item" href="/creneaus/create">Ajouter un créneau</a>
                        </div>
                    </li>
                    @if (\App\User_role::where(['id_user'=>\Illuminate\Support\Facades\Auth::id(),'id_role'=>2])->exists())
                        {{--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-legal">
                                </i>
                                Roles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="/roles">Liste des roles</a>
                                <a class="dropdown-item" href="/roles/create">Ajouter un role</a>
                            </div>
                        </li>--}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user">
                                </i>
                                Users
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="/users">Liste des users</a>
                                <a class="dropdown-item" href="/formaddrole">Ajouter un rôle à un utilisateur</a>
                                <a class="dropdown-item" href="/users/create">Ajouter un user</a>
                            </div>
                        </li>
                    @endif
                    @endauth
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest

                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle">
                            </i>
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/users/{{\Illuminate\Support\Facades\Auth::id()}}/edit">
                                <i class="fa fa-calculator">
                                </i>
                                Mon compte
                            </a>
                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out">
                                </i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
    <div class="row mb-2">
        @include('partials.error')
        @include('partials.success')
    </div>
    @yield('content')
    <div class="row mt-5 bg-secondary">
        <h2 class="col-md-12 text-center text-white p-3">
            Gestion cabinet médical All rights reserved <span class="text-black-50"><?php echo date('Y')?></span>
        </h2>
    </div>
</div>
</body>