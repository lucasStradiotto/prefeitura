@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexFrentista') }}">Frentistas</a></li>
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
        @if(isset($frentista))
            <form class="container" method="post" action="{{ route('updateFrentista', $frentista->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeFrentista') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$frentista->nome or old('nome')}}">
                        </div>
                        <div>
                            Posto
                        </div>
                        <div>
                            <select name="posto_id">
                                @foreach($postos as $post)
                                    @if(isset($frentista))
                                        @if($post->id == $frentista->posto_id)
                                            <option value="{{$post->id}}" selected>{{$post->nome}}</option>
                                        @else
                                            <option value="{{$post->id}}">{{$post->nome}}</option>
                                        @endif
                                    @else
                                        <option value="{{$post->id}}">{{$post->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{--Senha
                        <div>
                            <input name="senha" value="{{$frentista->senha or old('senha')}}">
                        </div>--}}
                        <button class="btn btn-success">Enviar</button>
                    </form>
    </div>
@endsection