@extends('layouts.app')

@section('content')
    <style>
        .borda{
            border:solid 2px black;
        }
        .text-center{
            text-align: center
        }
        .width50{
            width: 50%
        }
    </style>
    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            {{--<li><a href="{{ route('indexVerticeCerca') }}">Vértices das Cercas</a></li>--}}
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
        <form class="container" action="{{ route('pointsVerticeCerca') }}" target="_blank">
            <div>
                Cerca
            </div>
            <div>
                <select name="tipo_poligono_id" id="tipo_poligono_id" required>
                    <option value="">Selecione a Cerca</option>
                    @foreach ($poligonos as $poligono)
                        <option value="{{$poligono->id}}">{{$poligono->nome}}</option>
                    @endforeach
                </select>

                <a href="{{ route('createPoligono') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
            <button class="btn btn-success" id="btnEnviar">Escolher Vértices</button>
        </form>
    </div>

    <script>

    </script>
@endsection