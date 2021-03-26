@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createResponsavel') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
                @foreach ($responsaveis as $responsavel)
                    <tr>
                        <td>{{$responsavel->nome}}</td>
                        <td>{{$responsavel->email}}</td>
                        <td><a href="{{ route('editResponsavel', $responsavel->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $responsaveis->links() !!}
    </div>
@endsection