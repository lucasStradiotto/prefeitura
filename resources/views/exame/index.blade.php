@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createExame') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Exame</th>
                    <th>Tipo de Padrão</th>
                    <th>Padrão Esperado</th>
                    <th>Não Esperado</th>
                    <th>Mínimo Esperado</th>
                    <th>Máximo Esperado</th>
                    <th>Ação</th>
                </tr>
                @foreach ($exames as $exame)
                    <tr>
                        <td>{{$exame->nome}}</td>
                        @foreach($tiposPadrao as $tipoPadrao)
                            @if($tipoPadrao->id == $exame->tipo_padroes_id)
                                <td>{{$tipoPadrao->nome}}</td>
                            @endif
                        @endforeach
                        @foreach($padroes as $padrao)
                            @if($padrao->id == $exame->padrao_esperado_id)
                                <td>{{$padrao->nome}}</td>
                                @break
                            @elseif($exame->padrao_esperado_id == null)
                                <td>N/A</td>
                                @break
                            @endif
                        @endforeach
                        @foreach($padroes as $padrao)
                            @if($padrao->id == $exame->padrao_nao_esperado_id)
                                <td>{{$padrao->nome}}</td>
                                @break
                            @elseif($exame->padrao_nao_esperado_id == null)
                                <td>N/A</td>
                                @break
                            @endif
                        @endforeach
                        @foreach($padroes as $padrao)
                            @if($padrao->id == $exame->min_esperado_id)
                                <td>{{$padrao->nome}}</td>
                                @break
                            @elseif($exame->max_esperado_id == null)
                                <td>N/A</td>
                                @break
                            @endif
                        @endforeach
                        @foreach($padroes as $padrao)
                            @if($padrao->id == $exame->max_esperado_id)
                                <td>{{$padrao->nome}}</td>
                                @break
                            @elseif($exame->min_esperado_id == null)
                                <td>N/A</td>
                                @break
                            @endif
                        @endforeach
                        <td><a href="{{ route('editExame', $exame->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $exames->links() !!}
    </div>
@endsection