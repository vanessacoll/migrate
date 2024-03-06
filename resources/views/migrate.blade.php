<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<link href="{{ asset('/ico/favicon.ico') }}" rel="icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Meru RRHH</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('/template/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('/template/dist/css/adminlte.min.css?v=3.2.0') }}">
<link rel="stylesheet" href="{{ asset('/template/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

<script nonce="b990446e-6bd4-4eb9-8846-953536fdc76b">try{(function(w,d){!function(ct,cu,cv,cw){ct[cv]=ct[cv]||{};ct[cv].executed=[];ct.zaraz={deferred:[],listeners:[]};ct.zaraz.q=[];ct.zaraz._f=function(cx){return async function(){var cy=Array.prototype.slice.call(arguments);ct.zaraz.q.push({m:cx,a:cy})}};for(const cz of["track","set","debug"])ct.zaraz[cz]=ct.zaraz._f(cz);ct.zaraz.init=()=>{var cA=cu.getElementsByTagName(cw)[0],cB=cu.createElement(cw),cC=cu.getElementsByTagName("title")[0];cC&&(ct[cv].t=cu.getElementsByTagName("title")[0].text);ct[cv].x=Math.random();ct[cv].w=ct.screen.width;ct[cv].h=ct.screen.height;ct[cv].j=ct.innerHeight;ct[cv].e=ct.innerWidth;ct[cv].l=ct.location.href;ct[cv].r=cu.referrer;ct[cv].k=ct.screen.colorDepth;ct[cv].n=cu.characterSet;ct[cv].o=(new Date).getTimezoneOffset();if(ct.dataLayer)for(const cG of Object.entries(Object.entries(dataLayer).reduce(((cH,cI)=>({...cH[1],...cI[1]})),{})))zaraz.set(cG[0],cG[1],{scope:"page"});ct[cv].q=[];for(;ct.zaraz.q.length;){const cJ=ct.zaraz.q.shift();ct[cv].q.push(cJ)}cB.defer=!0;for(const cK of[localStorage,sessionStorage])Object.keys(cK||{}).filter((cM=>cM.startsWith("_zaraz_"))).forEach((cL=>{try{ct[cv]["z_"+cL.slice(7)]=JSON.parse(cK.getItem(cL))}catch{ct[cv]["z_"+cL.slice(7)]=cK.getItem(cL)}}));cB.referrerPolicy="origin";cB.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(ct[cv])));cA.parentNode.insertBefore(cB,cA)};["complete","interactive"].includes(cu.readyState)?zaraz.init():ct.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">


<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
<div class="container">
<a href="#" class="navbar-brand">
<img src="{{ asset('/ico/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image">
<span class="brand-text font-weight-light">Meru RRHH</span>
</a>
</div>
</nav>


<div class="content-wrapper">
<div class="content-header">
<div class="container">
 @include('alert')
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0"> Migracion de Conceptos de Nomina</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
    Subir Archivo
    </button>

    <a href="{{ route('clean.data') }}" class="btn btn-secondary ml-2" >
    Limpiar Tabla
    </a>
</ol>
</div>
</div>
</div>
</div>


<div class="content">
<div class="container">

@include('modal')

<div class="row">

<div class="col-12">
    @include('table')
</div>
</div>
</div>
</div>
</div>



<footer class="main-footer">
<strong>Copyright &copy; 2024 <a href="#">Meru RRHH</a>.</strong> All rights reserved.
</footer>
</div>



<script src="{{ asset('/template/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('/template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('/template/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

<script src="{{ asset('/template/dist/js/demo.js') }}"></script>

<script src="{{ asset('/template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('/template/plugins/toastr/toastr.min.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function(){
            var nombreArchivo = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(nombreArchivo);
        });

        $('#modal-default').on('hidden.bs.modal', function (e) {
            $(this).find('input[type=file]').val('');
            $(this).find('.custom-file-label').html('Elegir archivo...');
        });

        $('#modal-default').on('shown.bs.modal', function (e) {
            $(this).find('input[type=file]').val('');
            $(this).find('.custom-file-label').html('Elegir archivo...');
        });

        setTimeout(function() {
                $("#alerta").fadeOut();
            }, 5000);
    });
</script>

</body>
</html>
