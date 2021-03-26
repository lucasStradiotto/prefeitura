@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexParametrosFiscalizacao') }}">Parâmetros</a></li>
            <li><a href="{{ route('indexCasaAlinhada') }}">Casa Alinhada</a></li>
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
        @if(isset($casa))
            <form class="container" method="post" action="{{ route('updateCasaAlinhada', $casa->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeCasaAlinhada') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Descrição
            </div>
            <div>
                <input name="descricao" value="{{$casa->descricao or old('descricao')}}">
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection