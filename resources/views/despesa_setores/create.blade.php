@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexDespesaSetores') }}">Setores</a></li>
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
        @if(isset($setor))
            <form class="container" method="post" action="{{ route('updateDespesaSetores', $setor->id) }}">
            {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeDespesaSetores') }}">
                @endif
                {!! csrf_field() !!}
                <div>
                    Nome
                </div>
                <div>
                    <input name="nome" value="{{$setor->nome or old('nome')}}">
                </div>
                <div>
                    Secretaria
                </div>
                <div>
                    <select name="secretaria_id">
                        <option value="0">Selecione a Secretaria</option>
                        @foreach($secretarias as $secretaria)
                            <option value="{{$secretaria->id}}"
                                {{old('secretaria_id') == $secretaria->id ? 'selected' : ''}}
                                @if (isset($setor) && $secretaria->id == $setor->secretaria_id)
                                    selected
                                @endif
                            >{{$secretaria->nome}}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('createSecretaria') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <button class="btn btn-success">Enviar</button>
            </form>
    </div>

@endsection