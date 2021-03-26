@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb noPrintBtn">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li><a href="{{ route('indexRelatorios') }}">Relatórios</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
    <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
    <div class="printTable printDiv">
            <img src="{{asset('img/logo_lins.png')}}" class="printImgRelatorio imgRelatorio"/>
            <strong style="font-size: 30px; display: inline-flex;">PREFEITURA MUNICIPAL <br>DE LINS</strong>
    </div>

    <h3 class="printHeaderFooter" align="center" style="background-color: #bfbfbf">{{$title}} - DIPRO {{$ano}}</h3>

    <div>
        <table border="1" align="center" class="printTable">
            <tr>
                <th bgcolor="#bfbfbf">Mês</th>
                <th bgcolor="#bfbfbf">Quantidade de Processos</th>
            </tr>
            <tr>
                <td>{{$mes}}</td>
                <td>{{count($processosNoPeriodo)}}</td>
                <td>Até {{$dataLastDay->format('d/m/Y')}}</td>
            </tr>
        </table>
        {{--<br>--}}
        <br>
        <table border="1" align="center" class="printTable">
            <tr>
                <th bgcolor="#bfbfbf">Serviços Executados</th>
                <th bgcolor="#bfbfbf">Quantidade</th>
            </tr>
            <tr>
                <td>Emissão de Certidões de Construção</td>
                <td>{{$dadosServicos["qtdConstrucao"]}}</td>
            </tr>
            <tr>
                <td>Emissão de Certidões de Demolição</td>
                <td>{{$dadosServicos["qtdDemolicao"]}}</td>
            </tr>
            <tr>
                <td>Emissão de Habite-ses</td>
                <td>{{$dadosServicos["qtdHabitese"]}}</td>
            </tr>
            <tr>
                <td>Emissão de Certidões Medidas e Confrontações</td>
                <td>{{$dadosServicos["qtdMedCon"]}}</td>
            </tr>
            <tr>
                <th bgcolor="#bfbfbf">Total de Documentos Emitidos</th>
                <th bgcolor="#bfbfbf">{{array_sum($dadosServicos)}}</th>
            </tr>
            <tr>
                <td>Aprovação de Projetos (Construção, Desmembramento e outros)</td>
                <td>{{$dadosDocumentos["qtdAprovados"]}}</td>
            </tr>
            <tr>
                <td>Visto em Projetos (Conservação, Revalidação e outros)</td>
                <td>{{$dadosDocumentos["qtdVistos"]}}</td>
            </tr>
            <tr>
                <td>Cancelamentos de Projetos</td>
                <td>{{$dadosDocumentos["qtdCancelados"]}}</td>
            </tr>
            <tr>
                <td>Outros (Alterações, Digitalizações, Alvarás)</td>
                <td>{{$dadosDocumentos["qtdOutros"]}}</td>
            </tr>
            <tr>
                <th>Total de Processos Realizados</th>
                <th>{{array_sum($dadosDocumentos)}}</th>
            </tr>
            <tr>
                <th bgcolor="#bfbfbf">Total Geral de Processos</th>
                <th bgcolor="#bfbfbf">{{array_sum($dadosServicos) + array_sum($dadosDocumentos)}}</th>
            </tr>
            {{--<tr>--}}
                {{--<td>&nbsp;</td>--}}
                {{--<td>&nbsp;</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th bgcolor="#bfbfbf">Vistoria em Obras</th>--}}
                {{--<th bgcolor="#bfbfbf">???</th>--}}
            {{--</tr>--}}
        </table>
        <br><br>
        {{--<table border="0" align="center" class="printTable">--}}
            {{--<tr>--}}
                {{--<td>Revisão: <br>14/06/17</td>--}}
                {{--<td>Nome: <br>Relatório de Serviços DIPRO</td>--}}
                {{--<td>Elaborado por: <br>{{$estagiario}}</td>--}}
            {{--</tr>--}}
        {{--</table>--}}
        <div>
            <h3 align="center" class="printHeaderFooter">
            Visto Responsável pelo Setor de Projetos: ______________________________
            </h3>
        </div>
    </div>



    {{--PROVISÓRIO--}}
    <script>
        function printPage() {
            window.print();
        }
    </script>

@endsection
