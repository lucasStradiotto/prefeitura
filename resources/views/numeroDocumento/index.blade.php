@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <a href="{{ route('createNumeroDocumento') }}" class="btn btn-success"> Atribuir</a>
    <table class="table">
        <tr>
            <th>Tipo do Documento</th>
            <th>Próximo Documento</th>
        </tr>
        <tr>
            <td>Alvará de Demolição</td>
            <td>{{ isset($numeros["alvDem"]) ? $numeros["alvDem"]->numero_atual : 1}}</td>
        </tr>
        <tr>
            <td>Certidão de Demolição, Certidão de Construção e Habite-se</td>
            <td>{{ isset($numeros["outros"]) ? $numeros["outros"]->numero_atual : 1}}</td>
        </tr>
        {{--<tr>--}}
            {{--<td>Certidão de Demolição</td>--}}
            {{--<td>{{ isset($numeros["cerDem"]) ? $numeros["cerDem"]->numero_atual : 1}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td>Habite-se</td>--}}
            {{--<td>{{ isset($numeros["habite"]) ? $numeros["habite"]->numero_atual : 1}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td>Certidão de Construção</td>--}}
            {{--<td>{{ isset($numeros["cerCon"]) ? $numeros["cerCon"]->numero_atual : 1}}</td>--}}
        {{--</tr>--}}
    </table>
    <script>
        $(document).ready(function (e) {

        });
    </script>

@endsection
