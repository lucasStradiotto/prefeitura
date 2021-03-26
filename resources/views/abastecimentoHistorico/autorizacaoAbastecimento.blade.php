@extends('layouts.app')

@section('content')
    <style>

        @media print {

            h1 {
                font-size: 0.8cm !important;
                margin-left: 2cm !important;

            }

            img {
                width: 100px !important;
            }

            .motorista {
                width: 3cm !important;
                float: left;
            }

            .width-2 {
                width: 2cm !important;

            }

            .float-left {
                float: left !important;
            }

            .position-absolute{
                position: absolute !important;
            }
            .margin-left-0 {
                margin-left: 0cm !important;
            }
            .margin-left-5 {
                margin-left: 5cm !important;
            }
            .margin-left-1 {
                margin-left: 1cm !important;
            }

            .teste {
                width: 13cm !important;
            }

            .width-1-0 {
                width: 1.0cm !important;
            }

            .width-1-2 {
                width: 1.2cm !important;
            }

            .width-1-3 {
                width: 1.3cm !important;
            }

            .width-1-5 {
                width: 1.5cm !important;
            }

            .width-1-8 {
                width: 1.8cm !important;
            }

            .width-2-0 {
                width: 2.0cm !important;
            }

            .width-2-2 {
                width: 2.2cm !important;
            }

            .width-2-3 {
                width: 2.3cm !important;
            }

            .width-2-5 {
                width: 2.5cm !important;
            }

            .width-2-6 {
                width: 2.6cm !important;
            }

            .width-2-8 {
                width: 2.8cm !important;
            }

            .width-3 {
                width: 3cm !important;
            }

            .width-3-5 {
                width: 3.5cm !important;
            }

            .width-5-5 {
                width: 5.5cm !important;
            }
            .width-6 {
                width: 6cm !important;
            }
            .width-15 {
                width: 15cm !important;
            }

            .divtab{
                height: 1.5cm !important;
            }
            .divtab2 {
                height: 3cm !important;
            }

            .tabela {
                margin-left: 19px !important;
                margin-top: 14px !important;
            }
            .div2 {
                margin-top: 1.5cm !important;
            }
        }

        h1 {
            font-size: 42px;
        }

    </style>


    <title>{{$title}}</title>
    <div style="margin-left: 6%;margin-top: 8%;margin-bottom: 5%;">
        <img style="width: 170px;float: left;" src="{{asset('img/'.$prefeitura[0]->logo)}}"/>
        <p style="font-size: 174%;margin-left: 20%;">{{$prefeitura[0]->nome}}</p>
        <p style="font-size: 148%;margin-left: 20%;">Gestão de Abastecimento</p>
        {{--<img style="width: 170px;" src="{{asset('img/logo_jose_bonifacio.png')}}"/>--}}
    </div>
    <div style="margin-left: 6%;margin-top: 8%;margin-bottom: 5%;">
        <h1 style=" margin-left: 19%;">
            Autorização de Abastecimento
        </h1>
    </div>
    @if(isset($abastecimento))
        <div style="margin-bottom: 2%;">
            <p class="motorista" style="width: 9%; float: left">Motorista:</p>
            {{$abastecimento->motorista}}
        </div>
        <div>
            <p>Dados Veículos</p>
        </div>
        <div class="divtab" style="border: 1px solid; width: 100%; height: 62px;">
            <div class="tabela" style="margin-left: 19px;margin-top: 14px;">
                <p class="width-1-8 float-left margin-left-0" style="margin-left: 10%;width: 6%; float:left">Modelo:</p>
                <p class="width-2 float-left" style="width: 9%; float:left"> {{$abastecimento->modelo}}</p>
                <p class="width-2-3 float-left" style="width: 9%; float:left"> Fabricante:</p>
                <p class="width-2-3 float-left" style="width: 9%; float:left"> {{$abastecimento->fabricante}}</p>
                <p class="width-1-0 float-left" style="width: 4%; float:left"> Cor:</p>
                <p class="width-1-5 float-left" style="width: 9%; float:left"> {{$abastecimento->cor}}</p>
                <p class="width-1-0 float-left" style="width: 4%; float:left"> Ano:</p>
                <p class="width-1-2 float-left" style="width: 9%; float:left"> {{$abastecimento->ano}}</p>
                <p class="width-1-2 float-left" style="width: 5%; float:left"> Placa:</p>
                <p class="width-1-0 float-left" style="width: 9%; float:left"> {{$abastecimento->placa}}</p>
            </div>

        </div>

        <div style="margin-top: 4%">
            <p>Dados Abastecimento</p>
        </div>
        <div class="divtab2" style="border: 1px solid;width: 100%;height: 122px;">
            <div class="tabela" style="margin-left: 19px;margin-top: 14px;">
                <p class="width-1-8 float-left margin-left-0" style="margin-left: 10%;width: 5%;float:left;">Posto:</p>
                <p class="width-15 float-left" style="width: 84%;float:left;">{{$abastecimento->nome_fantasia}}</p>
                <p class="width-1-2 float-left margin-left-0" style="width: 5%;margin-left: 10%;float:left;">Data:</p>
                <p class="width-5-5 float-left" style="width: 25%;float:left;">{{$abastecimento->data}}</p>
                <p class="width-2-6 float-left" style="width: 9%;float:left;">Combustivel:</p>
                <p class="width-2-0 float-left" style="width: 15%;float:left;">{{$abastecimento->tipo_combustivel}}</p>
                <p class="width-3 float-left margin-left-0" style="width: 11%;float:left;">Kilometragem:</p>
                <p class="width-2-5 float-left" style="width: 24%;float:left;">{{$abastecimento->kilometragem}}</p>
            </div>
            <div class="tabela" style="margin-left: 19px; margin-top: 14px;">
                <p class="width-1-5 float-left margin-left-0" style="width: 5%; float:left; margin-left: 10%;">Litros:</p>
                <p class="width-1-5 float-left" style="width: 14%;float:left;">{{$abastecimento->litros}}</p>
                <p class="width-3 float-left" style="width: 11%;float:left;">Valor unitario:</p>
                <p class="width-1-0 float-left" style="width: 16%;float:left;">{{$abastecimento->valor_unitario}}</p>
                <p class="width-2-5 float-left" style="width: 11%;float:left;">Valor Total:</p>
                <p class="width-1-0 float-left" style="width: 18%;float:left;">{{$valortotal}}</p>
            </div>
        </div>

        <div style="width: 100%;height: 67px;">
            <div>
                <p class="margin-left-5" style="margin-left: 35%;width: 5%;margin-top: 7%;">
                    ________________________________________________</p>
                <p style="margin-left: 45%;;width: 5%;float:left;">Assinatura</p>
            </div>
        </div>

    @endif
    <script>
        $(document).ready(function () {
            window.print();
        });
    </script>
@endsection