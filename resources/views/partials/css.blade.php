<link rel="stylesheet" href="{{asset("css/app.css")}}">
<link rel="stylesheet" href="{{asset("css/file_style.css")}}">
<link rel="stylesheet" href="{{asset("css/bootstrap-select.css")}}">
<link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
<link rel="stylesheet" href="{{asset("css/cubeloading.css")}}">
<script src="{{asset("js/ckeditor.js")}}"></script>
<style type="text/css">

    .scrollup {
        width: 40px;
        height: 40px;
        position: fixed;
        bottom: 10px;
        right: 10px;
        display: none;
        color: royalblue;
        background-color: #3a3f51;
        border: 1px solid #3a3f51;
        font-size: 20px;
        text-align: center;
        line-height: 37px;
        z-index : 3;
    }
    .scrollup:hover {
        color: white;
    }

    .maincompte:hover .maincompte-menu {
        display: block;
        width:100%;
        margin-top: 0;
    }

    .name-user{
        font-weight: bolder;
        color: maroon;
    }
    .maincompte:hover{
        background-color:green
    }
    .dropdown-item{
        background-color:#80D0D0
    }
    .dropdown-item:hover{
        background-color : #26619C;
        color:white
    }
    .detail{
        color:#006400;
        font-weight:bolder;
    }
    .competence:hover{
        cursor: pointer;
        color:#006400;
    }

    body{
        background-color:#DDD5D2;
    }

    .grand-titre{
        background-color:#BBAA8F;
    }

    #page-effect{
        display:none;
    }
    #loader{
        margin-top: 50vh; /* poussé de la moitié de hauteur de viewport */
        transform: translateY(-50%); /* tiré de la moitié de sa propre hauteur */
    }

    /* #loader{
        z-index:999999;
        display:block;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:url(../images/loader.gif) 50% 50% no-repeat #cccccc;
   } */
</style>