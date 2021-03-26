@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
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
    <div>
        @if(isset($horarioProgramado))
            <form class="container" method="post" action="{{ route('updateHorarioProgramado', $horarioProgramado->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeHorarioProgramado') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Inicio
                        </div>
                        <div>
                            <input type="time" name="inicio" value="{{$horarioProgramado->inicio or old('inicio')}}">
                        </div>
                        <div>
                            Fim
                        </div>
                        <div>
                            <input type="time" name="fim" value="{{$horarioProgramado->fim or old('fim')}}">
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection