@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoAssunto') }}">Grupos de Assuntos</a></li>
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
        @if(isset($tipoAssunto))
            <form class="container" method="post" action="{{ route('updateTipoAssunto', $tipoAssunto->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeTipoAssunto') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="grupo" value="{{$tipoAssunto->grupo or old('grupo')}}">
            </div>
            <button class="btn btn-success">Enviar</button>

            </form>
    </div>
@endsection