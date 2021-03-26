@extends('layouts.app')

@section('content')
    <style>
        .font2em{
            font-size: 2em;
        }
        .font1-5em{
            font-size:1.5em;
        }
        .font1em{
            font-size: 1em;
        }
        .center{
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        .paddingTop25{
            padding-top: 25px;
        }
        .imgLogo{
            width: 20%;
            height: 20%;
            float: left;
            /*margin-left: 50px;*/
        }
        hr{
            border-color: black;
            margin-top: 60px;
        }
        .borderBlack{
            border: solid 1px black;
            padding: 0px 10px;
        }
        .tabelaManutencoes{
            border: solid 1px black;
            width: 80%;
            text-align: center;
            margin: 0 auto;
        }
        @media print{
            .printTbl{
                width: 70%;
            }
        }
    </style>

    <title>{{$title}}</title>

    <ul class="breadcrumb noPrintBtn">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
{{--        <li><a href="{{ route('indexRelatorios') }}">Relatórios</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">
        Imprimir
    </button>
    <div>
        <img src="{{asset('img/'.$prefeitura["logo"])}}" class="imgLogo">
        <div class="paddingTop25">
            <strong class="font2em text-center">{{$prefeitura["nome"]}}</strong>
            {{--<br>--}}
            {{--<strong class="font2em">LINS</strong>--}}
            <br>
            <p class="font1-5em text-center">{{$prefeitura["endereco"]}}</p>
            <p class="font1em text-center">DADOS EXTRAÍDOS DO SISTEMA GESTÃO DE MANUTENÇÃO CIDADE FÁCIL - SONNITECH</p>
        </div>
    </div>
    <hr>
    <div>
        <p class="font1-5em center">GASTOS COM MANUTENÇÃO</p>
        <br>
        <p class="font1-5em">Período:
            <font class="borderBlack">{{$dadosRelatorio["dataInicio"]}}</font>
            a
            <font class="borderBlack">{{$dadosRelatorio["dataFim"]}}</font>
        </p>
        <br>
        <strong class="font1-5em"><u>RESUMO GERAL</u></strong>
        <br>
        @if($dadosRelatorio["valorPreventivas"] > $dadosRelatorio["valorCorretivas"])
            <p class="font1-5em">Manutenção Preventiva:
                <font class="borderBlack">R$: {{number_format($dadosRelatorio["valorPreventivas"], 2, ',', '.')}}</font>
            </p>
            <p class="font1-5em">Manutenção Corretiva:
                <font class="borderBlack">R$: {{number_format($dadosRelatorio["valorCorretivas"], 2, ',', '.')}}</font>
            </p>
        @else
            <p class="font1-5em">Manutenção Corretiva:
                <font class="borderBlack">R$: {{number_format($dadosRelatorio["valorCorretivas"], 2, ',', '.')}}</font>
            </p>
            <p class="font1-5em">Manutenção Preventiva:
                <font class="borderBlack">R$: {{number_format($dadosRelatorio["valorPreventivas"], 2, ',', '.')}}</font>
            </p>
        @endif
        <br>

        <strong class="font1-5em"><u>DETALHES DA MANUTENÇÃO PREVENTIVA</u></strong>
        <br>
        @for($j=0; $j<count($tabelaPreventivas); $j++)
            @if(!is_array($tabelaPreventivas[$j]))
                <p class="font1-5em">Veículo <font class="borderBlack">{{$tabelaPreventivas[$j]}}</font></p>
                <table class="tabelaManutencoes">
                    <tr class="borderBlack">
                        <th class="borderBlack">Data</th>
                        <th class="borderBlack">Peça trocada</th>
                        <th class="borderBlack">Quantidade</th>
                        <th class="borderBlack">Valor Unitário (R$)</th>
                        <th class="borderBlack">Valor Total (R$)</th>
                    </tr>
            @endif
            @if(is_array($tabelaPreventivas[$j]))
                <tr class="borderBlack">
                    <td class="borderBlack">{{$tabelaPreventivas[$j]["data"]->format('d/m/Y')}}</td>
                    <td class="borderBlack text-left">{{$tabelaPreventivas[$j]["peca_trocada"]}}</td>
                    <td class="borderBlack">{{$tabelaPreventivas[$j]["qtd"]}}</td>
                    <td class="borderBlack text-right">{{number_format($tabelaPreventivas[$j]["valor_unitario"], 2, ',', '.')}}</td>
                    <td class="borderBlack text-right">{{number_format($tabelaPreventivas[$j]["valor_total"], 2, ',', '.')}}</td>
                </tr>
                @if ($j < (count($tabelaPreventivas)-1))
                    @if(!is_array($tabelaPreventivas[$j+1]))
                        </table>
                        <br>
                    @endif
                @elseif($j == count($tabelaPreventivas)-1)
                    </table>
                    <br>
                @endif
            @endif
        @endfor

        <strong class="font1-5em"><u>DETALHES DA MANUTENÇÃO CORRETIVA</u></strong>
        <br>
        @for($i=0; $i<count($tabelaCorretivas); $i++)
            @if(!is_array($tabelaCorretivas[$i]))
                <p class="font1-5em">Veículo <font class="borderBlack">{{$tabelaCorretivas[$i]}}</font></p>
                <table class="tabelaManutencoes">
                <tr class="borderBlack">
                    <th class="borderBlack">Data</th>
                    <th class="borderBlack">Peça trocada</th>
                    <th class="borderBlack">Quantidade</th>
                    <th class="borderBlack">Valor Unitário (R$)</th>
                    <th class="borderBlack">Valor Total (R$)</th>
                </tr>
            @endif
            @if(is_array($tabelaCorretivas[$i]))
                <tr class="borderBlack">
                    <td class="borderBlack">{{$tabelaCorretivas[$i]["data"]->format('d/m/Y')}}</td>
                    <td class="borderBlack text-left">{{$tabelaCorretivas[$i]["peca_trocada"]}}</td>
                    <td class="borderBlack">{{$tabelaCorretivas[$i]["qtd"]}}</td>
                    <td class="borderBlack text-right">{{number_format($tabelaCorretivas[$i]["valor_unitario"], 2, ',', '.')}}</td>
                    <td class="borderBlack text-right">{{number_format($tabelaCorretivas[$i]["valor_total"], 2, ',', '.')}}</td>
                </tr>
                @if ($i < (count($tabelaCorretivas)-1))
                    @if(!is_array($tabelaCorretivas[$i+1]))
                        </table>
                        <br>
                    @endif
                @endif
            @endif
        @endfor
    </div>

    {{--PROVISÓRIO--}}
    <script>
        function printPage() {
            window.print();
        }
    </script>

@endsection