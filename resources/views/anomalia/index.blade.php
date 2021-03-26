@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createAnomalia') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Prazo</th>
                    <th>Ação</th>
                </tr>
                @foreach ($anomalias as $anomalia)
                <tr>
                    <td>{{$anomalia->nome}}</td>
                    <td>{{$anomalia->prazo}}</td>
                    <td><a href="{{ route('editAnomalia', $anomalia->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $anomalias->links() !!}
    </div>
@endsection