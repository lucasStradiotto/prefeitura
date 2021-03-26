@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Parâmetros Fiscalização</div>
                    @if(isset($msg))
                        <input type="hidden" class="error" value="{{$msg}}">
                    @endif
                    <div class="panel-body">

                        <p>
                            <a class="btn btn-success" href="{{route('revestexterno.index')}}">Revestimento Externo</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('revestinterno.index')}}">Revestimento Interno</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('pinturaExt.index')}}">Pintura Externa</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('pinturaInt.index')}}">Pintura Interna</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('pisoExterno.index')}}">Piso Externo</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('pisoInterno.index')}}">Piso Interno</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('catProprietario.index')}}">Categoria Proprietário</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('melhorias.index')}}">Melhorias</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('servicoRedeEletrica.index')}}">Serviços de Rede Elétrica</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('servicoEsgoto.index')}}">Serviços de Esgoto</a>
                        </p>

                        <p>
                            <a class="btn btn-success" href="{{route('numeroPavimento.index')}}">Número de Pavimento</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('abastecimentoAgua.index')}}">Abastecimento de Água</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexForro')}}">Forro</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEsquadriaPorta')}}">Esquadria Porta</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEsquadriaJanela')}}">Esquadria Janela</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPinturaEsquadria')}}">Pintura Esquadria</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexInstalEletrica')}}">Instalação Elétrica</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexInstalSanitaria')}}">Instalação Sanitária</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEstrutura')}}">Estrutura</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEstruturaTelhado')}}">Estrutura Telhado</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCobertura')}}">Cobertura</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexElevador')}}">Elevador</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexSituacaoConstrucao')}}">Situação Construção</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexLocalizacaoVertical')}}">Localização Vertical</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexAcabamento')}}">Acabamento</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCasaAlinhada')}}">Casa Alinhada</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCasaRecuada')}}">Casa Recuada</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEscritorio')}}">Escritório</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexComercio')}}">Comércio</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexEstadoConservacao')}}">Estado Conservação</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCategoria')}}">Categoria</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexFormaTerreno')}}">Forma Terreno</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexSituacaoTerreno')}}">Situação Terreno</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexUsoTerreno')}}">Uso Terreno</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexProtecaoCalcada')}}">Proteção Calçada</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPedologiaTerreno')}}">Pedologia Terreno</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexTopografiaTerreno')}}">Topografia Terreno</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection