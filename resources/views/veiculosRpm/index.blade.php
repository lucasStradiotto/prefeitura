@extends('layouts.app')

@section('content')

<title>{{$title}}</title>

<div class="container">
    <ul class="breadcrumb">
        <li class="active">{{ $title }}</li>
    </ul>
    <div style="margin-bottom: 15px;">
        <a href="{{ route('createVeiculosRpm') }}" class="btn btn-success">Novo</a>
    </div>
    <div>
        <table class="table">
            <tr>
                <th>Veículo (Placa)</th>
                <th>Rpm Padrão</th>
                <th>Ação</th>
            </tr>
            @foreach ($veiculosRpm as $veiculoRpm)
                <tr>
                    <td>
                        @foreach($veiculosPlacas as $veiculoPlaca)
                            @if($veiculoRpm->veiculo_id == $veiculoPlaca->id)
                                {{$veiculoPlaca->placa}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($veiculoRpm->rpm == NULL)
                            <strong>Rpm não especificado</strong>
                        @else
                            {{$veiculoRpm->rpm}}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('updateVeiculosRpm', $veiculoRpm->veiculo_id)}}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection