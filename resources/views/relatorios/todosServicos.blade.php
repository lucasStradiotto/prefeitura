@extends('layouts.app')

@section('content')

    <style>
        .browserTable{
            margin-top: 1%;
            width: 70%;
        }
    </style>
    <title>{{$title}}</title>

    <ul class="breadcrumb noPrintBtn">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        {{--<li><a href="{{ route('indexRelatorios') }}">Relatórios</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
    <div class="printTable printDiv">
            <img src="{{asset('img/logo_lins.png')}}" class="printImgRelatorio imgRelatorio"/>
            <strong style="font-size: 30px; display: inline-flex;">PREFEITURA MUNICIPAL <br>DE LINS</strong>
    </div>

    <h3 class="printHeaderFooter" align="center" style="background-color: #bfbfbf">{{$title}}</h3>

    <div>
        <div>
            <table border="1" align="center" class="printTable browserTable">
                <tr>
                    <th bgcolor="#bfbfbf">Mês</th>
                    <th bgcolor="#bfbfbf">Quantidade de Processos</th>
                </tr>
                <tr>
                    <td>{{$mes}}</td>
                    <td>{{$qtd_processos}}</td>
                    <td>Até {{$dataLastDay->format('d/m/Y')}}</td>
                </tr>
            </table>
            <br>
            <table border="1" align="center" class="printTable browserTable">
                <tr>
                    <th bgcolor="#bfbfbf">Serviços</th>
                    <th bgcolor="#bfbfbf">Quantidade</th>
                </tr>
                @foreach($dataToTable as $processo)
                <tr>
                    <td>{{$processo['nome']}}</td>
                    <td>{{$processo['qtd']}}</td>
                </tr>
                @endforeach
            </table>
        </div>
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
