@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createEstagiario') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Estagiario</th>
                    <th>Ação</th>
                </tr>
                @foreach ($estagiarios as $estagiario)
                <tr>
                    <td>{{$estagiario->nome}}</td>
                    <td><a href="{{ route('editEstagiario', $estagiario->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $estagiarios->links() !!}
    </div>
@endsection