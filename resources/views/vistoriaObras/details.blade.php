@extends('layouts.app')

@section('content')

    <style>
        .no-print{
            margin-bottom: 10vh;
        }

        .container{
            width: 80vw;
        }

        /*HEADER*/

        .logo-container{
            float: left;
            width: 50%;
        }

        .logo{
            width: 130px; /*390px;*/
            height: 115px; /*346px;*/
            float: left;
            margin-top: -1vh;
        }

        .pref-info{
            float: left;
            margin-left: 5vw;
            text-align: center;
            font-weight: bold;
        }

        .grid-container-header {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto auto auto;
        }

        .grid-container-header > div{
            font-size: 0.8em;
        }

        .header-info{
            float: left;
            margin-left: 2vw;
            width: 45%;
        }

        .grid-item-header {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 0.1vw;
            font-size: 1em;
            text-align: center;
        }

        .gray-background{
            background-color: #c4c6c5 !important;
            font-weight: bold;
        }

        /*FIM HEADER*/

        /*BODY*/

        .body{
            display: inline-flex;
            width: 100%;
            margin-top: 5vh;
        }

        .grid-container-body {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto auto;
            width: 100%;
        }

        .grid-item-body {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 0.1vw;
            font-size: 1em;
            text-align: left;
        }

        .no-margin-item{
            margin: 0;
        }

        .category-header{
            font-weight: bold;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
        }

        .first-column-item-header{
            padding-left: 1vw;
            height: 8vh;
            font-weight: bold;
        }

        .second-column-item-header{
            padding-left: 1vw;
            height: 8vh;
            font-weight: bold;
            padding-right: 1vw;
        }

        .column-item-footer{
            padding-left: 1vw;
            height: 8vh;
            font-weight: bold;
        }

        .column-item-8vh{
            padding-left: 1vw;
            height: 8vh;
        }

        .column-item-5vh{
            padding-left: 1vw;
            height: 5vh;
        }

        .first-column-item-divider{
            margin: 0 0.1vw 0 1vw;
            border-top: dashed 1px black;
        }

        .second-column-item-divider{
            margin: 0 1vw 0 0.1vw;
            border-top: dashed 1px black;
        }

        .row{
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /*FIM BODY*/

        /*FOOTER*/

        .grid-container-footer {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto;
            width: 100%;
        }

        /*FIM FOOTER*/

        /*SIGNATURE*/

        .signature{
            margin-top: 5vh;
            width: 100%;
            display: inline-flex;
        }

        .signature-date{
            width: 30%;
        }

        .signature-name{
            width: 50%;
        }

        .signature-rubric{
            width: 20%;
        }

        .date-underline{
            margin: -2vh 5vw 0 3.5vw;
            height: 1px;
            background-color: black;
        }

        .name-underline{
            margin: -2vh 5vw 0 7.5vw;
            height: 1px;
            background-color: black;
        }

        .rubric-underline{
            margin: -2vh 0 0 4vw;
            height: 1px;
            background-color: black;
        }

        /*FIM SIGNATURE*/

        /*Ocupar mais de uma coluna*/
        .item-first-half {
            grid-column-start: 1;
            grid-column-end: 5;
        }

        .item-second-half {
            grid-column-start: 5;
            grid-column-end: 9;
        }

        .item-first-third {
            grid-column-start: 1;
            grid-column-end: 7;
        }

        .item-second-third {
            grid-column-start: 7;
            grid-column-end: 9;
        }

        .item-three-columns {
            grid-column-start: 1;
            grid-column-end: 4;
        }

        .item-two-columns {
            grid-column-start: 6;
            grid-column-end: 8;
        }

        .item-footer{
            grid-column-start: 1;
            grid-column-end: 4;
        }

        .column-item-galpao{
            padding-left: 1vw;
            height: 1.5cm;
        }

        .outros_descricao{
            border-bottom: 1px black solid;
        }

        @media print{
            .container{
                width: 21cm;
                margin: 0;
                padding: 0;
            }

            .no-print{
                margin: 0;
                display: none;
            }

            .body{
                display: inline-flex;
                width: 100%;
                margin: 0.2cm 0 0 0;
                font-size: 0.5em;
            }

            .body > div{
                margin: 0;
                padding: 0;
            }

            .header-info{
                margin-top: -0.3cm;
            }

            .footer{
                margin: 0;
                font-size: 0.5em;
            }

            .pref-info{
                float: left;
                margin: -2cm 0 0 0;
                text-align: center;
                font-weight: bold;
            }

            .pref-info > p{
                margin: 0 0 0 3cm;
            }

            .logo{
                width: 86px; /*390px;*/
                height: 76px; /*346px;*/
                float: left;
            }

            .greater-font{
                font-size: 1.5em;
            }

            .category-header{
                font-weight: bold;
                font-size: 1.5em;
            }

            .grid-item-body {
                padding-bottom: 0.2cm;
            }

            .first-column-item-header{
                padding-left: 1vw;
                height: 3vh;
                font-weight: bold;
            }

            .second-column-item-header{
                padding-left: 1vw;
                height: 3vh;
                font-weight: bold;
                padding-right: 0.5cm;
            }

            .column-item-footer{
                padding-left: 1vw;
                height: 1vh;
                font-weight: bold;
            }

            .first-column-item-divider{
                margin: 0 0.1vw 0 0.5cm;
                border-top: dashed 1px black;
            }

            .second-column-item-divider{
                margin: 0 0.5cm 0 0.1vw;
                border-top: dashed 1px black;
            }

            .column-item-8vh{
                padding-left: 1vw;
                height: 0.5cm;
            }

            .column-item-5vh{
                padding-left: 1vw;
                height: 0.5cm;
            }

            .column-item-galpao{
                padding-left: 1vw;
                height: 0.8cm;
            }

            .date-underline{
                margin: -0.3cm 0.8cm 0 1.5cm;
                border-top: solid 1px black;
            }

            .name-underline{
                margin: -0.3cm 0.5cm 0 3cm;
                border-top: solid 1px black;
            }

            .rubric-underline{
                margin: -0.3cm 0 0 1.5cm;
                border-top: solid 1px black;
            }

            .signature{
                margin-top: 1cm;
                width: 100%;
                display: inline-flex;
            }
        }
    </style>

    <title>{{$title}}</title>

    <div class="container">
        <div>
            <button class="btn btn-primary no-print" onclick="imprimir()">Imprimir</button>
        </div>
        <div class="header">
            <div class="logo-container">
                <img class="logo" src="{{asset('img/logo_lins.png')}}">
                <div class="pref-info">
                    <p>PREFEITURA MUNICIPAL DE LINS</p>
                    <p>Divisão de Arrecadação</p>
                    <p>Ficha de Cadastramento Imobiliário</p>
                </div>
            </div>
            <div class="grid-container-header header-info">
                <div class="grid-item-header item-first-third gray-background">IDENTIFICAÇÃO DO IMÓVEL</div>
                <div class="grid-item-header item-second-third">{{$vistoria->imovel_id}}</div>
                <div class="grid-item-header item-first-half gray-background">Proprietário</div>
                <div class="grid-item-header item-second-half">{{$vistoria->proprietario}}</div>
                <div class="grid-item-header item-first-half gray-background">Rua / n°</div>
                <div class="grid-item-header item-second-half">{{$vistoria->rua}}, {{$vistoria->numero}}</div>
                <div class="grid-item-header gray-background">Setor</div>
                <div class="grid-item-header">{{$vistoria->setor}}</div>
                <div class="grid-item-header gray-background">Quadra</div>
                <div class="grid-item-header">{{$vistoria->quadra}}</div>
                <div class="grid-item-header gray-background">Lote</div>
                <div class="grid-item-header">{{$vistoria->lote}}</div>
                <div class="grid-item-header gray-background">Sbl.</div>
                <div class="grid-item-header">{{$vistoria->sublote}}</div>
            </div>
        </div>

        <div class="body">
            <div class="grid-container-body">
                <div class="grid-item-body item-three-columns gray-background greater-font">CARACTERÍSTICAS DA CONSTRUÇÃO</div>
                <div class="grid-item-body gray-background greater-font">Área/m²</div>
                <div class="grid-item-body greater-font">{{$vistoria->area_construcao}}</div>
                <div class="grid-item-body item-two-columns">&nbsp;</div>
                <div class="grid-item-body">
                    <p class="category-header">Catg. Propriet.</p>
                    @foreach ($categorias_proprietario as $categoria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($categoria == "Outros")
                                @if ($categorias_proprietario_outros)
                                    ( X ) {{$categoria}}: <span class="outros_descricao">{{$categorias_proprietario_outros}}</span>
                                @endif
                            @else
                                @foreach($categorias_proprietario_vistoria as $resposta)
                                    @if ($categoria == $resposta)
                                        ( X ) {{$categoria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$categoria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Número Pav.</p>
                    @foreach ($numeros_pavimento as $numero)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($numero == "Outros")
                                @if ($numeros_pavimento_outros)
                                    ( X ) {{$numero}}: <span class="outros_descricao">{{$numeros_pavimento_outros}}</span>
                                @endif
                            @else
                                @foreach($numeros_pavimento_vistoria as $resposta)
                                    @if ($numero == $resposta)
                                        ( X ) {{$numero}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$numero}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Categoria do Uso</p>
                    @foreach ($categorias_uso as $categoria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($categoria == "Outros")
                                @if ($categorias_uso_outros)
                                    ( X ) {{$categoria}}: <span class="outros_descricao">{{$categorias_uso_outros}}</span>
                                @endif
                            @else
                                @foreach($categorias_uso_vistoria as $resposta)
                                    @if ($categoria == $resposta)
                                        ( X ) {{$categoria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$categoria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Abastec. de água</p>
                    @foreach ($abastecimentos_agua as $abastecimento)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($abastecimento == "Outros")
                                @if ($abastecimentos_agua_outros)
                                    ( X ) {{$abastecimento}}: <span class="outros_descricao">{{$abastecimentos_agua_outros}}</span>
                                @endif
                            @else
                                @foreach($abastecimentos_agua_vistoria as $resposta)
                                    @if ($abastecimento == $resposta)
                                        ( X ) {{$abastecimento}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$abastecimento}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Serv. Esg.</p>
                    @foreach ($servicos_esgoto as $servico)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($servico == "Outros")
                                @if ($servicos_esgoto_outros)
                                    ( X ) {{$servico}}: <span class="outros_descricao">{{$servicos_esgoto_outros}}</span>
                                @endif
                            @else
                                @foreach($servicos_esgoto_vistoria as $resposta)
                                    @if ($servico == $resposta)
                                        ( X ) {{$servico}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$servico}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Serv. Mun. Rede Elétrica</p>
                    @foreach ($servicos_rede_eletrica as $servico)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($servico == "Outros")
                                @if ($servicos_rede_eletrica_outros)
                                    ( X ) {{$servico}}: <span class="outros_descricao">{{$servicos_rede_eletrica_outros}}</span>
                                @endif
                            @else
                                @foreach($servicos_rede_eletrica_vistoria as $resposta)
                                    @if ($servico == $resposta)
                                        ( X ) {{$servico}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$servico}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Melhorias Mun.</p>
                    @foreach ($melhorias_municipio as $melhoria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($melhoria == "Outros")
                                @if ($melhorias_municipio_outros)
                                    ( X ) {{$melhoria}}: <span class="outros_descricao">{{$melhorias_municipio_outros}}</span>
                                @endif
                            @else
                                @foreach($melhorias_municipio_vistoria as $resposta)
                                    @if ($melhoria == $resposta)
                                        ( X ) {{$melhoria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$melhoria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Revest. Externo</p>
                    @foreach ($revestimentos_externo as $revestimento)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($revestimento == "Outros")
                                @if ($revestimentos_externo_outros)
                                    ( X ) {{$revestimento}}: <span class="outros_descricao">{{$revestimentos_externo_outros}}</span>
                                @endif
                            @else
                                @foreach($revestimentos_externo_vistoria as $resposta)
                                    @if ($revestimento == $resposta)
                                        ( X ) {{$revestimento}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$revestimento}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Revest. Interno</p>
                    @foreach ($revestimentos_interno as $revestimento)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($revestimento == "Outros")
                                @if ($revestimentos_interno_outros)
                                    ( X ) {{$revestimento}}: <span class="outros_descricao">{{$revestimentos_interno_outros}}</span>
                                @endif
                            @else
                                @foreach($revestimentos_interno_vistoria as $resposta)
                                    @if ($revestimento == $resposta)
                                        ( X ) {{$revestimento}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$revestimento}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Pintura Externa</p>
                    @foreach ($pinturas_externa as $pintura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($pintura == "Outros")
                                @if ($pinturas_externa_outros)
                                    ( X ) {{$pintura}}: <span class="outros_descricao">{{$pinturas_externa_outros}}</span>
                                @endif
                            @else
                                @foreach($pinturas_externa_vistoria as $resposta)
                                    @if ($pintura == $resposta)
                                        ( X ) {{$pintura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$pintura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Pintura Interna</p>
                    @foreach ($pinturas_interna as $pintura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($pintura == "Outros")
                                @if ($pinturas_interna_outros)
                                    ( X ) {{$pintura}}: <span class="outros_descricao">{{$pinturas_interna_outros}}</span>
                                @endif
                            @else
                                @foreach($pinturas_interna_vistoria as $resposta)
                                    @if ($pintura == $resposta)
                                        ( X ) {{$pintura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$pintura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Piso Interno</p>
                    @foreach ($pisos_interno as $piso)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($piso == "Outros")
                                @if ($pisos_interno_outros)
                                    ( X ) {{$piso}}: <span class="outros_descricao">{{$pisos_interno_outros}}</span>
                                @endif
                            @else
                                @foreach($pisos_interno_vistoria as $resposta)
                                    @if ($piso == $resposta)
                                        ( X ) {{$piso}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$piso}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Piso Externo</p>
                    @foreach ($pisos_externo as $piso)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($piso == "Outros")
                                @if ($pisos_externo_outros)
                                    ( X ) {{$piso}}: <span class="outros_descricao">{{$pisos_externo_outros}}</span>
                                @endif
                            @else
                                @foreach($pisos_externo_vistoria as $resposta)
                                    @if ($piso == $resposta)
                                        ( X ) {{$piso}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$piso}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Forro</p>
                    @foreach ($forros as $forro)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($forro == "Outros")
                                @if ($forros_outros)
                                    ( X ) {{$forro}}: <span class="outros_descricao">{{$forros_outros}}</span>
                                @endif
                            @else
                                @foreach($forros_vistoria as $resposta)
                                    @if ($forro == $resposta)
                                        ( X ) {{$forro}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$forro}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Esquadrias Portas</p>
                    @foreach ($esquadrias_porta as $esquadria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($esquadria == "Outros")
                                @if ($esquadrias_porta_outros)
                                    ( X ) {{$esquadria}}: <span class="outros_descricao">{{$esquadrias_porta_outros}}</span>
                                @endif
                            @else
                                @foreach($esquadrias_porta_vistoria as $resposta)
                                    @if ($esquadria == $resposta)
                                        ( X ) {{$esquadria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$esquadria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Esquadrias Janelas</p>
                    @foreach ($esquadrias_janela as $esquadria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($esquadria == "Outros")
                                @if ($esquadrias_janela_outros)
                                    ( X ) {{$esquadria}}: <span class="outros_descricao">{{$esquadrias_janela_outros}}</span>
                                @endif
                            @else
                                @foreach($esquadrias_janela_vistoria as $resposta)
                                    @if ($esquadria == $resposta)
                                        ( X ) {{$esquadria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$esquadria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Pintura de Esquadrias</p>
                    @foreach ($pinturas_esquadria as $pintura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($pintura == "Outros")
                                @if ($pinturas_esquadria_outros)
                                    ( X ) {{$pintura}}: <span class="outros_descricao">{{$pinturas_esquadria_outros}}</span>
                                @endif
                            @else
                                @foreach($pinturas_esquadria_vistoria as $resposta)
                                    @if ($pintura == $resposta)
                                        ( X ) {{$pintura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$pintura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Instal. Elét.</p>
                    @foreach ($instalacoes_eletrica as $instalacao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($instalacao == "Outros")
                                @if ($instalacoes_eletrica_outros)
                                    ( X ) {{$instalacao}}: <span class="outros_descricao">{{$instalacoes_eletrica_outros}}</span>
                                @endif
                            @else
                                @foreach($instalacoes_eletrica_vistoria as $resposta)
                                    @if ($instalacao == $resposta)
                                        ( X ) {{$instalacao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$instalacao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Instal. Sanit.</p>
                    @foreach ($instalacoes_sanitaria as $instalacao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($instalacao == "Outros")
                                @if ($instalacoes_sanitaria_outros)
                                    ( X ) {{$instalacao}}: <span class="outros_descricao">{{$instalacoes_sanitaria_outros}}</span>
                                @endif
                            @else
                                @foreach($instalacoes_sanitaria_vistoria as $resposta)
                                    @if ($instalacao == $resposta)
                                        ( X ) {{$instalacao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$instalacao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Estrutura</p>
                    @foreach ($estruturas as $estrutura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($estrutura == "Outros")
                                @if ($estruturas_outros)
                                    ( X ) {{$estrutura}}: <span class="outros_descricao">{{$estruturas_outros}}</span>
                                @endif
                            @else
                                @foreach($estruturas_vistoria as $resposta)
                                    @if ($estrutura == $resposta)
                                        ( X ) {{$estrutura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$estrutura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Estrutura Telhado</p>
                    @foreach ($estruturas_telhado as $estrutura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($estrutura == "Outros")
                                @if ($estruturas_telhado_outros)
                                    ( X ) {{$estrutura}}: <span class="outros_descricao">{{$estruturas_telhado_outros}}</span>
                                @endif
                            @else
                                @foreach($estruturas_telhado_vistoria as $resposta)
                                    @if ($estrutura == $resposta)
                                        ( X ) {{$estrutura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$estrutura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Cobertura</p>
                    @foreach ($coberturas as $cobertura)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($cobertura == "Outros")
                                @if ($coberturas_outros)
                                    ( X ) {{$cobertura}}: <span class="outros_descricao">{{$coberturas_outros}}</span>
                                @endif
                            @else
                                @foreach($coberturas_vistoria as $resposta)
                                    @if ($cobertura == $resposta)
                                        ( X ) {{$cobertura}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$cobertura}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Elevador</p>
                    @foreach ($elevadores as $elevador)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($elevador == "Outros")
                                @if ($elevadores_outros)
                                    ( X ) {{$elevador}}: <span class="outros_descricao">{{$elevadores_outros}}</span>
                                @endif
                            @else
                                @foreach($elevadores_vistoria as $resposta)
                                    @if ($elevador == $resposta)
                                        ( X ) {{$elevador}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$elevador}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Situação da Construção</p>
                    @foreach ($situacoes_construcao as $situacao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($situacao == "Outros")
                                @if ($situacoes_construcao_outros)
                                    ( X ) {{$situacao}}: <span class="outros_descricao">{{$situacoes_construcao_outros}}</span>
                                @endif
                            @else
                                @foreach($situacoes_construcao_vistoria as $resposta)
                                    @if ($situacao == $resposta)
                                        ( X ) {{$situacao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$situacao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Localização Vertical</p>
                    @foreach ($localizacoes_vertical as $localizacao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($localizacao == "Outros")
                                @if ($localizacoes_vertical_outros)
                                    ( X ) {{$localizacao}}: <span class="outros_descricao">{{$localizacoes_vertical_outros}}</span>
                                @endif
                            @else
                                @foreach($localizacoes_vertical_vistoria as $resposta)
                                    @if ($localizacao == $resposta)
                                        ( X ) {{$localizacao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$localizacao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Acabamentos</p>
                    @foreach($acabamentos as $acabamento)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($acabamento == "Outros")
                                @if ($acabamentos_outros)
                                    ( X ) {{$acabamento}}: <span class="outros_descricao">{{$acabamentos_outros}}</span>
                                @endif
                            @else
                                @foreach($acabamentos_vistoria as $resposta)
                                    @if ($acabamento == $resposta)
                                        ( X ) {{$acabamento}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$acabamento}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>

                <div class="grid-item-body item-two-columns">
                    <div class="row">
                        <div class="column">
                            <div class="first-column-item-header category-header"><p>Ambientes</p></div>
                            <div class="column-item-8vh"><p>Construção Principal</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-8vh"><p>Construção Secundária</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-5vh"><p>Varanda</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-5vh"><p>Telheiros</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-galpao"><p>Galpão (Comercial / Industrial)</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-5vh"><p>Outros</p></div>
                            <hr class="first-column-item-divider"/>
                            <div class="column-item-footer"><p>Área Total Construída &#8594;</p></div>
                        </div>
                        <div class="column">
                            <div class="second-column-item-header category-header"><p>Taxa de Ocupação</p></div>
                            <div class="column-item-8vh"><p>{{$vistoria->tx_ocup_principal ? $vistoria->tx_ocup_principal : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-8vh"><p>{{$vistoria->tx_ocup_secundaria ? $vistoria->tx_ocup_secundaria : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-5vh"><p>{{$vistoria->tx_ocup_varanda ? $vistoria->tx_ocup_varanda : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-5vh"><p>{{$vistoria->tx_ocup_telheiros ? $vistoria->tx_ocup_telheiros : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-galpao"><p>{{$vistoria->tx_ocup_galpao ? $vistoria->tx_ocup_galpao : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-5vh"><p>{{$vistoria->tx_ocup_outros ? $vistoria->tx_ocup_outros : 0}} %</p></div>
                            <hr class="second-column-item-divider"/>
                            <div class="column-item-footer"><p>{{$vistoria->tx_ocup_principal +
                                    $vistoria->tx_ocup_secundaria + $vistoria->tx_ocup_varanda +
                                    $vistoria->tx_ocup_telheiros + $vistoria->tx_ocup_galpao +
                                    $vistoria->tx_ocup_outros}} %</p></div>
                        </div>
                    </div>
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Casa Alinhada</p>
                    @foreach ($casas_alinhada as $casa)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($casa == "Outros")
                                @if ($casas_alinhada_outros)
                                    ( X ) {{$casa}}: <span class="outros_descricao">{{$casas_alinhada_outros}}</span>
                                @endif
                            @else
                                @foreach($casas_alinhada_vistoria as $resposta)
                                    @if ($casa == $resposta)
                                        ( X ) {{$casa}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$casa}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Casa Recuada</p>
                    @foreach ($casas_recuada as $casa)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($casa == "Outros")
                                @if ($casas_recuada_outros)
                                    ( X ) {{$casa}}: <span class="outros_descricao">{{$casas_recuada_outros}}</span>
                                @endif
                            @else
                                @foreach($casas_recuada_vistoria as $resposta)
                                    @if ($casa == $resposta)
                                        ( X ) {{$casa}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$casa}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Escritório</p>
                    @foreach ($escritorios as $escritorio)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($escritorio == "Outros")
                                @if ($escritorios_outros)
                                    ( X ) {{$escritorio}}: <span class="outros_descricao">{{$escritorios_outros}}</span>
                                @endif
                            @else
                                @foreach($escritorios_vistoria as $resposta)
                                    @if ($escritorio == $resposta)
                                        ( X ) {{$escritorio}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$escritorio}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">Comércio</p>
                    @foreach ($comercios as $comercio)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($comercio == "Outros")
                                @if ($comercios_outros)
                                    ( X ) {{$comercio}}: <span class="outros_descricao">{{$comercios_outros}}</span>
                                @endif
                            @else
                                @foreach($comercios_vistoria as $resposta)
                                    @if ($comercio == $resposta)
                                        ( X ) {{$comercio}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$comercio}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">E.C. = Estado de Conservação</p>
                    @foreach ($estados_conservacao as $estado)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($estado == "Outros")
                                @if ($estados_conservacao_outros)
                                    ( X ) {{$estado}}: <span class="outros_descricao">{{$estados_conservacao_outros}}</span>
                                @endif
                            @else
                                @foreach($estados_conservacao_vistoria as $resposta)
                                    @if ($estado == $resposta)
                                        ( X ) {{$estado}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$estado}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body item-two-columns">
                    <p class="category-header">CAT Categorias</p>
                    @foreach ($categorias as $categoria)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($categoria == "Outros")
                                @if ($categorias_outros)
                                    ( X ) {{$categoria}}: <span class="outros_descricao">{{$categorias_outros}}</span>
                                @endif
                            @else
                                @foreach($categorias_vistoria as $resposta)
                                    @if ($categoria == $resposta)
                                        ( X ) {{$categoria}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$categoria}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="grid-container-footer">
                <div class="grid-item-body item-footer gray-background greater-font">CARACTERÍSTICAS DO TERRENO</div>
                <div class="grid-item-body gray-background greater-font">Área/m²</div>
                <div class="grid-item-body greater-font">{{$vistoria->area_terreno}}</div>
                <div class="grid-item-body">&nbsp;</div>

                <div class="grid-item-body">
                    <p class="category-header">FORMA</p>
                    @foreach ($formas as $forma)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($forma == "Outros")
                                @if ($formas_outros)
                                    ( X ) {{$forma}}: <span class="outros_descricao">{{$formas_outros}}</span>
                                @endif
                            @else
                                @foreach($formas_vistoria as $resposta)
                                    @if ($forma == $resposta)
                                        ( X ) {{$forma}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$forma}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">STIAUAÇÃO</p>
                    @foreach ($situacoes as $situacao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($situacao == "Outros")
                                @if ($situacoes_outros)
                                    ( X ) {{$situacao}}: <span class="outros_descricao">{{$situacoes_outros}}</span>
                                @endif
                            @else
                                @foreach($situacoes_vistoria as $resposta)
                                    @if ($situacao == $resposta)
                                        ( X ) {{$situacao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$situacao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">USO</p>
                    @foreach ($usos_terreno as $uso)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($uso == "Outros")
                                @if ($usos_terreno_outros)
                                    ( X ) {{$uso}}: <span class="outros_descricao">{{$usos_terreno_outros}}</span>
                                @endif
                            @else
                                @foreach($usos_terreno_vistoria as $resposta)
                                    @if ($uso == $resposta)
                                        ( X ) {{$uso}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$uso}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">PROTEÇÃO CALÇADA</p>
                    @foreach ($protecoes_calcada as $protecao)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($protecao == "Outros")
                                @if ($protecoes_calcada_outros)
                                    ( X ) {{$protecao}}: <span class="outros_descricao">{{$protecoes_calcada_outros}}</span>
                                @endif
                            @else
                                @foreach($protecoes_calcada_vistoria as $resposta)
                                    @if ($protecao == $resposta)
                                        ( X ) {{$protecao}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$protecao}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">PEDOLOGIA</p>
                    @foreach ($pedologias as $pedologia)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($pedologia == "Outros")
                                @if ($pedologias_outros)
                                    ( X ) {{$pedologia}}: <span class="outros_descricao">{{$pedologias_outros}}</span>
                                @endif
                            @else
                                @foreach($pedologias_vistoria as $resposta)
                                    @if ($pedologia == $resposta)
                                        ( X ) {{$pedologia}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$pedologia}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="grid-item-body">
                    <p class="category-header">TOPOGRAFIA</p>
                    @foreach ($topografias as $topografia)
                        <p class="no-margin-item">
                            @php $checked = false; @endphp
                            @if ($topografia == "Outros")
                                @if ($topografias_outros)
                                    ( X ) {{$topografia}}: <span class="outros_descricao">{{$topografias_outros}}</span>
                                @endif
                            @else
                                @foreach($topografias_vistoria as $resposta)
                                    @if ($topografia == $resposta)
                                        ( X ) {{$topografia}}
                                        @php $checked = true @endphp
                                    @endif
                                @endforeach
                                @if (!$checked)
                                    ( &nbsp;&nbsp;&nbsp; ) {{$topografia}}
                                @endif
                            @endif
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="signature">
            <div class="signature-date">
                <p>Data: {{$vistoria->data_inspecao->format('d/m/Y')}}</p>
                <hr class="date-underline"/>
            </div>
            <div class="signature-name">
                <p>Nome/Fiscal: {{$vistoria->nome_fiscal}}</p>
                <hr class="name-underline"/>
            </div>
            <div class="signature-rubric">
                <p>Visto:</p>
                <hr class="rubric-underline"/>
            </div>
        </div>
    </div>

    <script>
        function imprimir() {
            window.print();
        }
    </script>
@endsection