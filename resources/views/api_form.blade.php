@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Datos</div>

                <div class="card-body">
                    Bienvenido!
                </div>
                <div class="container">
                    <div class="row">
                        <form method="post" name="form1" action="{{ url('/buscar') }}">
                        {{ csrf_field() }}
                            <div class="input-group col-12">
                              <div class="form-outline">
                                <input type="text" id="search" name="search" class="form-control" value="" />
                              </div>
                              <button type="submit" rel="tooltip" title="Buscar" class="btn btn-primary">
                                Buscar
                              </button>
                            </div>
                        </form>
                        <form method="post" action="{{ url('/') }}">
                            {{ csrf_field() }}
                            <div class="input-group">
                              <div class="form-outline">Mostrar
                                <select class="form-select" name="pagina" id="pagina" aria-label="numero de pagincón" onchange="this.form.submit()" >
                                   @foreach ($paginas as $pag)
                                        <option value="{{ $pag }}" @if( $pag == $cantidad ) selected @endif>{{ $pag }}</option>
                                   @endforeach
                                </select>
                              </div>
                             </div>
                        </form>
                       
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <table class="table thead-dark">
                                <thead>

                                    <tr >
                                        <th class="text-center" >#</th>
                                        <th class="text-center">Remitente</th>
                                        <th class="text-center">destinatario</th>
                                        <th class="text-center">Asunto</th>
                                        <th class="text-center">Mensaje</th>
                                        <th class="text-center" >Estado</th>
                                        <th class="text-center">Fecha Creación</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datos as $key => $dato)
                                    <tr>
                                        <th class="text-center">{{ $key+1 }}</th>
                                        <td>{{ $dato['remitente'] }}</td>
                                        <td>{{ $dato['destinatario'] }}</td>
                                        <td>{{ $dato['asunto'] }}</td>
                                        <td>{{ $dato['mensaje'] }}</td>
                                        <td>{{ $dato['estado'] }}</td>
                                        <td>{{ $dato['fecha_creacion'] }}</td>
                                      
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                               
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
