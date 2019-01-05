<!DOCTYPE html>
<html>
<head>
    <title>Chargement ....</title>
    @include('partials.css')
</head>
<body>
<div id="loader">
    <div class="thecube">
        <div class="cube c1"></div>
        <div class="cube c2"></div>
        <div class="cube c4"></div>
        <div class="cube c3"></div>
    </div>
    <div class="text-center name-user" style="margin-top: 40px; z-index:40;">
        <h3 class="text-uppercase">{{\Illuminate\Support\Facades\Auth::user()->username}}</h3>
    </div>
</div>

@include('partials.script')
</body>
</html>