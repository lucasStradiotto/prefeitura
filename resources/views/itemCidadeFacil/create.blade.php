@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexItemCidadeFacil') }}">Itens Cidade Fácil</a></li>
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
        @if(isset($item))
            <form class="container" method="post" action="{{ route('updateItemCidadeFacil', $item->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeItemCidadeFacil') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$item->nome or old('nome')}}">
            </div>
            <div>
                Display Name
            </div>
            <div>
                <input name="display_name" value="{{$item->display_name or old('display_name')}}">
            </div>
            <div>
                Description
            </div>
            <div>
                <input name="description" value="{{$item->description or old('description')}}">
            </div>
            <button class="btn btn-success">Enviar</button>

            </form>
    </div>
@endsection