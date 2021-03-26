@extends('layouts.app')

@section('content')
    <style>
        dt{
            float:left;
        }
    </style>
    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoVeiculo') }}">Tipos de Veículos</a></li>
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
    @if(isset($tipoVeiculo))
        <div>
            <dl>
                <dt>Tipo de Veículo:&nbsp;</dt>
                <dd>{{$tipoVeiculo->nome}}</dd>
                <dt>Instrumento de Medida:&nbsp;</dt>
                <dd>{{$tipoVeiculo->instrumento_medida}}</dd>
            </dl>
        </div>
    @endif
    <a href="{{route('indexTipoVeiculo')}}" class="btn btn-danger">Voltar</a>

@endsection