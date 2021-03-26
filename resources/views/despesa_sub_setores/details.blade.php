@extends('layouts.app')

@section('content')
    <style>
        dt{
            float:left;
        }
    </style>
    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexDespesaSubSetores') }}">Sub Setores</a></li>
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
    @if(isset($subSetor))
        <div>
            <dl>
                <dt>Sub Setor:</dt>
                <dd>&nbsp{{$subSetor->nome}}</dd>
                <dt>Setor:</dt>
                @if(isset($setor))
                    <dd>&nbsp{{$setor->nome}}</dd>
                @else
                    <dd>&nbsp</dd>
                @endif
            </dl>
        </div>
    @endif
    <a href="{{route('indexDespesaSubSetores')}}" class="btn btn-danger">Voltar</a>

@endsection