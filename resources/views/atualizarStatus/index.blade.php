@extends('layouts.app')

@section('content')

    {{--PROVISÓRIO--}}
    <style>
        th,td{
            font-size: 0.6em;
            font-weight: 700;
        }

        /*.aprovado{*/
        /*    background-color: #bcffc7;*/
        /*}*/

        /*.reprovado{*/
        /*    background-color: #ffc9c4;*/
        /*}*/

    </style>

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <div class="container">
        <h2>Filtro</h2>
        <form action="{{route('indexAtualizarStatus')}}">
            <select name="status" id="status" value="{{request('status')}}">
                @foreach($statusToSelect as $stat)
                    <option value="{{$stat->nome}}"
                            @if (isset($stat) && !emptyArray($protocolos) && $protocolos->first()->status == $stat->nome)
                            selected
                            @endif
                    >{{$stat->nome}}</option>
                @endforeach
            </select>
            <button class="btn btn-success" title="Filtrar"><i class="glyphicon glyphicon-filter"></i></button>
            <a href="{{ route('indexAtualizarStatus') }}" class="btn btn-danger" title="Limpar Filtro"><i class="glyphicon glyphicon-remove-circle"></i></a>
        </form>

        <h1>Protocolos</h1>
        <div style="overflow-x: scroll">
            <div>
                <table class="table">
                    <tr>
                        <th>L</th>
                        <th>Início</th>
                        <th>Assunto</th>
                        <th>Proprietário</th>
                        <th>Endereço</th>
                        <th>M²</th>
                        <th>Responsável</th>
                        <th>Status</th>
                        <th>Fim</th>
                        <th>ProtF</th>
                        <th>Taxa</th>
                        <th>Ação</th>
                    </tr>
                    @foreach ($protocolos as $protocolo)
                        <tr style="background-color: {{$protocolo->cor}}">
                            <td>{{$protocolo->l}}</td>
                            <td>{{$protocolo->data_inicio->format('d/m/Y')}}</td>
                            <td>{{$protocolo->assunto}}</td>
                            <td>
                                {{$protocolo->proprietario}}
                                @if (isset($protocolo->proprietario_email))
                                    ({{$protocolo->proprietario_email}})
                                @endif
                            </td>
                            <td>{{$protocolo->endereco}}</td>
                            <td>{{str_replace('.', ',', $protocolo->m2)}}</td>
                            <td>
                                {{$protocolo->responsavel}}
                                @if (isset($protocolo->responsavel_email))
                                    ({{$protocolo->responsavel_email}})
                                @endif
                            </td>
                            <td>{{$protocolo->status}}<br>
                                @if(isset($protocolo->observacaoStatus))
                                    ({{$protocolo->observacaoStatus}})
                                @endif</td>
                            <td>{{isset($protocolo->data_fim) ? $protocolo->data_fim->format('d/m/Y') : ''}}</td>
                            <td>{{$protocolo->protF}}</td>
                            <td>R$ {{str_replace('.', ',', $protocolo->taxa)}}</td>
                            <td class="row">
                                <a href="{{route('editAtualizarStatus', $protocolo->id)}}" title="Editar"
                                   class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                @foreach($anexos as $anexo)
                                    @if ($protocolo->id == $anexo->protocolo_id)
                                        <a href="{{route('indexAnexarDocumento', $protocolo->id)}}" title="Exibir Anexos"
                                           class="btn btn-primary"><i class="glyphicon glyphicon-picture"></i></a>
                                        @break
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {!! $protocolos->appends(['status' => Request::get('status')])->render() !!}
    </div>

    <script>
        $(document).ready(function() {
            $("select").select2();
        });
    </script>
@endsection

