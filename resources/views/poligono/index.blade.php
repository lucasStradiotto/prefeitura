@extends('layouts.app')

@section('content')
    <style>
        .center{
            text-align: center;
        }
        .red{
            color: red;
        }
        .green{
            color: green;
        }
    </style>

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createPoligono') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th class="center">Número</th>
                    <th class="center">Gera Notificação</th>
                    <th class="center">Área de Risco</th>
                    <th>Ação</th>
                </tr>
                @foreach ($poligonos as $poligono)
                    <tr>
                        <td>{{$poligono->nome}}</td>
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $poligono->tipo_poligono_id)
                                <td class="center">{{$tipo->nome}}</td>
                            @endif
                        @endforeach
                        <td  class="center">{{$poligono->cerca_numero}}</td>
                        <td class="center">
                            @if ($poligono->cerca_gera_notificacao == 1)
                                <i class="glyphicon glyphicon-ok green"></i>
                            @else
                                <i class="glyphicon glyphicon-remove red"></i>
                            @endif
                        </td>
                        <td class="center">
                            @if ($poligono->cerca_area_risco == 1)
                                <i class="glyphicon glyphicon-ok green"></i>
                            @else
                                <i class="glyphicon glyphicon-remove red"></i>
                            @endif
                        </td>
                        <td><a href="{{ route('editPoligono', $poligono->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $poligonos->links() !!}
    </div>
@endsection