@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexUnidadeIntervalo') }}">Unidades de Intervalo</a></li>
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
        @if(isset($unidadeIntervalo))
            <form class="container" method="post" action="{{ route('updateUnidadeIntervalo', $unidadeIntervalo->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeUnidadeIntervalo') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$unidadeIntervalo->nome or old('nome')}}">
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection