@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexIconesCidadeFacil') }}">Ícones</a></li>
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
        @if(isset($icone))
            <form class="container" enctype="multipart/form-data" method="post" action="{{ route('updateIconesCidadeFacil', $icone->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" enctype="multipart/form-data" method="post" action="{{ route('storeIconesCidadeFacil') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$icone->nome or old('nome')}}">
            </div>

            <div>
                Display Name
            </div>
            <div>
                <input name="display_name" value="{{$icone->display_name or old('display_name')}}">
            </div>

            <div>
                Selecione um icone
            </div>
            <div>
                <input type="file" name="icone" value="" accept=".jpg, .JPG, .png, .PNG">
            </div>
            <button class="btn btn-success">Enviar</button>

            </form>
    </div>
@endsection