@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createTipoEntulho') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Tipo do Entulho</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tiposEntulho as $tipoEntulho)
                    <tr>
                        <td>{{$tipoEntulho->nome}}</td>
                        <td><a href="{{ route('editTipoEntulho', $tipoEntulho->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection