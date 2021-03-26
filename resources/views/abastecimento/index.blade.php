@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        <div class="col-md-12">
            <div class="col-md-2">
                <img style="width: 170px;" src="{{asset('img/'.$prefeitura[0]->logo)}}"/>
                {{--<img style="width: 170px;" src="{{asset('img/logo_jose_bonifacio.png')}}"/>--}}
            </div>
            <div class="col-md-10;" style="margin-top: 3%;">
                <p style="font-size: 112%;">{{$prefeitura[0]->nome}}</p>
                <p>Gestão de Abastecimento</p>
            </div>
        </div>
        @if(!isset($cota[0]->cota_litros))
            <form id="consulta" class="container" action="{{ route('getVeiculoAbastecimento') }}">
                <input id="mastercard" name="mastercard" value="0" hidden>
                <div class="col-md-12" style=" margin-bottom: 2%; margin-top: 1%;">
                    <div class="col-md-1">
                        Veículo:
                    </div>
                    <input class="col-md-3" id="codigo" name="codigo" onkeypress="return blockKey()">
                    {{--<input class="col-md-3" id="codigo" name="codigo">--}}
                    <button style="margin-left: 1%;width: 11%;" id="cartaomestre" class="btn btn-primary col-md-1"
                            title="cartaomestre">Cartão Mestre
                    </button>
                    @if(isset($posto))
                        <div class="col-md-2" style="width: 11%;">
                            Fornecedor:
                        </div>
                        <input hidden id="posto_id" name="posto_id" value="{{$posto->id}}">
                        <input class="col-md-4" id="fornecedor" name="fornecedor" value="{{$posto->nome}}" disabled>
                        <button style="margin-left: 2%;" id="historico" class="btn btn-primary col-md-1"
                                title="historico">Histórico
                        </button>
                    @else
                        <input hidden type="number" id="posto_id" name="posto_id" value="0">
                    @endif
                </div>
                <div class="col-md-12" style="border-width: 1px; border-style: solid; border-color: #5e5d5d;">
                </div>
                <div class="col-md-12" style="margin-top: 1%;">
                    <div class="col-md-3">
                        <p style="color: #1E90FF;">Dados do Veículo</p>
                    </div>
                    <div class="col-md-9">
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="veiculo_id" disabled>
                    <div id="img" class="col-md-3">
                    </div>
                    <div id="img_placa" class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            Placa:
                        </div>
                        <div class="col-md-12">
                            Modelo:
                        </div>
                        <div class="col-md-12">
                            Cor:
                        </div>
                        <div class="col-md-12">
                            Secretaria:
                        </div>
                        <div class="col-md-12">
                            Ano:
                        </div>
                        <div class="col-md-12">
                            Fabricante:
                        </div>
                        <div class="col-md-12">
                            Saldo em Litros:
                        </div>
                        <div class="col-md-12"
                             style="border-width: 1px; border-style: solid; border-color: #5e5d5d; width: 96%; height: 50px; margin-left: 4%; background-color: white">
                        </div>
                    </div>
                </div>
                <div class="col-md-12"
                     style="border-width: 1px; border-style: solid; border-color: #5e5d5d; margin-top: 1%;">
                </div>
                <div class="col-md-12" style="margin-top: 1%; margin-bottom: 3%;">
                    <div class="col-md-9">
                        <p style="color: #1E90FF;">Informar Dados do Abastecimento</p>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Kilometragem:
                        </div>
                        <div class="col-md-6">
                            <input type="number" id="kilometragem" name="kilometragem" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Qtd Litros:
                        </div>
                        <div class="col-md-6">
                            <input id="litros" name="litros" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Servidor:
                        </div>
                        <div class="col-md-6">
                            <input name="motorista" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Valor Unitário:
                        </div>
                        <div class="col-md-6">
                            <input id="valor_unitario" name="valor_unitario" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Tipo combustivel:
                        </div>
                        <div class="col-md-6">
                            <select name="tipo_combustivel" disabled>
                                <option value="1">Gasolina</option>
                                <option value="2">Etanol</option>
                                <option value="3">Disel</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            Valor Total:
                        </div>
                        <div class="col-md-6">
                            <input name="valortotal" id="valortotal" readonly
                                   style="border-width: 1px;border-style: solid;border-color: transparent;background: none;text-align: right;"
                                   disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center" style="margin-top: 80px">
                    <button class="btn btn-success" title="Salvar">Salvar</button>
                </div>
                @elseif(isset($veiculo))
                    <form class="container" method="post" action="{{ route('abastecimento.store') }}">
                        {!! csrf_field() !!}
                        @if(isset($mastercard))
                            <input id="mastercard" name="mastercard" value="{{$mastercard}}" hidden>
                            @else
                            <input id="mastercard" name="mastercard" value="0" hidden>
                            @endif

                        <div class="col-md-12" style="margin-bottom: 2%; margin-top: 1%;">
                            <div class="col-md-1">
                                Veículo:
                            </div>
                            <input class="col-md-3" id="codigo" name="codigo"
                                   value="{{$veiculo->codigo_barra or old('codigo')}}" readonly>
                            @if(isset($posto))
                                <div class="col-md-2" style="width: 11%;">
                                    Fornecedor:
                                </div>
                                <input hidden id="posto_id" name="posto_id" value="{{$posto->id}}">
                                <input class="col-md-4" id="fornecedor" name="fornecedor" value="{{$posto->nome}}"
                                       disabled>
                                <button style="margin-left: 4%;" id="historico" class="btn btn-primary col-md-1"
                                        title="historico">Histórico
                                </button>
                            @else
                                <input hidden type="number" id="posto_id" name="posto_id" value="0">
                            @endif
                            {{--<div class="col-md-2" style="width: 11%;">
                                Fornecedor:
                            </div>
                            <input class="col-md-4" id="fornecedor" name="fornecedor">--}}
                            @if(isset($mastercard))
                                <input id="mastercard" name="mastercard" value="{{$mastercard}}" hidden>
                            @else
                                <input id="mastercard" name="mastercard" value="0" hidden>
                            @endif
                        </div>
                        <input hidden name="veiculo_id" value="{{$veiculo->id}}">
                        <input hidden id="descricao" name="descricao" value="">
                        {{-- <input type="hidden" name="veiculo_id" value="{{$veiculo->id}}">--}}
                        <div class="col-md-12" style="border-width: 1px; border-style: solid; border-color: #5e5d5d;">
                        </div>
                        <div class="col-md-12" style="margin-top: 1%;">
                            <div class="col-md-3">
                                <p style="color: #1E90FF;">Dados do Veículo</p>
                            </div>
                            <div class="col-md-9">
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 1%;">

                            <div id="img" class="col-md-3">
                            </div>
                            <div id="img_placa" class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Placa:
                                </div>
                                <div id='lbl_placa' class="col-md-6">
                                    {{$veiculo->placa}}
                                </div>
                                <div class="col-md-6">
                                    Modelo:
                                </div>
                                <div id='lbl_modelo' class="col-md-6">
                                    {{$veiculo->modelo}}
                                </div>
                                <div  class="col-md-6">
                                    Cor:
                                </div>
                                <div id='lbl_cor' class="col-md-6">
                                    {{$veiculo->cor}}
                                </div>
                                <div class="col-md-6">
                                    Secretaria:
                                </div>
                                <div id='lbl_secretaria' class="col-md-6">
                                    Administração
                                </div>
                                <div class="col-md-6">
                                    Ano:
                                </div>
                                <div id='lbl_ano' class="col-md-6">
                                    {{$veiculo->ano}}
                                </div>
                                <div class="col-md-6">
                                    Fabricante:
                                </div>
                                <div id='lbl_fabricante' class="col-md-6">
                                    {{$veiculo->fabricante}}
                                </div>
                                <div class="col-md-12" style="font-size: 126%;">
                                    <b>Saldo em Litros:</b>
                                </div>
                                @if($cotadisponivel > 0)
                                    <div id='lbl_saldo_litros' class="col-md-12"
                                         style="border-width: 1px; border-style: solid; border-color: #5e5d5d; width: 96%; height: 50px; margin-left: 4%;font-size: 226%; text-align: center; background-color: #00fa9a">
                                        {{number_format ( $cotadisponivel , 2,',', ' ')}}
                                    </div>
                                @else
                                    <div class="col-md-12"
                                         style="border-width: 1px; border-style: solid; border-color: #5e5d5d; width: 96%; height: 50px; margin-left: 4%;font-size: 226%; text-align: center; background-color: #ffa07a">
                                        {{number_format ( $cotadisponivel , 2, ',', ' ')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12"
                             style="border-width: 1px; border-style: solid; border-color: #5e5d5d; margin-top: 1%;">
                        </div>
                        <div class="col-md-12" style="margin-top: 1%; margin-bottom: 3%;">
                            <div class="col-md-9">
                                <p style="color: #1E90FF;">Informar Dados do Abastecimento</p>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        Frentista:
                                    </div>
                                    <div class="col-md-6">
                                        <select name="frentista" id="frentista" value="{{old('frentista')}}">                                
                                            @foreach ($frentistas as $frentista)
                                                <option value="{{$frentista->nome}}">{{$frentista->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        Servidor:
                                    </div>
                                    <div class="col-md-6">
                                        <select name="motorista" id="motorista" value="{{old('motorista')}}">
                                            @foreach ($motoristas as $motorista)
                                                <option value="{{$motorista->nome}}">{{$motorista->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Kilometragem:
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="kilometragem" name="kilometragem"
                                           value="{{old('kilometragem')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Qtd Litros:
                                </div>
                                <div class="col-md-6">
                                    <input id="litros" name="litros" value="{{old('litros')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Valor Unitário:
                                </div>
                                <div class="col-md-6">
                                    <input id="valor_unitario" name="valor_unitario" id="valor_unitario"  value="{{old('valor_unitario')}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Tipo combustivel:
                                </div>
                                <div class="col-md-6">
                                    <select id="tipo_combustivel" name="tipo_combustivel" value="{{old('tipo_combustivel')}}">
                                        <option value="">Selecione o Combustível</option>
                                        @if (isset($tiposCombustivel))
                                            @foreach ($tiposCombustivel as $tipo)
                                                <option value="{{$tipo->descricao}}">{{$tipo->descricao}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    Valor Total:
                                </div>
                                <div class="col-md-6">
                                    <input name="valortotal" id="valortotal" 
                                           style="border-width: 1px;border-style: solid;border-color: transparent;background: none;text-align: right;" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center" style="margin-top: 80px">
                            <button id="salvar" class="btn btn-success" title="Salvar">Salvar</button>
                        </div>
                        {{--<form class="container" action="{{ route('getVeiculoAbastecimento') }}">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        Código do Veículo:
                                    </div>
                                    <input class="col-md-3" id="codigo" name="codigo">
                                </div>--}}
                        @endif
                    </form>

            <div id="conteudo_comprovante"></div>

                    <script>
                        var timer;

                        function blockKey(e) {
                            /*
                            //console.log("começo vai...");
                            clearTimeout(timer);
                            timer = setTimeout(function () {
                                $('#codigo').val('');
                            }, 100);
                            */
                        }

                        $(document).ready(function () {

                            $('#codigo').attr('autocomplete', 'off');

                            $("#codigo").bind('paste', function (e) {
                                e.preventDefault();
                            });

                            $("select").select2();
                            var readonly = $("#codigo").attr("readonly");
                            var send = 0;
                            var veiculoid = "{{isset($veiculo) ? $veiculo->id : 0}}";
                            var cotaprova = "{{isset($cotadisponivel) ? $cotadisponivel : -9999}}";


                            //console.log(veiculoid);
                            $(document).on("click", "#historico", function (event) {
                                event.preventDefault();
                                if ($('#posto_id').val() !== 0) {
                                    window.location = '{{ url('abastecimentoHistorico') }}';
                                }
                            });


                            $("#kilometragem").blur(function () {
                                $.getJSON("{{route('getKilometragem')}}", {
                                    kilometragem: $("#kilometragem").val(),
                                    veiculo_codigo: $("#codigo").val()
                                }, function (data) {
                                    console.log(data[0].kilometragem);
                                    if (data[0].kilometragem >= $("#kilometragem").val()) {
                                        swal({
                                            type: 'error',
                                            title: 'Desculpe!',
                                            html: "<span style='font-size:15px;'>Quilometragem atual é menor que a anterior,se estiver correta, favor informar para a administração o número desta placa e solicitar autorização para prosseguir com este abastecimento!</span>"
                                        })
                                        $('#kilometragem').val("");
                                        console.log("é maior que a que tem no banco");
                                        //$('#kilometragem').prop("readonly", true);
                                    }
                                });
                            });

                            //cancela comando pelo enter
                            $(document).keypress(function (e) {
                                if (e.which == 13 || e.keyCode == 13) {
                                    e.preventDefault();
                                }
                            });

                            if (readonly != "readonly") {
                                $("#codigo").keypress(function (event) {
                                    if (event.keyCode == 13) {
                                        event.preventDefault();
                                        $("#consulta").submit();
                                    }
                                });
                            }

                            $(document).on("click", "#salvar", function (event) {
                                event.preventDefault();
                                //filtro
                                if (!$("#motorista").val()) {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe o nome do motorista!</span>"
                                    })
                                } if (!$("#frentista").val()) {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe o nome do frentista!</span>"
                                    })
                                } else if (!$("#kilometragem").val()) {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe a kilometragem atual!</span>"
                                    })
                                } else if (cotaprova == -9999) {
                                    //tratar quando vem saldo negativo
                                } else if ($("#litros").val() == "0,00") {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe a quantidade de litros!</span>"
                                    })
                                } else if ($("#valor_unitario").val() == "0,00") {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe o valor unitário!</span>"
                                    })
                                } else if ($("#tipo_combustivel").val() == "") {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Informe o tipo de combustível!</span>"
                                    })
                                } else if (parseFloat(cotaprova) < parseFloat($('#litros').val().replace(",", "."))) {
                                    swal({
                                        type: 'error',
                                        title: 'Desculpe!',
                                        html: "<span style='font-size:15px;'>Volume ultrapassa volume disponível!</span>"
                                    })
                                } else {
                                    //VERIFICA SENHA DO FRENTISTA DEPOIS MOTORISTA DEPOIS SE VEICULO É EQUIPAMENTO E POR FIM MANDA FORMULARIO
                                    $.get("{{route('getFrentistaCredencial')}}", {
                                        frentista: $("#frentista").val()
                                    }, function (data) {
                                        if (data == "naotemsenha") {
                                            swal.mixin({
                                                input: 'text',
                                                confirmButtonText: 'Confirmar',
                                                showCancelButton: true
                                            }).queue([
                                                {
                                                    title: 'Cadastro de senha!',
                                                    input: 'password',
                                                    html: "<span style='font-size:15px;'>Digite uma senha para este frentista!</span>",
                                                    inputAttributes: {
                                                        maxlength: 10,
                                                        autocapitalize: 'off',
                                                        autocorrect: 'off'
                                                    }
                                                }
                                            ]).then((result) => {
                                                if (result.value[0].length > 3) {
                                                    $.post("frentistaSenhaStore", {
                                                        senha: result.value[0],
                                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                                        frentista: $("#frentista").val()
                                                    }, function (data) {
                                                        swal({
                                                            type: 'success',
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        });
                                                        //chama verificação do motorista
                                                        verifyMotorista();
                                                    });
                                                } else {
                                                    swal({
                                                        type: 'error',
                                                        title: 'A senha deve possuir no mínimo 4 caracteres!',
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    });
                                                }
                                            });
                                        } else {
                                            swal.mixin({
                                                input: 'text',
                                                confirmButtonText: 'Confirmar',
                                                showCancelButton: true
                                            }).queue([
                                                {
                                                    title: 'Verificação de senha!',
                                                    input: 'password',
                                                    html: "<span style='font-size:15px;'>Digite a senha para este frentista!</span>",
                                                    inputAttributes: {
                                                        maxlength: 10,
                                                        autocapitalize: 'off',
                                                        autocorrect: 'off'
                                                    }
                                                }
                                            ]).then((result) => {
                                                if (result.value) {
                                                    $.get("frentistaSenhaCheck", {
                                                        senha: result.value[0],
                                                        frentista: $("#frentista").val()
                                                    }, function (data) {
                                                        if (data == "Senha Valida") {
                                                            swal({
                                                                type: 'success',
                                                                showConfirmButton: false,
                                                                timer: 1500
                                                            });
                                                            verifyMotorista();
                                                        } else {
                                                            swal({
                                                                type: 'error',
                                                                title: 'Por favor digite uma senha válida!',
                                                                showConfirmButton: false,
                                                                timer: 1500
                                                            })
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                    // FIM VERIFICA SENHA DO FRENTISTA DEPOIS MOTORISTA DEPOIS SE VEICULO É EQUIPAMENTO E POR FIM MANDA FORMULARIO
                                }
                            });

                            function verifyMotorista(){

                                $.get("{{route('getMotoristaCredencial')}}", {
                                    motorista: $("#motorista").val()
                                }, function (data) {
                                    if (data == "naotemsenha") {
                                        swal.mixin({
                                            input: 'text',
                                            confirmButtonText: 'Confirmar',
                                            showCancelButton: true
                                        }).queue([
                                            {
                                                title: 'Cadastro de senha!',
                                                input: 'password',
                                                html: "<span style='font-size:15px;'>Digite uma senha para este perfil de motorista!</span>",
                                                inputAttributes: {
                                                    maxlength: 10,
                                                    autocapitalize: 'off',
                                                    autocorrect: 'off'
                                                }
                                            }
                                        ]).then((result) => {
                                            if (result.value[0].length > 3) {
                                                $.post("motoristaSenhaStore", {
                                                    senha: result.value[0],
                                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                                    motorista: $("#motorista").val()
                                                }, function (data) {
                                                    swal({
                                                        type: 'success',
                                                        title: data,
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    });
                                                    verifyEquipamento()
                                                });
                                            } else {
                                                swal({
                                                    type: 'error',
                                                    title: 'A senha deve possuir no mínimo 4 caracteres!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            }
                                        });
                                    } else {
                                        swal.mixin({
                                            input: 'text',
                                            confirmButtonText: 'Confirmar',
                                            showCancelButton: true
                                        }).queue([
                                            {
                                                title: 'Verificação de senha!',
                                                input: 'password',
                                                html: "<span style='font-size:15px;'>Digite a senha para este perfil de motorista!</span>",
                                                inputAttributes: {
                                                    maxlength: 10,
                                                    autocapitalize: 'off',
                                                    autocorrect: 'off'
                                                }
                                            }
                                        ]).then((result) => {
                                            if (result.value) {
                                                $.get("motoristaSenhaCheck", {
                                                    senha: result.value[0],
                                                    motorista: $("#motorista").val()
                                                }, function (data) {
                                                    if (data == "Senha Valida") {
                                                        swal({
                                                            type: 'success',
                                                            title: 'Senha válida! Volume Autorizado!',
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        })
                                                        verifyEquipamento()
                                                    } else {
                                                        swal({
                                                            type: 'error',
                                                            title: 'Por favor digite uma senha válida!',
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        })
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }

                            function verifyEquipamento(){
                                //VERIFICA TIPO VEICULO EQUIPAMENTO E FINALIZA ENVIANDO FORMULARIO
                                $.get("{{route('getVeiculoEquipamento')}}", {
                                    veiculo_codigo: $("#codigo").val()
                                }, function (data) {

                                    if(data[0].modelo == "Equipamentos Diversos"){
                                        swal.mixin({
                                            input: 'text',
                                            confirmButtonText: 'Confirmar',
                                            showCancelButton: true
                                        }).queue([
                                            {
                                                title: 'Descrição do equipamento!',
                                                input: 'text',
                                                html: "<span style='font-size:15px;'>Digite qual equipamento será destinado o combustivel!</span>",
                                                inputAttributes: {
                                                    maxlength: 100,
                                                    autocapitalize: 'off',
                                                    autocorrect: 'off'
                                                }
                                            }
                                        ]).then((result) => {

                                            if (result.value[0].length > 2) {
                                                swal({
                                                    type: 'success',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });

                                                //console.log(result.value[0]);

                                                $("#descricao").attr("value",result.value[0]);
                                                Comprovante('form');
                                            } else {
                                                swal({
                                                    type: 'error',
                                                    title: 'Campo não preenchido, tente novamente!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            }
                                        });
                                    }else
                                    {
                                        Comprovante('form');
                                    }
                                });
                                //FIM VERIFICAÇÃO TIPO VEICULO EQUIPAMENTO
                            }

                            $(document).on("click", "#cartaomestre", function (event) {
                                event.preventDefault();
                                swal.mixin({
                                    input: 'text',
                                    confirmButtonText: 'Confirmar',
                                    showCancelButton: true
                                }).queue([
                                    {
                                        title: 'Desbloqueio Cartão Mestre!',
                                        input: 'password',
                                        html: "<span style='font-size:15px;'>Cartão mestre:</span>",
                                        inputAttributes: {
                                            maxlength: 10,
                                            autocapitalize: 'off',
                                            autocorrect: 'off'
                                        }
                                    }
                                ]).then((result) => {
                                    if (result) {
                                        $.post("consultaCartaoMestre", {
                                            cartaomestre: result.value[0],
                                            _token: $('meta[name="csrf-token"]').attr('content')
                                        }, function (data) {

                                            if(data != "Cartão Invalido"){
                                                swal({
                                                    type: 'success',
                                                    title: "Cartão Valido",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                $('#codigo').attr('onkeypress','false');
                                                $('#mastercard').attr('value',data.id);

                                            }else{
                                                swal({
                                                    type: 'error',
                                                    title: "Cartão Invalido",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            }

                                        });

                                    } else {
                                        swal({
                                            type: 'error',
                                            title: 'Cartão mestre inválido!',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                });
                            });



                            if (veiculoid != "0") {
                                $.get("abastecimento/downloadImagemVeiculo?veiculo_id=" + veiculoid, {}, function (data) {
                                }).done(function (data) {
                                    $("#img").empty();
                                    $("#img").append("<img src='" + data + "' style='width: 260px; height: 224px;'/>");
                                }).catch(function (error) {
                                    $("#img").empty();
                                });
                                $.get("abastecimento/downloadImagemVeiculoPlaca?veiculo_id=" + veiculoid, {}, function (data) {
                                }).done(function (data) {
                                    $("#img_placa").empty();
                                    $("#img_placa").append("<img src='" + data + "' style='width: 260px; height: 224px;'/>");
                                }).catch(function (error) {
                                    $("#img_placa").empty();
                                });
                            }

                            /* $("#codigo").keypress(function(event) {
                                 if (event.keyCode == 13) {
                                     event.preventDefault();
                                     //alert("deu certo");
                                     $("#consulta").submit();
                                 }
                             });*/

                            $("#codigo").focus();

                            if ($("#litros").val() == "") {
                                $("#litros").val(0);
                            }
                            $("#litros").inputmask('decimal', {
                                'alias': 'numeric',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 2,
                                'radixPoint': ',',
                                'digitsOptional': false,
                                'allowMinus': false,
                            });

                            if ($("#valor_unitario").val() == "") {
                                $("#valor_unitario").val(0);
                            }
                            $("#valor_unitario").inputmask('decimal', {
                                'alias': 'numeric',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 2,
                                'radixPoint': ',',
                                'digitsOptional': false,
                                'allowMinus': false,
                            });

                            if ($("#valortotal").val() == "") {
                                $("#valortotal").val(0);
                            }
                            $("#valortotal").inputmask('decimal', {
                                'alias': 'numeric',
                                'groupSeparator': '.',
                                'autoGroup': true,
                                'digits': 2,
                                'radixPoint': ',',
                                'digitsOptional': false,
                                'allowMinus': false,
                            });
                            $(document).on('keyup', '#litros', function () {
                                $("#valortotal").val(parseFloat($("#litros").val().toString().replace(/\./g, '').replace(',', '.')) * parseFloat($("#valor_unitario").val().toString().replace(/\./g, '').replace(',', '.')));
                            });
                            $(document).on('keyup', '#valor_unitario', function () {
                                $("#valortotal").val(parseFloat($("#litros").val().toString().replace(/\./g, '').replace(',', '.')) * parseFloat($("#valor_unitario").val().toString().replace(/\./g, '').replace(',', '.')));

                            });

                        });

                        function FormSubmit(form)
                        {
                            $(form).submit();                    
                        }
                        
                        function Comprovante(form)
                        {
                            swal.mixin(
                            {
                                confirmButtonText: 'Emitir',
                                cancelButtonText: 'Não Emitir',
                                 showCancelButton: true
                            })
                            .queue(
                            [{
                                title: 'Emissão de Comprovante',
                            }]).then((result) =>
                            {
                                if (result.value)
                                {
                                    $.get("{{route('setCompAbastecimento')}}",
                                    {
                                        fornecedor: $("#fornecedor").val(),
                                        placa: $("#lbl_placa").html(),
                                        modelo: $("#lbl_modelo").html(),
                                        cor: $("#lbl_cor").html(),
                                        secretaria: $("#lbl_secretaria").html(),
                                        ano: $("#lbl_ano").html(),
                                        fabricante: $("#lbl_fabricante").html(),
                                        saldo_litros: $("#lbl_saldo_litros").html(),

                                        frentista: $("#frentista").val(),
                                        servidor: $("#motorista").val(),
                                        kilometragem: $("#kilometragem").val(),
                                        qtd_litros: $("#litros").val(),
                                        valor_unitario: $("#valor_unitario").val(),
                                        tipo_combustivel: $("#tipo_combustivel").val(),
                                        valor_total: $("#valortotal").val()
                                    },
                                    function(data)
                                    {
                                        setTimeout(() => {
                                            $("#conteudo_comprovante").html(data);
                                            var divToPrint = document.getElementById("conteudo_comprovante");
                                            var newWin = window.open('about:blank', '_blank', 'resizable=1,scrollbars=1');
                                            newWin.document.write(divToPrint.outerHTML);
                                            newWin.document.close();
                                            $("#conteudo_comprovante").empty();
                                            FormSubmit(form);
                                        }, 1000)
                                    });
                                }
                                else
                                {
                                    FormSubmit(form);
                                }
                            });
                        }

                    </script>

@endsection