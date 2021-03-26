@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexAnomalia') }}">Anomalias</a></li>
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
        @if(isset($anomalia))
            <form class="container" method="post" action="{{ route('updateAnomalia', $anomalia->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeAnomalia') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$anomalia->nome or old('nome')}}">
            </div>
            <div>
                Prazo
            </div>
            <div>
                <input name="prazo" value="{{$anomalia->prazo or old('prazo')}}"> Dias
            </div>
            <button class="btn btn-success">Enviar</button>
            </form>
    </div>
@endsection