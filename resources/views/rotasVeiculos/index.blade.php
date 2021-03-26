@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <a href="{{ route('createRotaVeiculo') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Veículo</th>
                    <th>Rota</th>
                    <th>Ação</th>
                </tr>
                @foreach ($rotasVeiculos as $rotaVeiculo)
                    <tr>
                        @foreach($veiculos as $veiculo)
                            @if ($veiculo->id == $rotaVeiculo->veiculo_id)
                                <td>{{$veiculo->placa}}</td>
                            @endif
                        @endforeach
                        @foreach($rotas as $rota)
                            @if ($rota->id == $rotaVeiculo->rota_id)
                                <td>{{$rota->nome}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{ route('editRotaVeiculo', $rotaVeiculo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('deleteRotaVeiculo', $rotaVeiculo->id) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 4000);
            }
        });
    </script>
@endsection