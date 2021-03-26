@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexPoligono') }}">Poligonos</a></li>
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
        @if(isset($poligono))
            <form class="container" method="post" action="{{ route('updatePoligono', $poligono->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storePoligono') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Tipo do Polígono
            </div>
            <div>
                <select name="tipo_poligono_id">
                    <option value="">Selecione o Tipo do Poligono.</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                Nome
            </div>
            <div>
                <input name="nome" value="{{$poligono->nome or old('nome')}}">
            </div>
            <div>
                Número
            </div>
            <div>
                <input name="cerca_numero" value="{{$poligono->cerca_numero or old('cerca_numero')}}">
            </div>
            <div>
                Gera Notificação
            </div>
            <div>
                <input type="checkbox" name="cerca_gera_notificacao">
            </div>
            <div>
                Área de Risco
            </div>
            <div>
                <input type="checkbox" name="cerca_area_risco">
            </div>

            <button class="btn btn-success" id="btnEnviar">Enviar</button>
        </form>
    </div>
@endsection