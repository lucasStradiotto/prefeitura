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
            width: 10vw;
            height: 10vw;
        }

        .tabela-dados{
            width: 80vw;
        }

        .tabela-dados tr{
            border-bottom: solid 1px black;
        }

        .right-td{
            text-align: right !important;
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
        <h3>Autonomia</h3>
        <h4>Mês: <strong>{{$mes}}</strong></h4>
        <h4>Ano: <strong>{{$ano}}</strong></h4>
        <h4>Veículo selecionado: <strong>
            @if ($placa) {{$placa}} @else Todos os veículos @endif
        </strong></h4>
    </div>
    <div class="table-content">
        @if(count($rawAbastecimentos) > 0)
            <table class="tabela-dados">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th class="right-td">KM Inicial</th>
                        <th class="right-td">KM Final</th>
                        <th class="right-td">KM Rodados</th>
                        <th class="right-td">Litros</th>
                        <th class="right-td">Autonomia (KM/L)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rawAbastecimentos as $abastecimento)
                    <tr>
                        <td>{{$abastecimento->placa}}</td>
                        <td class="right-td">{{$abastecimento->minimo}}</td>
                        <td class="right-td">{{$abastecimento->maximo}}</td>
                        <td class="right-td">{{$abastecimento->km}}</td>
                        <td class="right-td">{{$abastecimento->litros}}</td>
                        <td class="right-td">{{number_format($abastecimento->autonomia, 2)}}</td>
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