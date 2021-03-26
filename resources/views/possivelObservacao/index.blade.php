@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createPossivelObservacao') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Secretaria</th>
                    <th>Ação</th>
                </tr>
                @foreach ($observacoes as $observacao)
                    <tr>
                        <td>{{$observacao->nome_observacao}}</td>
                        <td>{{$observacao->secretaria->nome}}</td>
                        <td><a href="{{ route('editPossivelObservacao', $observacao->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $observacoes->links() !!}
    </div>
@endsection