@extends('layouts.app')

@section('content')

    <style>
        body{
            overflow-x: hidden;
        }

        .filters-box{
            background-color: white;
            width: 50vw;
            position: absolute;
            height: 63vh;
            top: 30vh;
            border: solid 2px black;
            padding: 1vw;
        }

        .filter-title{
            font-weight: bold;
            margin-bottom: 5vh;
        }

        .filter{
            display: inline-flex;
            margin-bottom: 1vh;
        }

        .filter-label{
            width: 10vw;
        }

        .filter-input{
            width: 30vw;
        }

        .half-filter-label{
            width: 8vw;
        }

        .half-filter-input{
            width: 17vw;
        }

        .obs-filter-input{
            width: 10vw;
        }

        .filter-buttons{
            left: 25vw;
            position: relative;
            margin-top: 5vh;
        }

        .box-hidden{
            left: 100vw;
            transition: left 1s;
        }

        .box-shown{
            left: 25vw;
            transition: left 1s;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{route('createGed')}}" class="btn btn-success">Anexar Novo Documento</a>
        <a href="#" id="show-filters" class="btn btn-success">Pesquisar</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome do Arquivo</th>
                    <th style="text-align: center;">Observações</th>
                    <th>Ação</th>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                @foreach ($documentos as $documento)
                    <tr>
                        <td>{{$documento->nome_arquivo}}</td>
                        @if(count($documento->observacoes) > 0)
                            <td>
                                @foreach($documento->observacoes as $obs)
                                    {{$obs->valor_observacao}}&nbsp;-&nbsp;
                                @endforeach
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('showGed', $documento->id) }}" target="_blank" class="btn btn-info" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('editGed', $documento->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-toggle="modal" data-target="#modal-excluir" data-ged="{{$documento->id}}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {!! $documentos->appends([
    'nome_arquivo' => Request::get('nome_arquivo'),
    'secretaria' => Request::get('secretaria'),
    'data' => Request::get('data')
    ])->render() !!}

    {{--MODAL DE FILTROS--}}
    <div id="filters-box" class="filters-box box-hidden">
        <p class="filter-title">Localizar Documentos</p>
        <form action="{{route('indexGed')}}" method="get" id="form-filter">
            <div class="filter">
                <div class="filter-label">Nome do Arquivo:</div>
                <select class="filter-input" id="nome_arquivo" name="nome_arquivo" value="{{request('nome_arquivo')}}">
                    <option value="">Selecione um nome de arquivo</option>
                    @foreach($select_nome_arquivo as $nome_arquivo)
                        <option value="{{$nome_arquivo->nome_arquivo}}">{{$nome_arquivo->nome_arquivo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <div class="filter-label">Secretaria:</div>
                <select class="filter-input" id="secretaria" name="secretaria" value="{{request('secretaria')}}">
                    <option value="">Selecione uma secretaria</option>
                    @foreach($select_secretaria as $secretaria)
                        <option value="{{$secretaria->secretaria}}">{{$secretaria->secretaria}}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <div class="filter-label">Data:</div>
                <input class="filter-input" type="date" id="data" name="data" value="{{request('data')}}"/>
            </div>
            <div class="filter">
                <div class="filter-label">Usuário:</div>
                <select class="filter-input" id="nome_usuario" name="nome_usuario" value="{{request('nome_usuario')}}">
                    <option value="">Selecione um usuário</option>
                    @foreach($select_usuario as $usuario)
                        <option value="{{$usuario->nome_usuario}}">{{$usuario->nome_usuario}}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter">
                <div class="half-filter-label">Observação:</div>
                <select class="half-filter-input" id="nome_obs" name="nome_obs" value="{{request('nome_obs')}}">
                    <option value="">Selecione uma observação</option>
                    @foreach($select_obs as $obs)
                        <option value="{{$obs->nome_observacao}}">{{$obs->nome_observacao}}</option>
                    @endforeach
                </select>
                &nbsp;=&nbsp;
                <input type="text" class="obs-filter-input" name="valor_obs" value="{{request('valor_obs')}}"/>
            </div>
            <div class="filter-buttons">
                <button class="btn btn-success" id="btn-search">
                    Pesquisar <i class="glyphicon glyphicon-search"></i>
                </button>
                <a class="btn btn-danger" id="btn-search-clear" title="Remover Filtros">
                    Limpar <i class="glyphicon glyphicon-remove-circle"></i>
                </a>
            </div>
        </form>
    </div>

    {{--MODAL PARA CONFIRMAR EXCLUSÃO DE UM DOCUMENTO--}}
    <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir este arquivo de nossos servidores?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button id="confirmar-exclusao" type="button" class="btn btn-danger">Sim</button>
                </div>
            </div>
        </div>
    </div>

    {{--SCRIPT QUE CUIDA DO MODAL DE EXCLUSÃO--}}
    <script>
        $(document).ready(function(){
            let deleteUrl = "{{route('deleteGed', '?')}}";
            $('#modal-excluir').on('show.bs.modal', function (e) {
                let ged = e.relatedTarget.dataset.ged;
                $('#confirmar-exclusao').data('ged', ged);
            });
            $('#confirmar-exclusao').click(function(){
                let ged = $('#confirmar-exclusao').data('ged');
                deleteUrl = deleteUrl.replace("?", ged);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: deleteUrl,
                    type: 'delete',
                    success: function(data){
                        if (data.message === "success")
                        {
                            alert("Arquivo excluído com sucesso!");
                            location.reload();
                        }
                        else
                            alert("Ocorreu um erro ao excluir o arquivo!");
                    },
                    error: function(err){
                        console.log(err);
                        alert("Não foi possível encontrar o arquivo no servidor!");
                    }
                });
            });
        });
    </script>

    {{--SCRIPT QUE CUIDA DO FILTRO--}}
    <script>
        $(document).ready(function(){
            $('#nome_arquivo').select2();
            $('#secretaria').select2();
            $('#nome_usuario').select2();
            $('#nome_obs').select2();

            $("#show-filters").click(function(){
                $("#filters-box").toggleClass('box-hidden').toggleClass('box-shown');
            });

            $("#btn-search-clear").click(function(e){
                e.preventDefault();
                $("#filters-box").toggleClass('box-hidden').toggleClass('box-shown');

                $("#nome_arquivo").val("");
                $("#secretaria").val("");
                $("#data").val("");
                $("#nome_usuario").val("");
                $("#nome_obs").val("");
                $("#valor_obs").val("");

                $("#form-filter").submit();
            });

            $("#btn-search").click(function(){
                $("#filters-box").toggleClass('box-hidden').toggleClass('box-shown');
            });
        });
    </script>
@endsection