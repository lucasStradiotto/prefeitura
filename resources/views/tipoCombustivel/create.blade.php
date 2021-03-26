@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoCombustivel') }}">Tipos de Combustível</a></li>
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
        @if(isset($tipoCombustivel))
            <form class="container" method="post" action="{{ route('updateTipoCombustivel', $tipoCombustivel->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeTipoCombustivel') }}">
        @endif
        {!! csrf_field() !!}
        <div>
            Descrição
        </div>
        <div>
            <input name="descricao" value="{{$tipoCombustivel->descricao or old('descricao')}}">
        </div>
        <button class="btn btn-success">Enviar</button>

    </form>
    </div>
@endsection