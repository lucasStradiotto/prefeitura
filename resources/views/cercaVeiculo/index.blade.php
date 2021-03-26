@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createCercaVeiculo') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Veículo</th>
                    <th>Cerca</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Evento</th>
                    <th>Ação</th>
                </tr>
                @foreach ($cercasVeiculos as $cerca)
                    <tr>
                        @foreach($veiculos as $veiculo)
                            @if ($veiculo->id == $cerca->veiculo_id)
                                <td>{{$veiculo->placa}}</td>
                            @endif
                        @endforeach
                        @foreach($cercasEletronicas as $cercaEletronica)
                            @if ($cercaEletronica->id == $cerca->cerca_id)
                                <td>{{$cercaEletronica->nome}}</td>
                            @endif
                        @endforeach
                        <td>{{Carbon\Carbon::parse($cerca->data_inicio)->format('d/m/Y H:i')}}</td>
                        <td>{{Carbon\Carbon::parse($cerca->data_fim)->format('d/m/Y H:i')}}</td>
                        <td>
                            @if($cerca->acao == 2)
                                Entrada em Cerca
                            @elseif($cerca->acao == 5)
                                Saída de Cerca
                            @endif
                        </td>
                        <td><a href="{{ route('editCercaVeiculo', $cerca->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection