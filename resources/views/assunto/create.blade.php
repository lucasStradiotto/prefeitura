@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexAssunto') }}">Assuntos</a></li>
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
        @if(isset($assunto))
            <form class="container" method="post" action="{{ route('updateAssunto', $assunto->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeAssunto') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$assunto->nome or old('nome')}}">
            </div>
            <div>
                Grupo
            </div>
            <div>
                <select name="tipo_assunto_id">
                    <option value="">Selecione o grupo do Assunto</option>
                    @foreach ($tiposAssuntos as $tiposAssunto)
                        <option value="{{$tiposAssunto->id}}"
                        @if (isset($assunto))
                            @if ($tiposAssunto->id == $assunto->tipo_assunto_id)
                            selected
                            @endif
                        @endif
                        >{{$tiposAssunto->grupo}}</option>
                    @endforeach
                </select>
                <a href="{{ route('createTipoAssunto') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <button class="btn btn-success">Enviar</button>
            </form>
    </div>
@endsection