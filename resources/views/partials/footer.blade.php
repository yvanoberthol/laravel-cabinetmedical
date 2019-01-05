<div class="row bg-dark" style="margin-top:25px; color:white; border-top: 10px solid royalblue">
    <div class="col-md-4 text-center">
        <h4 class="font-weight-bold" style="color:royalblue">Fonctionnalités de l'application</h4>
        <h6><a href="{{route('specialites.index')}}" style="color:gray;">Gestion des domaines médicaux</a></h6>
        <h6><a href="{{route('medecins.index')}}" style="color:grey;">Gestion des médécins</a></h6>
        <h6><a href="{{route('creneaus.index')}}" style="color:grey;">Gestion des créneaux</a></h6>
        @if (\App\User_role::where(['id_user'=>\Illuminate\Support\Facades\Auth::id(),'id_role'=>2])->exists())
            <h6>
                <a href="{{route('users.index')}}" style="color:gray;">Gestion des utilisateurs</a>
            </h6>
        @endif

    </div>
    <div class="col-md-4 text-center">
        <h4 class="font-weight-bold" style="color:royalblue">Contactez nous</h4>
        <h6>Email: yvanoberthol@gmail.com</h6>
        <h6>Tel: 690735187 - 682296797</h6>
    </div>
    <div class="col-md-4 text-center">
        <h4 class="font-weight-bold" style="color:royalblue">Notre état et situation</h4>
        <h6>Nous sommes situé à bonabéri(ngwele)</h6>
        <h6>Mon cabinet de médécin copyright @<span class="text-warning"><?php echo date("Y")?></span></h6>
    </div>
</div>