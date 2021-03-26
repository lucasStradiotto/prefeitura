@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexExtintor') }}">Extintores</a></li>
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
        @if(isset($responsavel))
            <form class="container" method="post" action="{{ route('updateExtintor', $extintor->id) }}">
            {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeExtintor') }}">
        @endif
            {!! csrf_field() !!}

            <div>
                Inscrição
            </div>
            <div>
                <input name="inscricao" value="{{$extintor->inscricao or old('inscricao')}}">
            </div>

            <div>
                Validade
            </div>
            <div>
                <input name="validade" type="date" value="{{$extintor->validade or old('validade')}}">
            </div>

            <div>
                Tipo
            </div>
            <div>
                <input name="tipo" value="{{$extintor->tipo or old('tipo')}}">
            </div>
            <hr>
            <button class="btn btn-success">Enviar</button>

            </form>
    </div>
@endsection