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
            <li><a href="{{ route('indexMotorista') }}">Motoristas</a></li>
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
    @if(isset($motorista))
        <div>
            <dl>
                <dt>Nome:</dt>
                <dd>&nbsp{{$motorista->nome}}</dd>
                <dt>CPF:</dt>
                <dd>&nbsp{{$motorista->cpf}}</dd>
                <dt>RG:</dt>
                <dd>&nbsp{{$motorista->rg}}</dd>
                <dt>Número CNH:</dt>
                <dd>&nbsp{{$motorista->cnh_numero}}</dd>
                <dt>Categoria:</dt>
                <dd>&nbsp{{$motorista->cnh_categoria}}</dd>
                <dt>Validade CNH:</dt>
                @if(isset($cnhValidade))
                    <dd>&nbsp{{date('d/m/y',strtotime($cnhValidade->validade))}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Empresa:</dt>
                @if(isset($empresa))
                    <dd>&nbsp{{$empresa->nome_fantasia}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Secretaria:</dt>
                @if(isset($secretaria))
                    <dd>&nbsp{{$secretaria->nome}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
                <dt>Jornada de Trabalho:</dt>
                @if(isset($jornadaTrabalho))
                    <dd>&nbsp{{$jornadaTrabalho->inicio}} - {{$jornadaTrabalho->fim}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
            </dl>
        </div>
    @endif
    <a href="{{route('indexMotorista')}}" class="btn btn-danger">Voltar</a>

@endsection