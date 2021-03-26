@extends('layouts.app')

@section('content')
    <style>
        .header-div{
            display: inline-flex;
        }

        .header-texts{
            text-align: center;
            width: 70vw;
        }

        .line-divider{
            height: 1px;
            background-color: #000;
        }

        .parameters-div{
            margin-bottom: 2vh;
            text-align: center;
        }

        .img-div{
            width: 10vw;
        }

        .img-logo{
            width: 20vw;
            height: 10vw;
        }

        .tabela-dados{
            width: 80vw;
        }

        .tabela-dados tr{
            border-bottom: solid 1px black;
        }

        .velocidade-td{
            text-align: right !important;
        }

        .endereco-td{
            text-align: left !important;
        }

        .tabela-dados td,
        .tabela-dados th{
            text-align: center;
            font-size: 0.7em;
        }

        .no-content-text{
            text-align: center;
            text-decoration-line: underline;
            text-decoration-color: red;
        }

        @media print{
            .no-print{
                display: none;
            }

            .header-div{
                width: 21cm;
            }

            .img-div{
                width: 5cm;
            }

            .header-texts{
                width: 16cm;
                margin-top: 0.7cm;
            }

            .img-logo{
                width: 5cm;
                height: 5cm;
            }

            .tabela-dados{
                width: 20cm;
            }
        }
    </style>
    <title>{{$title}}</title>

    <div class="no-print">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    <div class="header-div">
        <div class="img-div">
            <img alt="Sem imagem" class="img-logo" src="{{asset('img/'.$cliente->logo)}}"/>
        </div>
        <div class="header-texts">
            <h2><strong>{{$cliente->nome}}</strong></h2>
            <p>{{$cliente->endereco}}</p>
            <p>{{$cliente->cnpj}}</p>
        </div>
        <div class="btn-print">
            <button class="btn btn-primary no-print" onclick="imprimir()">Imprimir</button>
        </div>
    </div>
    <hr class="line-divider"/>
    <div class="parameters-div">
        <h3>Situação do veículo</h3>
        <h4>Período: <strong>{{$inicio}}</strong> até <strong>{{$fim}}</strong></h4>
        <h4>Veículo selecionado: <strong>{{$placa}} ({{$prefixo}})</strong></h4>
    </div>
    <div class="table-content">
        @if(count($rastreamentosUteis) > 0)
            <table class="tabela-dados">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th class="endereco-td">Local</th>
                        <th>Tempo</th>
                        <th class="velocidade-td">Velocidade</th>
                        <th>Ingição</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rastreamentosUteis as $rastreamento)
                    <tr>
                        <td>{{$rastreamento->data}}</td>
                        <td>{{$rastreamento->hora}}</td>
                        <td class="endereco-td">
                            @if ($rastreamento->rua) {{$rastreamento->rua}}, @endif
                            @if($rastreamento->cidade) {{$rastreamento->cidade}} - @endif
                            @if($rastreamento->estado) {{$rastreamento->estado}} @endif
                        </td>
                        <td>
                            @if ($rastreamento->ignicao == "Desligada") {{gmdate("H:i", $rastreamento->tempo)}} @endif
                        </td>
                        <td class="velocidade-td">{{$rastreamento->velocidade}}Km/H</td>
                        <td>{{$rastreamento->ignicao}}</td>
                        <td>{{$rastreamento->velocidade == 0 ? 'Parado' : 'Andando'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3 class="no-content-text">Não foram encontrados registros correspondentes para estes parâmetros.</h3>
        @endif
    </div>

    <script>
        function imprimir(){
            window.print();
        }
    </script>
@endsection