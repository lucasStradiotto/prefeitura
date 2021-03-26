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
            <li><a href="{{ route('indexHorarioProgramado') }}">Horários Programados</a></li>
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
    @if(isset($horarioProgramado))
        <div>
            <dl>
                <dt>Início:&nbsp</dt>
                <dd>{{$horarioProgramado->inicio}}</dd>
                <dt>Fim:&nbsp</dt>
                <dd>{{$horarioProgramado->fim}}</dd>
            </dl>
        </div>
    @endif
    <a href="{{route('indexHorarioProgramado')}}" class="btn btn-danger">Voltar</a>

@endsection