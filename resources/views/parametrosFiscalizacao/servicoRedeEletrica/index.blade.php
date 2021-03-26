@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('servicoRedeEletrica.create') }}" class="btn btn-success">Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Rede Elétrica</th>
                    <th>Ação</th>
                </tr>
                @foreach ($servicosEletrica as $servico)
                    <tr>
                        <td>{{$servico->tipo_rede_eletrica}}</td>
                        <td>
                            <a href="{{ route('servicoRedeEletrica.edit', array($servico->tipo_rede_eletrica, $servico->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('servicoRedeEletrica.delete', array($servico->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($servicosEletrica) > 9)
            {{ $servicosEletrica->links() }}
        @endif
    </div>
@endsection