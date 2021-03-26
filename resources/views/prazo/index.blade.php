@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home_entulho') }}">Parâmetros</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <a href="{{ route('createPrazo') }}" class="btn btn-success"> Atribuir</a>
    <table class="table">
        <tr>
            <td>Prazo</td>
            <td>{{ isset($prazo) ? $prazo->prazo : 0}}</td>
        </tr>
    </table>
    <script>
        $(document).ready(function (e) {

        });
    </script>

@endsection
