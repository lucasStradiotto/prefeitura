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
            <li><a href="{{ route('indexSecretaria') }}">Secretarias</a></li>
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
    @if(isset($secretaria))
        <div>
            <dl>
                <dt>Secretaria:</dt>
                <dd>&nbsp{{$secretaria->nome}}</dd>
                <dt>Horário Programado:</dt>
                @if(isset($horarioProgramado))
                    <dd>&nbsp{{$horarioProgramado->inicio}} - {{$horarioProgramado->fim}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
            </dl>
        </div>
    @endif
    <a href="{{route('indexSecretaria')}}" class="btn btn-danger">Voltar</a>

@endsection