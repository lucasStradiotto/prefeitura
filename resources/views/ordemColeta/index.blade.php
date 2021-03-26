@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createOrdemColeta') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome Do Solicitante</th>
                    <th>Ação</th>
                </tr>
                @foreach ($ordensColeta as $ordemColeta)
                    <tr>
                        <td>{{$ordemColeta->nome_solicitante}}</td>
                        <td><a href="{{ route('editOrdemColeta', $ordemColeta->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection