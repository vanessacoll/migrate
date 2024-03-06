@if(session('error'))
<div id="alerta" class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <i class="icon fas fa-ban"></i> {{ session('error') }}
</div>
@endif

@if(session('success'))
<div id="alerta" class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fas fa-check"></i> {{ session('success') }}
</div>
@endif
