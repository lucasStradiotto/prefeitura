@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Obras</div>
                @if(isset($msg))
                <input type="hidden" class="error" value="{{$msg}}">
                @endif
                <div class="panel-body">
                    <p>
                        <a class="btn btn-success" href="{{route('indexTipoAssunto')}}">Cadastrar Grupo de
                            Assuntos
                        </a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexExtintor')}}">Extintores
                        </a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexAssunto')}}">Cadastrar Novo Assunto</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexStatus')}}">Cadastrar Novo Status</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexEstagiario')}}">Cadastrar Novo Estagiário</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexEngenheiro')}}">Cadastrar Novo Engenheiro</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexSecretaria')}}">Cadastrar Secretaria</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexDespesaSetores')}}">Cadastrar Subsetor</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexNumeroDocumento')}}">Atribuir Número de
                            Documentos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexProtocolo')}}">Exibir Protocolos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('listagemDocumentos')}}">Listar Documentos Gerados</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexResponsavel')}}">Cadastrar Responsável</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexRelatorios')}}">Gerar Relatório</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('closeOrdemColeta')}}">Fechar Ordens de Coleta</a>
                    </p>
                    @if(isset($desenvolvedor) && $desenvolvedor)
                    <p>
                        <a class="btn btn-success" href="{{route('perfil.index')}}">Perfil</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('permissao.index')}}">Permissão</a>
                    </p>
                    @endif
                    <p>
                        <a class="btn btn-success" href="{{route('veiculosRpm')}}">RPM</a>
                    </p>
                    <p>
                        <form action="{{route('indexAtualizarStatus')}}">
                            <button class="btn btn-success">Atualizar Status</button>
                        </form>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexHorarioProgramado')}}">Horários
                            Programados</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexPoligono')}}">Poligonos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexCercaVeiculo')}}">Cercas/Veículos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexRotaVeiculo')}}">Rotas/Veículos</a>
                    </p>

                    <p>
                        <a class="btn btn-success" href="{{route('showVerticeCerca')}}">Cadastrar Vértices dos
                            Polígonos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexProdutividade')}}">Mostrar Índice de
                            Produtividade</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexGrafico')}}">Gestão</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexSetorProtocolo')}}">Cadastrar Setores</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexPosto')}}">Postos de Gasolina</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('veiculocotasindex')}}">Cotas de Combustivel Veiculos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexParametrosFiscalizacao')}}">Parâmetros Fiscalização Obras</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexVistoriaObras')}}">Relatório de Vistoria de Obras</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexGed')}}">Gerenciamento Eletrônico de Documentos</a>
                    </p>
                    <p>
                        <a class="btn btn-success" href="{{route('indexObraPublicaStatus')}}">Cadastrar Status de Obra Pública</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
{{--TRATAR ERROS DE PERMISSÃO DE ACESSO--}}
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script>
    // $(document).ready(function () {
    //     var error = document.getElementsByClassName('error');
    //     if(error.length > 0){
    //         var typeError = error[0].value;
    //         if (typeError == 403) {
    //             sweetAlert({
    //                 title: "Acesso Negado!",
    //                 text: "O usuário não possui permissão para acessar a página. Contate o administrador.",
    //                 icon: "error",
    //                 closeOnClickOutside: false,
    //                 showConfirmButton: false,
    //                 buttons: {
    //                     catch: {
    //                         text: 'Ok',
    //                         value: "ok",
    //                     },
    //                 },
    //             })
    //         }
    //     }
    // });
    $(document).ready(function() {
        window.close();
    });
</script>
@endsection