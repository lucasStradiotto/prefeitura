@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <div>
            <table class="table">
                <tr>
                    <th>Solicitação</th>
                    <th>Nome do Solicitante</th>
                    <th>Telefone do Solicitante</th>
                    <th>Endereço</th>
                    <th>Ação</th>
                </tr>
                @foreach ($solicitacoes as $solicitacao)
                    <tr>
                        <td>{{$solicitacao->tipo_solicitacao}}</td>
                        <td>{{$solicitacao->nome_solicitante}}</td>
                        <td>{{$solicitacao->telefone_solicitante}}</td>
                        <td>{{$solicitacao->endereco}}</td>
                        <td><a href="{{ route('detailsSolicitacaoPodaRetirada', $solicitacao->id) }}"
                               class="btn btn-info" title="Detalhes"> <i class="glyphicon glyphicon-search"></i>
                        </a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $solicitacoes->links() !!}
    </div>
@endsection