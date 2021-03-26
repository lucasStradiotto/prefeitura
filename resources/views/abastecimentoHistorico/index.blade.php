@extends('layouts.app')
@section('content')

    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
        @if(isset($histabast))
            <table class="table tablemedia" id="lista" name="lista">
                <thead>
                    <th>
                        Tipo de Combustível
                    </th>
                    <th>
                        Motorista
                    </th>
                    <th>
                        Valor Unitário
                    </th>
                    <th>
                        Litros Abastecidos
                    </th>
                    <th>
                        Kilometragem ao Abastecer
                    </th>
                    <th>
                        Data
                    </th>
                    <th>
                        Gerar Autorização
                    </th>
                </thead>
                @foreach($histabast as $historico)
                <tr>
                    <td>{{$historico->tipo_combustivel}}</td>
                    <td>{{$historico->motorista}}</td>
                    <td>{{$historico->valor_unitario}}</td>
                    <td>{{$historico->litros}}</td>
                    <td>{{$historico->kilometragem}}</td>
                    <td>{{$historico->data->format('d/m/Y')}}</td>
                    <td>
                        <a href="{{ route('autorizacaoAbastecimento', $historico->id) }}" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-duplicate"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>

        @endif

    <script>
        $(document).ready(function () {

        });
    </script>
@endsection