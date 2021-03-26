@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        <p><a class="btn btn-success" href="{{route('indexGastoManutencao')}}">Gastos com Manutenção</a></p>
        <p><a class="btn btn-success" href="{{route('indexArrecadacaoProtocolo')}}">Arrecadação com Protocolos</a></p>
        <p><a class="btn btn-success" href="{{route('indexCacambaEntregue')}}">Caçambas Entregues</a></p>
    </div>
@endsection