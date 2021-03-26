@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createSetorProtocolo') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
                @foreach ($setores as $setor)
                <tr>
                    <td>{{$setor->nome}}</td>
                    <td><a href="{{ route('editSetorProtocolo', $setor->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $setores->links() !!}
    </div>
@endsection