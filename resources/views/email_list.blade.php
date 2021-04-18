@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de correos</div>

                <div class="card-body">
                    Sus correos
                </div>
                <div class="container">
                    <br>
                    <div class="row">
                        <div class="col">
                            <table class="table thead-dark">
                                <thead>
                                    <tr>
                                        <th class="text-center" >#</th>
                                        <th class="text-center">Asunto</th>
                                        <th class="text-center">Mensje</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $value)
                                    <tr>
                                        <th class="text-center">{{ $key+1 }}</th>
                                        <td class="text-center">{{ $value->asunto }}</td>
                                        <td class="text-center">{{ $value->mensaje }}</td>
                                        <td class="text-center">
                                            @if($value->estado == 0)
                                                Pendiente
                                            @else
                                                Enviado
                                            @endif

                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                                {{ $list->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
