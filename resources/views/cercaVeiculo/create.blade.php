@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexCercaVeiculo') }}">Cercas/Veículos</a></li>
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
        @if(isset($cercaVeiculo))
            <form class="container" method="post" action="{{ route('updateCercaVeiculo', $cercaVeiculo->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeCercaVeiculo') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Veículo
            </div>
            <div>
                <select id="slcVeiculo" name="veiculo_id">
                    <option value="">Selecione o Veículo</option>
                    @foreach ($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}"
                                @if (isset($cercaVeiculo))
                                    @if ($veiculo->id == $cercaVeiculo->veiculo_id)
                                        selected
                                    @endif
                                @endif
                        >{{$veiculo->placa}}</option>
                    @endforeach
                </select>
                <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <div>
                Cerca
            </div>
            <div>
                <select id="slcCerca" name="cerca_id">
                    <option value="">Selecione a Cerca</option>
                    @foreach ($cercasEletronicas as $cercaEletronica)
                        <option value="{{$cercaEletronica->id}}"
                                @if (isset($cercaVeiculo))
                                    @if ($cercaEletronica->id == $cercaVeiculo->cerca_id)
                                        selected
                                    @endif
                                @endif
                        >{{$cercaEletronica->nome}}</option>
                    @endforeach
                </select>
                <a href="{{ route('createCercaEletronica') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <div>
                Data Início
            </div>
            <div>
                <input type="datetime-local" name="data_inicio" value="{{$cercaVeiculo->data_inicio or old('data_inicio')}}">
            </div>
            <div>
                Data Fim
            </div>
            <div>
                <input type="datetime-local" name="data_fim" value="{{$cercaVeiculo->data_fim or old('data_fim')}}">
            </div>
            <div>
                Evento
            </div>
            <div>
                <select name="acao">
                    <option value="2"
                    @if(isset($cercaVeiculo) && ($cercaVeiculo->acao == 2))
                        selected
                    @endif
                    >Entrada em Cerca</option>
                    <option value="5"
                    @if(isset($cercaVeiculo) && ($cercaVeiculo->acao == 5))
                        selected
                    @endif
                    >Saída de Cerca</option>
                </select>
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection