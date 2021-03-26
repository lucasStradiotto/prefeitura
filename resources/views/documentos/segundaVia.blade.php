@extends('layouts.app')

@section('content')

    {{--<title>{{$title}}</title>--}}

    <div class="container">
        <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
        <div align="center">
            <img src="{{ URL::asset('img/logo_lins.png') }}" class="printImg">
        </div>

        @if ($documento->tipo_documento == "Alvará de Demolição")
            <div align="center" class="printNomeDoc">
                <h4>
                    <b>{{$documento->tipo_documento}} {{$documento->numero_documento}}</b>
                </h4>
            </div>
            <div align="justify">
                <p class="printText">
                    <b>{{$documento->nome_eng}}</b><br>
                    <b>CREA - {{$documento->crea_eng}}</b> - Responsável pela Divisão de Projeto da Prefeitura Municipal de Lins,
                    Estado de São Paulo, CERTIFICA, ao que lhe foi requerido em Petição n° <b>{{$documento->numero_protocolo}}</b>
                    por <b>{{$documento->nome_solicitante}}</b>
                    para
                    os fins de Direito, que não se trata de imóvel de Patrimônio Histórico, <b>autoriza a Demolição</b> de
                    um prédio
                    {{$documento->tipo_predio}} que se encontra edificado à <b>{{$documento->end_rua}}</b>, n° <b>{{$documento->end_numero}}</b>,
                    SETOR <b>{{$documento->end_setor}}</b>, QUADRA <b>{{$documento->end_quadra}}</b>,
                    LOTE <b>{{$documento->end_lote}}</b>. Com área construída de
                    @if ($documento->tipo_predio != "Misto")
                        {{$documento->area_construida}}m².
                    @else
                        {{$documento->metragem_res}}m² Residencial e {{$documento->metragem_com}}m² Comercial
                    @endif
                </p>
            </div>
            <div align="center">
                <h4 class="printDate">
                    Lins, {{$documento->data_emissao->format('d/m/Y')}}<br><br>
                    _____________________________
                </h4>
            </div>
            <div align="center">
                <h5 class="printFooter">
                    <b>Prefeitura Municipal de Lins</b><br>
                    Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                    e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                    {{Auth::user()->name}}
                </h5>
            </div>
        @elseif ($documento->tipo_documento == "Certidão de Construção")
            <div align="center" class="printNomeDoc">
                <h4>
                    <b>{{$documento->tipo_documento}} N.° {{$documento->numero_documento}}</b>
                </h4>
            </div>
            <div align="justify">
                <b>{{$documento->nome_eng}}</b><hr style="border: solid 1px black;">
                <p class="printTextCerCon">
                    <b>CREA - {{$documento->crea_eng}}</b> - Responsável pela Divisão de Projetos, da Prefeitura Municipal de
                    Lins, Estado de São Paulo, <b>CERTIFICA</b>, em virtude do referido despacho do Sr. Prefeito Municipal
                    ao qual
                    lhe foi requerido em Petição <b>n.º {{$documento->numero_protocolo}}</b>
                    para os fins de direito, que se encontra edificado à <b>{{$documento->end_rua}}</b>,
                    <b>n°{{$documento->end_numero}}</b>,
                    SETOR <b>{{$documento->end_setor}}</b>, QUADRA <b>{{$documento->end_quadra}}</b>,
                    LOTE <b>{{$documento->end_lote}}</b>. Conforme matrícula de n° {{$documento->numero_matricula}}, com área construída de
                    @if ($documento->tipo_predio != "Misto")
                        <b>{{$documento->area_construida}}m²</b>,
                    @else
                        <b>{{$documento->metragem_com + $documento->metragem_res}}m²</b>
                    @endif
                    de um prédio {{$documento->tipo_predio}} em {{$documento->tipo_construcao}}, com cobertura de telhas de barro, contendo as seguintes
                    dependências:
                    <br><br>
                    @if ($documento->tipo_predio != "Misto")
                        {{$documento->tipo_predio}}: {{$documento->comodos}}.
                    @else
                        Residencial: {{$documento->comodos_res}}
                        <br>
                        Comercial: {{$documento->comodos_com}}
                    @endif
                    <br><br>
                    Protocolado sob <b>nº {{$documento->numero_protocolo}}</b> às folhas <b>{{$documento->pagina}}</b> do Livro n°
                    <b>{{$documento->livro}}</b>
                    de <b> {{isset($documento->data_inicio) ? $documento->data_inicio->format('d/m/Y') : ''}} </b> de propriedade do(a) Sr.(a)
                    <b>{{$documento->nome_solicitante}}</b>,
                    conforme consta em projeto aprovado de nosso arquivo. O referido é verdade e dá fé. Lins
                    , {{$documento->data_emissao->format('d/m/Y')}}, _____________________________ responsável pela Divisão de Projetos.
                    <br>
                    Req. O mesmo.
                </p>
            </div>

            <div align="center">
                <h4 class="printDateCerCon">
                    Projeto vistado em {{isset($documento->data_fim) ? $documento->data_fim->format('d/m/Y') : '__/__/____'}} com área de:
                    @if ($documento->tipo_predio != "Misto")
                        {{$documento->area_construida}}m²
                    @else
                        {{$documento->metragem_com + $documento->metragem_res}}m²
                    @endif
                    <br>
                    {{$documento->obs}}
                </h4>
            </div>
            <div align="center">
                <h5 class="printFooter">
                    <b>Esta certidão tem validade de seis (6) meses a partir da data de emissão.</b>
                    <br>
                    <br>
                    <b>Prefeitura Municipal de Lins</b><br>
                    Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                    e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </h5>
            </div>
        @elseif ($documento->tipo_documento == "Certidão de Demolição")
            <div align="center" class="printNomeDoc">
                <h4>
                    <b>{{$documento->tipo_documento}} N.° {{$documento->numero_documento}}</b>
                </h4>
            </div>
            <div align="justify">
                <p class="printText">
                    <b>{{$documento->nome_eng}}</b><br>
                    <b>CREA - {{$documento->crea_eng}}</b> - Responsável pela Divisão de Projetos, da Prefeitura Municipal de
                    Lins, Estado de São Paulo, <b>CERTIFICA</b>, em virtude do despacho do Sr. Prefeito Municipal ao qual
                    lhe foi requerido para os fins de direito, que no imóvel situado à
                    <b>{{$documento->end_rua}}</b>, <b>n°{{$documento->end_numero}}</b>,
                    SETOR <b>{{$documento->end_setor}}</b>, QUADRA <b>{{$documento->end_quadra}}</b>,
                    LOTE <b>{{$documento->end_lote}}</b>, de propriedade de <b>{{$documento->nome_solicitante}}</b>, foi demolido uma
                    construção em {{$documento->tipo_construcao}}, com <b>{{$documento->area_construida}}m² demolidos</b>. O referido é verdade e da fé.
                </p>
            </div>
            <div align="center">
                <h4 class="printDate">
                    Lins, {{$documento->data_emissao->format('d/m/Y')}}<br><br>
                    _____________________________, responsável pela Divisão de Projetos.<br><br>
                    Req. O mesmo.
                </h4>
            </div>
            <div align="center">
                <h5 class="printFooter">
                    <b>Prefeitura Municipal de Lins</b><br>
                    Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                    e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                    {{Auth::user()->name}}
                </h5>
            </div>
        @elseif ($documento->tipo_documento == "Habite-se")
            <div align="center" class="printNomeDoc">
                <h4>
                    <b>{{$documento->tipo_documento}} N.° {{$documento->numero_documento}}</b>
                </h4>
            </div>
            <div align="justify">
                <p class="printTextHabitese">
                    <b>{{$documento->nome_eng}}</b><br>
                    <b>CREA - {{$documento->crea_eng}}</b> - responsável pela Divisão de Projetos, da Prefeitura Municipal de
                    Lins, Estado de São Paulo, atendendo ao respeitável despacho proferido pelo Sr. Prefeito Municipal, na
                    petição n° <b>{{$documento->numero_protocolo}}</b> fornece o presente <b>HABITE-SE</b>,
                    a {{$documento->nome_solicitante}}, em virtude de após haver sido efetuada competente vistoria, ter constado
                    que o prédio {{$documento->tipo_predio}} em {{$documento->tipo_construcao}}, constante de várias dependências, situada
                    a <b>{{$documento->end_rua}}, n° {{$documento->end_numero}}</b>,
                    SETOR <b>{{$documento->end_setor}}</b>, QUADRA <b>{{$documento->end_quadra}}</b>, LOTE
                    <b>{{$documento->end_lote}}</b>, nesta cidade, se apresenta nesta data, com os requisitos necessários de
                    habitabilidade e higiene.
                    <br><br>
                    Req. O mesmo.
                    <br><br><br>
                    Projeto aprovado em {{isset($documento->data_fim) ? $documento->data_fim->format('d/m/Y') : ''}} com área de:
                    <b>
                        @if ($documento->tipo_predio != "Misto")
                            Residência: {{$documento->area_construida}}m².
                        @else
                            {{$documento->metragem_res}}m² Residencial e {{$documento->metragem_com}}m² Comercial
                        @endif
                    </b>.
                </p>
            </div>
            <div align="center">
                <h4 class="printDateHabitese">
                    Lins, {{$documento->data_emissao->format('d/m/Y')}}<br><br>
                    _____________________________
                    <br>
                    Responsável pela Divisão de Projetos.<br><br>
                </h4>
            </div>
            <div align="center">
                <h5 class="printFooterHabitese">
                    <b>Esta certidão tem validade de seis (6) meses a partir da data de emissão.</b>
                    <br>
                    <br>
                    <b>Prefeitura Municipal de Lins</b><br>
                    Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                    e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </h5>
            </div>
        @endif
    </div>
    {{--PROVISÓRIO--}}
    <script>
        function printPage() {
            window.print();
        }
    </script>
@endsection
