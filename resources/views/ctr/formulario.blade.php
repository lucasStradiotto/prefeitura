@extends('layouts.app')

@section('content')
    <style>
        .margemH1 {
            font-size: 1.9em;
            margin-top: 3%;
            margin-bottom: 4%;
        }

        .assinatura {
            margin-top: 2%;
        }

        .labelborder {
            text-align: center;
            border: 1px solid;
            border-color: black;
            height: 150px;
        }

        .enderecoDestinador {
            width: 100%;
            float: left;
        }

        .cabecalho {
            height: 550px;
        }

        .locacao {
            margin-top: 1%;
            height: 100px;
        }

        .instrucoes {
            margin-top: 3%;
            height: 400px;
        }

        .rodape {
            height: 300px;
        }

        .tableDados {
            width: 60%;
            margin-left: 15%;
            margin-right: 25%;
        }

        .tdSemBorda {
            height: 5%;
            width: 25%;
            text-align: right;
            padding-right: 5%;
        }

        .tdBorda {
            height: 5%;
            border: 2px black solid;
            width: 25%;
            padding-left: 5%;
        }

        .div100 {
            width: 100%;
        }

        .div80 {
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
            text-align: center;
        }

        .div50 {
            width: 30%;
            margin: 0% 10% 0% 10%;
            float: left;
        }

        .imgLogo{
            width: 119.5px;
            height: 98px;
        }

        @media print {
            .noPrint {
                display: none;
            }

            .printDivisor {
                width: 80%;
                text-align: center;
            }

            .imgLogo{
                width: 119.5px;
                height: 98px;
            }

        }
    </style>

    <title>{{$title}}</title>
    <div class="div100">
        <ul class="breadcrumb noPrint">
            <li><a href="{{ url('/controle-transpote-residuo') }}">Ctr</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
        @if (!empty($ordem))            
            <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
            <div class="cabecalho">
                <div class="div80">
                    <h1 class="margemH1">C.T.R Controle de Transporte e Res??duos</h1>
                </div>
                <div class="tableDados">

                    <table>
                        <tr>
                            <td><img class="imgLogo" src="{{ URL::asset('img/Sonnitech-logo.png') }}"></td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">Material Predominante:</td>
                            <td class="tdBorda">{{$ordem->tipo_material}}</td>
                            <td class="tdSemBorda">Data:</td>
                            <td class="tdBorda">{{ \Carbon\Carbon::parse($ordem->data)->format('d/m/Y')}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">Nome:</td>
                            <td colspan="3" class="tdBorda">{{$ordem->nome_solicitante}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">Fone:</td>
                            <td class="tdBorda">{{$ordem->telefone}}</td>
                            <td class="tdSemBorda">RG:</td>
                            <td class="tdBorda">{{$ordem->rg}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">CNPJ:</td>
                            <td class="tdBorda">{{$ordem->cnpj}}</td>
                            <td class="tdSemBorda">CPF:</td>
                            <td class="tdBorda">{{$ordem->cpf}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">Endere??o:</td>
                            <td colspan="3" class="tdBorda">{{$ordem->nome_rua}}, n&ordm; {{$ordem->numero_obra}}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdSemBorda">Bairro:</td>
                            <td colspan="3" class="tdBorda">{{$ordem->nome_bairro}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="locacao">
                <div class="div80">
                    <h2>Condi????es de Loca????o</h2>
                    <p align="justify">
                        O valor da loca????o de cada ca??amba de <b>03</b> m' ser?? de R$ {{$ordem->valor}} pelo prazo maximo de
                        07
                        dias de
                        entrega da mesma,
                        sendo efetuada a cobran??a ap??s a sua retirada.
                    </p>
                </div>
            </div>
            <div class="instrucoes">
                <div class="div80">
                    <h2 class="espaco">Instru????es</h2>
                </div>
                <div class="div80">
                    <p align="justify">Conforme a Lei Municipal n&ordm; <b>1140</b> a coloca????o da ca??amba de remo????o de
                        entulho deve
                        estar :
                    </p>
                    <ol align="justify">
                        <li>&emsp;Alinhada ao meio fio e no maximo a 30 cm deste;</li>
                        <li>&emsp;No minimo 5 metros do cruzamento do passeio p??blico;</li>
                        <li>&emsp;Onde for permitido o estacionamento de veiculos;</li>
                        <li>&emsp;N??o colocar em frente de garagens, port??es ou lugares reservados para carga e
                            descarga;
                        </li>
                        <li>&emsp;N??o mudar a posi????o da mesma para n??o dificultar a opera????o da retirada;</li>
                        <li>&emsp;N??o ultrapassar a capacidade c??bica da ca??amba;</li>
                        <li>&emsp;Por motivos de seguran??a, duran??a a operan????o n??o ?? permitido pessoas ao redor do
                            ve??culo;
                        </li>
                    </ol>
                    <p align="justify">&emsp;
                        Declaro, para os devidos fins e na melhor forma do
                        direito,
                        que
                        recebi e presenciei a coloca????o de 1 (uma) ca??amba
                        de acordo com a Lei Municipal <b>1140</b>, bem como demais exig??ncias da Prefeitura
                        Municipal
                        local,
                        de
                        forma a evitar acidentes
                        na via p??blica e penalidades aplicadas pela Fiscaliza????o Municipal, ficando iisenta de
                        responsabilidade desta empresa
                        no caso de qualquer altera????o em sua posi????o, pelo locat??rio ou seu prepisto.
                    </p>
                </div>
            </div>
            <div class="rodape">
                <div class="div80 assinatura">
                    <div class="div50">
                        <br>
                        <p>{{$ordem->nome_solicitante}}</p>
                        <p>Entrega em:{{ \Carbon\Carbon::parse($ordem->data_entrega)->format('d/m/Y')}}</p>
                    </div>
                    <div class="div50">
                        <p>{{$ordem->nome_fantasia}}</p>
                        <p>{{$ordem->razao_social}}</p>
                        <p>Retirado em:{{\Carbon\Carbon::parse($ordem->data_retirada)->format('d/m/Y')}}</p>
                    </div>
                </div>
                <div class="div80">
                    <p class="printDivisor" align="center">
                        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                        - - - - - - - - - - - - - - -
                    </p>
                </div>
                @if($ordem->data_retirada != "")
                    <div class="div80 labelborder">
                        <h3>Processamento no Destinador</h3>
                        <div class="div50">
                            <p>Destinador: {{"Empresa destinadora que falta"}}</p>
                        </div>
                        <div class="div50">
                            <p>Data: {{$ordem->data_retirada}}</p>
                        </div>
                        <div class="enderecoDestinador">
                            <p>Endere??o: {{"Endere??o do destinador que falta"}}</p>
                        </div>
                    </div>
                @else
                    <div class="div80 labelborder">
                        <h3>Processamento Destinador</h3>
                        <div class="div50">
                            <p>Destinador: {{""}}</p>
                        </div>
                        <div class="div50">
                            <p>Data: {{$ordem->data_retirada}}</p>
                        </div>
                        <div class="enderecoDestinador">
                            <h4 style="color:darkred">Aguardando</h4>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <script>
        function printPage() {
            window.print();
        }
    </script>
@endsection