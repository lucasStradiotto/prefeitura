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
        
        .disabled{
            display: none;
        }

        .scrollable{
            overflow-x: scroll;
        }

        .search-box{
            margin-top: 10px;
            text-align: right;
        }

    </style>

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (\Illuminate\Support\Facades\Auth::user()->hasRole('protocolos-obras'))
            <a href="{{ route('createProtocolo') }}" class="btn btn-success">Novo</a>
        @endif
        <div class="search-box">
            <form action="{{route('indexProtocolo')}}" method="get" id="form-filter">
                Filtrar:
                <input type="text" id="txt-search" name="filter" value="{{request('filter')}}"/>
                <button class="btn btn-success" id="btn-search">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                <a class="btn btn-danger" id="btn-search-clear" title="Remover Filtros">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                </a>
            </form>
        </div>
        <div class="scrollable">
            <div>
                <table class="table">
                    <tr id="tr-header">
                        <th>L</th>
                        <th>Setor do Protocolo</th>
                        <th>Início</th>
                        <th>Assunto</th>
                        <th>Proprietário</th>
                        <th>Endereço</th>
                        <th>SQL</th>
                        <th>M²</th>
                        <th>Responsável</th>
                        <th>Status</th>
                        <th>Fim</th>
                        <th>ProtF</th>
                        <th>Taxa</th>
                        <th colspan="2" style="text-align: center">Ação</th>
                    </tr>
                    @foreach ($protocolos as $protocolo)
                        <tr style="background-color: {{$protocolo->cor}}">
                            <td>{{$protocolo->l}}</td>
                            <td>
                                @foreach($setoresProtocolo as $setorProtocolo)
                                    @if($setorProtocolo->id == $protocolo->setor_protocolo)
                                        {{$setorProtocolo->nome}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{isset($protocolo->data_inicio) ? $protocolo->data_inicio->format('d/m/Y') : ''}}</td>
                            <td>{{$protocolo->assunto}}</td>
                            <td>
                                {{$protocolo->proprietario}}
                                @if (isset($protocolo->proprietario_email))
                                    ({{$protocolo->proprietario_email}})
                                @endif
                            </td>
                            <td>
                                {{$protocolo->endereco}},
                                {{$protocolo->numero}}
                            </td>
                            <td>
                                {{$protocolo->setor}}-{{$protocolo->quadra}}-{{$protocolo->lote}}
                            </td>
                            <td>{{str_replace('.', ',', $protocolo->m2)}}</td>
                            <td>
                                {{$protocolo->responsavel}}
                                @if (isset($protocolo->responsavel_email))
                                    ({{$protocolo->responsavel_email}})
                                @endif
                            </td>
                            <td>{{$protocolo->status}}<br>
                                @if(isset($protocolo->dataStatus))
                                    ({{$protocolo->dataStatus->format('d/m/Y')}})
                                @endif
                                @if(isset($protocolo->observacaoStatus))
                                    <br>obs: {{$protocolo->observacaoStatus}}
                                @endif
                            </td>
                            <td>{{isset($protocolo->data_fim) ? $protocolo->data_fim->format('d/m/Y') : ''}}</td>
                            <td>{{$protocolo->protF}}</td>
                            <td>
                                @if (isset($protocolo->taxa)) R$ @endif
                                    {{str_replace('.', ',', $protocolo->taxa)}}
                            </td>
                            @if (\Illuminate\Support\Facades\Auth::user()->hasRole('protocolos-obras'))
                            <td class="row">
                                <a href="{{ route('editProtocolo', $protocolo->id) }}"
                                   class="btn btn-warning" title="Editar">
                                    <i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('indexDocumentos', $protocolo->id) }}"
                                   @if((preg_match('/^Comunique*/', $protocolo->status)) ||
                                   (preg_match('/^Reprovado*/', $protocolo->status)) ||
                                   (preg_match('/^Pendencia*/', $protocolo->status)) ||
                                   (preg_match('/^Pendência*/', $protocolo->status)))
                                        class="btn btn-success disabled"
                                   @else
                                        class="btn btn-success"
                                   @endif
                                   title="Gerar Documento">
                                    <i class="glyphicon glyphicon-plus"></i></a>
                            </td>
                            @endif
                            <td class="row">
                                @if (\Illuminate\Support\Facades\Auth::user()->hasRole('protocolos-obras'))
                                    <a href="{{ route('indexAnexarDocumento', $protocolo->id) }}"
                                       class="btn btn-primary" title="Anexar Documento">
                                        <i class="glyphicon glyphicon-paperclip"></i></a>
                                @endif
                                @foreach($anexos as $anexo)
                                    @if ($protocolo->id == $anexo->protocolo_id)
                                        <a href="{{route('indexAnexarDocumento', $protocolo->id)}}" title="Exibir Anexos"
                                           class="btn btn-primary"><i class="glyphicon glyphicon-picture"></i></a>
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td class="row btn-vistoria" id="btn-vistoria-{{$protocolo->id}}"></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {!! $protocolos->appends(['filter' => Request::get('filter')])->render() !!}
    </div>
    <script>
        $(document).ready(function () {
            var $txtSearch = $("#txt-search");
            $txtSearch.select();

            $("#btn-search-clear").click(function(e){
                e.preventDefault();
                $txtSearch.val("");
                $("#form-filter").submit();
            });

            let protocolos = $('.btn-vistoria');
            for (let i=0; i<protocolos.length; i++)
            {
                let protocolo = protocolos[i];
                let div_id = protocolo.id;
                let protocolo_id = div_id.split("-")[2];
                $.getJSON("{{route('getVistoriaByProtocolo')}}", {
                    protocolo_id: protocolo_id
                }, function(data){
                    if (data.status == "true")
                    {
                        let url = "{{route('openVistoriaProtocolo', '?')}}";
                        url = url.replace("?", protocolo_id);
                        let toAppend = '<a href="'+url+'"';
                        toAppend += 'class="btn btn-info" title="Vistoria">';
                        toAppend += '<i class="glyphicon glyphicon-list-alt"></i></a>';
                        $("#"+div_id).empty().append(toAppend);
                    }
                }).catch(err => {
                    console.log('erro ao getVistoriaByProtocolo', err);
                });
            }
        });
    </script>
@endsection