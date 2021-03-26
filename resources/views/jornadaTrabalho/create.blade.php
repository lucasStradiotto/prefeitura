@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexJornadaTrabalho') }}">Jornadas de Trabalho</a></li>
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
        @if(isset($jornadaTrabalho))
            <form class="container" method="post" action="{{ route('updateJornadaTrabalho', $jornadaTrabalho->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeJornadaTrabalho') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Inicio
                        </div>
                        <div>
                            <input type="time" name="inicio" value="{{$jornadaTrabalho->inicio or old('inicio')}}">
                        </div>
                        <div>
                            Fim
                        </div>
                        <div>
                            <input type="time" name="fim" value="{{$jornadaTrabalho->fim or old('fim')}}">
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection