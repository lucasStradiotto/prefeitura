@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexRotaVeiculo') }}">Rotas/Veículos</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        @if(isset($rotaVeiculo))
            <form class="container" method="post" action="{{ route('updateRotaVeiculo', $rotaVeiculo->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeRotaVeiculo') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Veículo
            </div>
            <div>
                <select name="veiculo_id">
                    <option value="">Selecione o Veículo</option>
                    @foreach ($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}"
                                @if (isset($rotaVeiculo))
                                    @if ($veiculo->id == $rotaVeiculo->veiculo_id)
                                        selected
                                    @endif
                                @endif
                        >{{$veiculo->placa}}</option>
                    @endforeach
                </select>
                <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <div>
                Rota
            </div>
            <div>
                <select name="rota_id">
                    <option value="">Selecione a Rota</option>
                    @foreach ($rotas as $rota)
                        <option value="{{$rota->id}}"
                                @if (isset($rotaVeiculo))
                                    @if ($rota->id == $rotaVeiculo->rota_id)
                                        selected
                                    @endif
                                @endif
                        >{{$rota->nome}}</option>
                    @endforeach
                </select>
                <a href="../../dashboard/rotas/cadastro#janela1" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection