@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoEntulho') }}">Tipos de Entulho</a></li>
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
        @if(isset($tipoEntulho))
            <form class="container" method="post" action="{{ route('updateTipoEntulho', $tipoEntulho->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeTipoEntulho') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Tipo do Entulho
                        </div>
                        <div>
                            <input name="nome" value="{{$tipoEntulho->nome or old('nome')}}">
                        </div>
                        <button class="btn btn-success" id="btnEnviar">Enviar</button>
                    </form>
    </div>
@endsection