@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createPadrao') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Padrão</th>
                    <th>Ação</th>
                </tr>
                @foreach ($padroes as $padrao)
                    <tr>
                        <td>{{$padrao->nome}}</td>
                        <td><a href="{{ route('editPadrao', $padrao->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $padroes->links() !!}
    </div>
@endsection