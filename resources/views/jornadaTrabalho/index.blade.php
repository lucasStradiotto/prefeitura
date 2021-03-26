@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createJornadaTrabalho') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Ação</th>
                </tr>
                @foreach ($jornadasTrabalho as $jornada)
                    <tr>
                        <td>{{$jornada->inicio}}</td>
                        <td>{{$jornada->fim}}</td>
                        <td><a href="{{ route('editJornadaTrabalho', $jornada->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection