@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexParametrosFiscalizacao') }}">Parâmetros</a></li>
            <li><a href="{{ route('indexForro') }}">Forros</a></li>
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
        @if(isset($forro))
            <form class="container" method="post" action="{{ route('updateForro', $forro->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeForro') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Descrição
            </div>
            <div>
                <input name="descricao" value="{{$forro->descricao or old('descricao')}}">
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection