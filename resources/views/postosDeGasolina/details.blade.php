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
            <li><a href="{{ route('indexPosto') }}">Postos de Combustíveis</a></li>
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
    @if(isset($posto))
        <div>
            <dl>
                <dt>Nome:</dt>
                <dd>&nbsp{{$posto->nome}}</dd>
                <dt>Nome Fantasia:</dt>
                <dd>&nbsp{{$posto->nome_fantasia}}</dd>
                <dt>Cep:</dt>
                <dd>&nbsp{{$posto->cep}}</dd>
                <dt>Endereço:</dt>
                <dd>&nbsp{{$posto->endereco}}</dd>
                <dt>Número:</dt>
                <dd>&nbsp{{$posto->numero}}</dd>
                <dt>Bairro:</dt>
                <dd>&nbsp{{$posto->bairro}}</dd>
                <dt>Cidade:</dt>
                <dd>&nbsp{{$posto->cidade}}</dd>
                <dt>Complemento:</dt>
                <dd>&nbsp{{$posto->completemento}}</dd>
                <dt>CNPJ:</dt>
                <dd>&nbsp{{$posto->cnpj}}</dd>
                <dt>Inscrição Estadual:</dt>
                <dd>&nbsp{{$posto->inscricao_estadual}}</dd>
                <dt>Inscrição Municipal:</dt>
                <dd>&nbsp{{$posto->inscricao_municipal}}</dd>
                <dt>Telefone:</dt>
                <dd>&nbsp{{$posto->telefone}}</dd>
                <dt>Telefone Secundário:</dt>
                <dd>&nbsp{{$posto->telefone_dois}}</dd>
                <dt>Contato:</dt>
                <dd>&nbsp{{$posto->contato}}</dd>
                <dt>E-mail:</dt>
                <dd>&nbsp{{$posto->email}}</dd>
                <dt>Caixa Postal:</dt>
                <dd>&nbsp{{$posto->caixa_postal}}</dd>
                @if(isset($tipoCombustivel))
                    <dt>Tipos de Combustíveis: </dt>
                    <br/>
                    @foreach($tipoCombustivel as $tipo)
                        <dd>{{$tipo->descricao}}</dd>
                    @endforeach
                @endif
            </dl>
        </div>
    @endif
    <a href="{{route('indexPosto')}}" class="btn btn-danger">Voltar</a>

@endsection