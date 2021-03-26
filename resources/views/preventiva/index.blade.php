@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createPreventiva') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Placa</th>
                    <th>Tipo de Preventiva</th>
                    <th>Intervalo</th>
                    <th>Unidade</th>
                    <th>Ação</th>
                </tr>
                @foreach ($preventivas as $preventiva)
                    <tr>
                        @foreach($veiculos as $veiculo)
                            @if ($veiculo->id == $preventiva->veiculo_id)
                                <td>{{$veiculo->placa}}</td>
                            @endif
                        @endforeach
                        @foreach($tiposPreventiva as $tipoPreventiva)
                            @if ($tipoPreventiva->id == $preventiva->tipo_preventiva_id)
                                <td>{{$tipoPreventiva->nome}}</td>
                            @endif
                        @endforeach
                        <td>{{$preventiva->intervalo}}</td>
                            @foreach($unidadesIntervalo as $unidadeIntervalo)
                                @if ($unidadeIntervalo->id == $preventiva->unidade_intervalo_id)
                                    <td>{{$unidadeIntervalo->nome}}</td>
                                @endif
                            @endforeach
                        <td><a href="{{ route('editPreventiva', $preventiva->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection