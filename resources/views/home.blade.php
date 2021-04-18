@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Datos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido!
                </div>
                <div class="container">
                    <div class="row">
                        @if(auth()->user()->rol == 'admin')
                        <form method="post" name="form1" action="{{ url('/home/buscar') }}">
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
                        <form method="post" action="{{ url('home') }}">
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
                         @endif
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <table class="table thead-dark">
                                <thead>
                                    <tr >
                                        <th class="text-center" >#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Celular</th>
                                        <th class="text-center">Cedula</th>
                                        <th class="text-center" >Fecha de nacimiento</th>
                                        <th class="text-center">Ciudad</th>
                                        <th class="text-right">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(auth()->user()->rol == 'admin')
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <th class="text-center">{{ $key+1 }}</th>
                                        <td>{{ $user->nombre }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->numero_celular }}</td>
                                        <td>{{ $user->cedula }}</td>
                                        <td>{{ $user->fecha_nacimiento }}</td>
                                        <td>{{ $user->ciudad_id }}</td>
                                        <td class="td-actions text-right">
                                         <form method="post" name="form2" action="{{ url('/home/'.$user->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ url('/home/'.$user->id.'/edit') }}" rel="tooltip" title="Editar usuario" class="btn btn-success btn-simple btn-xs">
                                            Editar
                                            </a>
                                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            Eliminar
                                            </button>  
                                         </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                 @else
                                    <tr>
                                        <th class="text-center">{{ 1 }}</th>
                                        <td>{{ $users->nombre }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->numero_celular }}</td>
                                        <td>{{ $users->cedula }}</td>
                                        <td>{{ $users->fecha_nacimiento }}</td>
                                        <td>{{ $users->ciudad_id }}</td>
                                        <td class="td-actions text-right">
                                         
                                        </td>
                                    </tr>

                                 @endif

                                </tbody>
                            </table>
                             @if(auth()->user()->rol == 'admin')
                                {{ $users->links() }}
                             @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
