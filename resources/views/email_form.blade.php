@extends('layouts.app')

@section('content')
<form class="needs-validation tab-pane fade show active"  novalidate  method="post" action="{{ url('/home/form-email') }}" enctype="multipart/form-data" autocomplete="off">
    {{ csrf_field() }}
    <div class="card-body">
      <ul class="list-unstyled font-size-sm">
          <li><h5 class="card-title text-accent"><span class="text-muted">De:&nbsp;</span>{{ $user->nombre }} '{{ $user->email }}'</li></h5>
          <li><h5 class="card-title text-accent"><span class="text-muted">Para:&nbsp;</span><input type="text" name="email" id="email" class="form-control"></li></h5>
          <li><h5 class="card-title text-accent"><span class="text-muted">Asunto:&nbsp;</span><input type="text" name="asunto" id="asunto" class="form-control">  </li></h5>
        </ul>
        
        <textarea class="form-control" placeholder="Escriba el mensaje" rows="4" name="mensaje" id="mensaje" maxlength="80"></textarea><br>
       
          <button class="btn btn-info btn-block" type="submit"><span class="d-none d-sm-inline">Enviar Correo</span><span class="d-inline d-sm-none">Enviar</span><i class="czi-check mt-sm-0 ml-1"></i>
          </button>
        
    </div>
</form>
@endsection
