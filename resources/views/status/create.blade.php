@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexStatus') }}">Status</a></li>
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
        @if(isset($status))
            <form class="container" method="post" action="{{ route('updateStatus', $status->id) }}">
        {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeStatus') }}">
        @endif
        {!! csrf_field() !!}
        <div>
            Nome
        </div>
        <div>
            <input name="nome" value="{{$status->nome or old('nome')}}">
        </div>
        <div>
            Cor
        </div>
        <div>
            <input name="cor" type="color" value="{{$status->cor or old('cor')}}">
        </div>
        <br>
        <button class="btn btn-success">Enviar</button>
    </form>
    </div>
@endsection