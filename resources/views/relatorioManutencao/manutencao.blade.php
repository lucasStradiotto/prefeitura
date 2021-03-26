@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            {{--<li><a href="{{ route('indexJornadaTrabalho') }}">Jornadas de Trabalho</a></li>--}}
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
        <form action="{{route('gerarRelatorioManutencao')}}">
            <div>
                Inicio
            </div>
            <div>
                <input type="date" name="inicio" name="inicio">
            </div>
            <div>
                Fim
            </div>
            <div>
                <input type="date" name="fim" name="fim">
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection