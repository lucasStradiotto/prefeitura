@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">Permissão</li>
        </ul>
        <a href="{{ route('permissao.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Nome Extenso</th>
                    <th>Descrição</th>
                    <th></th>
                </tr>
                @foreach($permissoes as $permissao)
                    <tr>
                        <td>{{ $permissao->name }}</td>
                        <td>{{ $permissao->display_name }}</td>
                        <td>{{ $permissao->description }}</td>
                        <td>
                            <a href="{{ route('permissao.edit', $permissao->id) }}" class="btn btn-warning" title="Editar">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {!! $permissoes->links() !!}
@endsection