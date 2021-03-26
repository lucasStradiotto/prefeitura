@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexResponsavel') }}">Responsáveis</a></li>
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
            <form class="container" method="post" action="{{ route('updateResponsavel', $responsavel->id) }}">
            {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeResponsavel') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$responsavel->nome or old('nome')}}">
            </div>
            <div>
                Email
            </div>
            <div>
                <input name="email" value="{{$responsavel->email or old('email')}}">
            </div>
            <button class="btn btn-success">Enviar</button>

            </form>
    </div>
@endsection