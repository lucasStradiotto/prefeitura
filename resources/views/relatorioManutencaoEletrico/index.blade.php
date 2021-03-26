@extends('layouts.app')

@section('content')
    <style>
        .container {
            width: 80vw;
        }

        .full-width{
            width: 80vw;
            display: inline-flex;
        }

        .img-logo-box{
            width: 20vw;
        }

        .img-logo-box img{
            width: 120px;
        }

        .headers{
            text-align: center;
            width: 60vw;
            margin-left: -10vw;
        }

        .solicitacao-dados-box {
            width: 80vw;
            margin-top: 1vh;
            display: inline-flex;
        }

        .solicitacao-labels{
            width: 20vw;
            margin: 0;
        }

        .solicitacao-dados{
            border: 2px solid black;
            border-radius: 10px;
            width: 50vw;
            margin: 0;
            padding: 1vw;
        }

        .foto-mapa-box {
            width: 70vw;
            display: inline-flex;
        }

        .foto-mapa {
            width: 35vw;
        }

        .img-box{
            border: 2px solid black;
            border-radius: 10px;
            width: 35vw;
            height: 45vw;
            text-align: center;
        }
        .img-box img{
            padding-top: 1vw;
            width: 30vw;
            height: 43vw;
        }

        .map-box{
            width: 45vw;
            height: 45vw;
            border: 2px solid black;
            border-radius: 10px;
            text-align: center;
        }
        .map-box iframe{
            width: 43vw;
            height: 43vw;
        }

        .servicos-executados-label {
            margin-top: 2vh;
        }

        .servicos-executados-box{
            border: 2px solid black;
            padding: 75px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .data-box{
            border: 2px solid black;
            border-radius: 10px;
            width: 40vw;
            text-align: center;
        }

        .responsavel-box{
            border: 2px solid black;
            padding: 12px;
            border-radius: 10px;
            width: 40vw;
            text-align: center;
        }

        .footer {
            width: 80vw;
            display: inline-flex;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <title>{{$title}}</title>

    <button id="print" class="no-print btn btn-primary">Imprimir</button>

    <div class="container">
        <div class="full-width">
            <div class="img-logo-box">
                <img src="{{ URL::asset('img/'.$prefeitura[0]->logo) }}"/>
            </div>
            <div class="headers">
                <p>{{$prefeitura[0]->nome}}</p>
                <p>ORDEM DE SERVIÇO</p>
                <p>Manutenção da Rede Elétrica</p>
            </div>
        </div>

        <div>
            <div class="solicitacao-dados-box">
                <div class="solicitacao-labels">
                    <p>Anomalia:</p>
                </div>
                <div class="solicitacao-dados">
                    {{$registros[0]->tipo_anomalia}}
                </div>
            </div>
            <div class="solicitacao-dados-box">
                <div class="solicitacao-labels">
                    <p>Solicitante:</p>
                </div>
                <div class="solicitacao-dados">
                    {{$registros[0]->nome_solicitante}}
                </div>
            </div>
            <div class="solicitacao-dados-box">
                <div class="solicitacao-labels">
                    <p>Endereço:</p>
                </div>
                <div class="solicitacao-dados">
                    {{$registros[0]->nome_rua}},{{$registros[0]->numero_casa}} - {{$registros[0]->nome_bairro}}
                </div>
            </div>
            <div class="foto-mapa-box">
                <div class="foto-mapa">
                    <p>Foto do Local:</p>
                    <div class="img-box">
                        <img src="{{$dashboardAssets . $registros[0]->foto}}"/>
                    </div>
                </div>
                <div class="foto-mapa">
                    <p>Localização Mapa:</p>
                    <div id="map-box" class="map-box"></div>
                </div>
            </div>
            <div class="servicos-executados-label">
                <p>Descrição dos Serviços Executados:</p>
            </div>

            <div class="servicos-executados-box"></div>

            <div class="footer">
                <div class="data-box">
                    <div><p>Data</p></div>
                    <div>{{$registros[0]->data->format('d/m/Y')}}</div>
                </div>
                <div class="responsavel-box">
                    <div><p>Responsavel</p></div>
                    <div>&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var rua = "{{$registros[0]->nome_rua}}";
            var numero = "{{$registros[0]->numero_casa}}";
            var cidade = "{{$registros[0]->cidade}}";
            var estado = "SP";
            var addr = rua + " " + numero + ", " + cidade + " " + estado;
            console.log(addr);
            var embed= "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' ";
            embed += "src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( addr ) + "&amp;output=embed&amp;z=14'></iframe>";

            $('#map-box').html(embed);
            
            $("#print").click(function(){
                window.print();
            });
        });
    </script>
@endsection