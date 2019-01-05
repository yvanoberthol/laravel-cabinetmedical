@extends('template')
@section('content')
<div class="grand-titre row" style="margin-bottom:25px">
    <div class="text-center" style="font-size:40px; font-weight:bolder">
        Calcul des ressources humaines de tous les domaines
    </div>
</div>
<div class="row">
    <div class="text-center" id="stat-medecins-domaines" style="height: 400px; width: 100%;">

    </div>
    <!-- The Modal -->
    <div class="modal fade" id="listeMedecins" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title">Liste des médécins de ce domaine</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <ul class="breadcrumb col-md-12">
        <li class="breadcrumb-item"><a href="/specialites">Retour à la liste des domaines</a></li>
        <li class="breadcrumb-item"><a href="/medecins">Retour la liste des médécins</a></li>
    </ul>
</div>
<script>
    $(document).ready(function(){
        var liste = <?php echo json_encode($statMedecinSpecialite)?>;

        var counts = [];

        for (i=0;i<liste.length;i++){
            counts.push(liste[i]['y']);
        }
        console.log(counts);

        var specialites= [];
        var minValue = 0;
        var maxValue = 1000;
        var i;
        for (i=0;i<liste.length;i++){
            if(counts[i] < maxValue){
                maxValue = counts[i];
            }
            if(counts[i] > minValue){
                minValue = counts[i];
            }
        }
        for (i=0;i<liste.length;i++){
            if(counts[i] < minValue && counts[i] > maxValue){
                specialites.push({label:liste[i]["label"], y:counts[i], e:""});
            }

            if(counts[i] == minValue){
                specialites.push({label:liste[i]["label"], y:counts[i], e:"plus grand"});
            }

            if(counts[i] == maxValue){
                specialites.push({label:liste[i]["label"], y:counts[i], e:"plus petit"});
            }
        }

        var chart = new CanvasJS.Chart("stat-medecins-domaines", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Statistique sur le total de médécins par domaine"
            },
            axisY: {
                title: "Médécins par domaine(pers)",
                suffix: " pers",
                includeZero: true
            },
            axisX: {
                title: "Liste des domaines ("+liste.length+")"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0#\" médécins(s)\"",
                indexLabelFontColor: "#5A5757",
                dataPoints: specialites,
                indexLabel: "{e}",
                click: function(e){
                    $("#listeMedecins").modal();
                },
            }]
        });
        chart.render();

    });
</script>
@endsection