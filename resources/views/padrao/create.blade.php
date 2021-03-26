@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexPadrao') }}">Padrões</a></li>
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
        @if(isset($padrao))
            <form class="container" method="post" action="{{ route('updatePadrao', $padrao->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storePadrao') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$padrao->nome or old('nome')}}">
                        </div>
                        <div>
                            Tipo de Padrão
                        </div>
                        <div>
                            <select name="tipo_padrao_id" id="slcTipoPadrao">
                                <option value="0">Selecione o tipo de Padrão</option>
                                @foreach ($tiposPadrao as $tipoPadrao)
                                    <option value="{{$tipoPadrao->id}}"
                                            @if (isset($padrao))
                                                @if ($tipoPadrao->id == $padrao->tipo_padrao_id)
                                                   selected
                                                @endif
                                            @endif
                                    >{{$tipoPadrao->nome}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createTipoPadroes') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection