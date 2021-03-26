@extends('layouts.app')

@section('content')
    <style>

        dt{
            float:left;
        }

        dd{
            margin-left: 20px;
        }
    </style>
    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexVeiculo') }}">Veículos</a></li>
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
    @if(isset($veiculo))
        <input type="hidden" id="veiculoId" value="{{$veiculo->id}}">
        <div>
            <dl>
                <dt>Tipo de Veículo:</dt>
                @if(isset($tipoVeiculo))
                    <dd>&nbsp{{$tipoVeiculo->nome}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Secretaria:</dt>
                @if(isset($secretaria))
                    <dd>&nbsp{{$secretaria->nome}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Modelo:</dt>
                <dd>&nbsp{{$veiculo->modelo}}</dd>
                <dt>Ano:</dt>
                <dd>&nbsp{{$veiculo->ano}}</dd>
                <dt>Cor:</dt>
                <dd>&nbsp{{$veiculo->cor}}</dd>
                <dt>Fabricante:</dt>
                <dd>&nbsp{{$veiculo->fabricante}}</dd>
                <dt>Placa:</dt>
                <dd>&nbsp{{$veiculo->placa}}</dd>
                {{--<dt>Instrumento de Medida:</dt>--}}
                {{--<dd>&nbsp{{$veiculo->instrumento_medida ? $veiculo->instrumento_medida : 'Não Informado'}}</dd>--}}
                <dt>Prefixo:</dt>
                <dd>&nbsp{{$veiculo->prefixo}}</dd>
                <dt>Número de Série do Rastreador:</dt>
                <dd>&nbsp{{$veiculo->n_serie_rastreador}}</dd>
                <dt>Código do Cartão do Veículo:</dt>
                <dd>&nbsp{{$veiculo->codigo_barra}}</dd>
                <dt>Empresa:</dt>
                @if(isset($empresa))
                    <dd>&nbsp{{$empresa->nome_fantasia}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Horário Programado Específico:</dt>
                @if(isset($horarioProgramado))
                    <dd>&nbsp{{$horarioProgramado->inicio}} - {{$horarioProgramado->fim}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
            </dl>
        </div>
    @endif
    <a href="{{route('indexVeiculo')}}" class="btn btn-danger">Voltar</a>

@endsection