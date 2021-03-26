@extends('layouts.app')

@section('styles')

    @parent
    <style type="text/css">
        .header {
            width: 100%;
            height: 200px;
        }

        .logo-prefeitura {
            float: left;
        }

        .logo-prefeitura img {
            width: 150px;
            height: auto;
        }

        .txt-header {
            float: left;
        }

        .txt-header h1,
        h4,
        h5 {
            color: black;
            font-weight: bold;
            margin-left: 5%;
        }

        .txt-header h1 {
            width: 100%;
        }

        .height30px {
            height: 30px;
        }

        .optionGroup {
            font-weight: bold;
            font-style: italic;
        }

        .optionChild {
            padding-left: 15px;
        }

        .full-width {
            width: 99vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        @page {
            size: A4 landscape;
        }

        /*CSS da pagina de filtros que saira na impreesao*/
        .filter-div{
            width: 80vw;
            margin-left: 5vw;
            display: none;
        }

        .each-filter{
            display: inline-flex;
            margin-top: 1vh;
        }

        .filter-label{
            font-weight: bold;
            padding-top: 2vh;
            padding-right: 1vw;
            padding-left: 1vw;
            width: 10vw;
            text-align: right;
        }

        .bordered-div{
            border: solid 1px black;
            text-align: center;
            padding: 1vh;
        }

        .secretarias-div{
            width: 30vw;
            height: auto;
        }

        .servidor-div{
            width: 30vw;
            height: auto;
        }

        .veiculos-div{
            width: 15vw;
            height: auto;
        }

        .periodo-label{
            font-weight: bold;
            padding-top: 2vh;
            padding-right: 1vw;
            padding-left: 1vw;
            width: 5vw;
            text-align: right;
        }

        .periodo-div{
            width: 10vw;
            height: auto;
            margin-left: 1vw;
        }

        .combustivel-label{
            font-weight: bold;
            padding-top: 2vh;
            padding-right: 1vw;
            padding-left: 1vw;
            width: 15vw;
            text-align: right;
        }

        .combustivel-div{
            width: 13vw;
            height: auto;
        }

        .posto-div{
            width: 70vw;
            height: auto;
        }

        .litros-div{
            width: 16.7vw;
            height: auto;
        }

        /*STYLE DO LOADING*/
        .lds-spinner {
            color: black;
            display: inline-block;
            position: fixed;
            /*width: 64px;*/
            /*height: 64px;*/
            width: 128px;
            height: 128px;
            z-index: 1;
            left: 45vw;
            top: 45vh;
        }
        .lds-spinner div {
            /*transform-origin: 32px 32px;*/
            transform-origin: 64px 64px;
            animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
            content: " ";
            display: block;
            position: absolute;
            /*top: 3px;*/
            /*left: 29px;*/
            top: 6px;
            left: 58px;
            /*width: 5px;*/
            /*height: 14px;*/
            width: 10px;
            height: 28px;
            border-radius: 20%;
            background: black;
        }
        .lds-spinner div:nth-child(1) {
            transform: rotate(0deg);
            animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
            transform: rotate(30deg);
            animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
            transform: rotate(60deg);
            animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
            transform: rotate(90deg);
            animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
            transform: rotate(120deg);
            animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
            transform: rotate(150deg);
            animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
            transform: rotate(180deg);
            animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
            transform: rotate(210deg);
            animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
            transform: rotate(240deg);
            animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
            transform: rotate(270deg);
            animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
            transform: rotate(300deg);
            animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
            transform: rotate(330deg);
            animation-delay: 0s;
        }
        @keyframes lds-spinner {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .body-while-loading{
            overflow: hidden;
            opacity: 0.5;
            pointer-events: none;
        }
        /*FIM DO LOADING*/

        @media print{
            .teste{
                width: 800px;
                height: 500px;
            }
            .fleft{
                float: left;
            }
            .basedados{
                width: 230px;
            }
            .display-none{
                display: none;
            }

            /*CSS da pagina de filtros que saira na impreesao*/
            .filter-div{
                width: 80vw;
                margin-left: 5vw;
                display: block;
            }
        }
    </style>
    <style type="text/css" media="print">
        html, body {
            width: 210mm;
            height: 297mm;
            margin: 0 0 0 20mm;
            box-shadow: none;
            font-size: 8pt;
        }

        .no-print,
        .no-print * {
            display: none !important;
        }

        table {
            page-break-inside: auto;
        }
    </style>
@endsection

@section('content')
    <div class="full-width">

        @if(isset($prefeitura) && isset($prefeitura->nome))
        <div style="margin: 0 auto; text-align: center">
            <div class="header">
                <div class="logo-prefeitura">
                    <img style="width: 170px;" src="{{asset('img/'.$prefeitura->logo)}}"/>
                </div>
                <div id="texto" class="txt-header" style="text-align: center;"></div>
            </div>
        </div>
        @endif

        <div class="filter-div">
            <div class="each-filter">
                <p class="filter-label">Secretaria: </p>
                <div class="bordered-div secretarias-div" id="filter-secretaria"></div>
                <p class="filter-label">Setor: </p>
                <div class="bordered-div secretarias-div" id="filter-setores"></div>
            </div>
            <div class="each-filter">
                <p class="filter-label">Sub Setor: </p>
                <div class="bordered-div secretarias-div" id="filter-sub_setores"></div>
                <p class="filter-label">Servidor: </p>
                <div class="bordered-div servidor-div" id="filter-servidores"></div>
            </div>
            <div class="each-filter">
                <p class="filter-label">Veículo: </p>
                <div class="bordered-div veiculos-div" id="filter-veiculos"></div>
                <p class="periodo-label">Período: </p>
                <div class="bordered-div periodo-div" id="filter-periodo-inicio"></div>
                <div class="bordered-div periodo-div" id="filter-periodo-fim"></div>
                <p class="combustivel-label">Tipo do Combustível: </p>
                <div class="bordered-div combustivel-div" id="filter-combustivel"></div>
            </div>
            <div class="each-filter">
                <p class="filter-label">Posto: </p>
                <div class="bordered-div posto-div" id="filter-posto"></div>
            </div>
            <div class="each-filter">
                <p class="filter-label">Soma Litros: </p>
                <div class="bordered-div litros-div" id="somatoriaPrint"></div>
                <p class="filter-label">Soma KM/Hs: </p>
                <div class="bordered-div litros-div" id="somatoriaKmHsPrint"></div>
                <p class="filter-label">Autonomia: </p>
                <div class="bordered-div litros-div" id="somatoriaKmHsLitroPrint"></div>
            </div>
        </div>
        <div class="teste no-print">
            <div class="col-md-12" style="margin-bottom: 32px;">
                <div class="col-md-8">
                    <div style="margin-bottom: 1%" class="col-md-12">
                        <p class="col-md-3">Secretaria:</p>
                        <select class="col-md-9 height30px" id="secretarias" multiple>
                        </select>
                    </div>
                    <div style="margin-bottom: 1%" class="col-md-12">
                        <p class="col-md-3">Setor:</p>
                        <select class="col-md-9 height30px" id="setores" multiple>
                        </select>
                    </div>
                    <div style="margin-bottom: 1%" class="col-md-12">
                        <p class="col-md-3">Sub Setor:</p>
                        <select class="col-md-9 height30px" id="sub_setores" multiple>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <p class="col-md-3">Servidor:</p>
                        <select class="col-md-9 height30px" id="servidores">
                            <option value="0">Todos os Servidores</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <p class="col-md-3">Veículos:</p>
                        <select class="col-md-9 height30px" id="veiculos">
                            <option value="0">Todos os Veículos</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <p class="col-md-3">Período</p>
                        <input style="width: 37.5%;" class="col-md-4 height30px" type="date" id="inicio"/>
                        <input style="width: 37.5%;" class="col-md-4 height30px" type="date" id="fim"/>
                    </div>
                    <div class="col-md-12">
                        <p class="col-md-3">Tipo Combustível:</p>
                        <select class="col-md-9 height30px" id="tipo_combustivel">
                            <option value="0">Todos os Combustiveis</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <p class="col-md-3">Posto:</p>
                        <select class="col-md-9 height30px" id="posto">
                            <option value="0">Todos os Postos</option>
                        </select>
                    </div>
                    <div class="col-md-12 basedados fleft">
                        <p class="col-md-3">Soma Litros</p>
                        <input class="col-md-9 height30px" style="text-align: right" id="somatoria" disabled/>
                    </div>
                    <div class="col-md-12 basedados fleft">
                        <p class="col-md-3">Soma KM / Hs</p>
                        <input class="col-md-9 height30px" style="text-align: right" id="somatoriaKmHs" disabled/>
                    </div>
                    <div class="col-md-12 basedados fleft">
                        <p class="col-md-3">Autonomia</p>
                        <input class="col-md-9 height30px" style="text-align: right" id="somatoriaKmHsLitro" disabled/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 display-none" style="margin-bottom: 18px;">
                <div class="col-md-1 col-md-offset-5">
                    <button id="buscar" class="btn btn-success col-md-12">Buscar
                    </button>
                </div>
                <div class="col-md-2 col-md-offset-4 display-none">
                    <button id="imprimir" class="btn btn-primary col-md-12">Imprimir
                    </button>
                </div>
            </div>
        </div>
        <table class="table tablemedia" id="lista" name="lista" style="overflow-x: scroll; width: 80vw;">
            <thead>
            <th>Data</th>
            <th>Hora</th>
            <th>Placa</th>
            <th>Instrumento de Medida</th>
            <th>Modelo</th>
            <th>KM Anterior</th>
            <th>KM Atual</th>
            <th>KM Percorrido</th>
            <th>Tipo de Combustível</th>
            <th>Servidor</th>
            <th>Posto</th>
            <th>Frentista</th>
            <th>Litros</th>
            <th>Autonomia</th>
            <th class="no-print">Editar</th>
            <th class="no-print">Excluir</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="modal fade no-print" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="exampleModalContent">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="exampleCancelButton" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="exampleConfirmButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--Fim Modal--}}
    {{--Início Modal--}}
    <div class="modal fade no-print" id="ModalExcluir" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="ModalContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="CancelButton" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="ConfirmButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--Fim Modal--}}
    <script>
        $(document).ready(function () {
            var now = new Date;
            var year = now.getFullYear();

            for (i = 0; i <= 2; i++) {
                var yearaux = year + i
                $('#ano').append(
                    '<option value="' + yearaux + '">' + yearaux
                );
            }

            $('#mes').val(now.getMonth()+1);

            $.getJSON("{{ url('getPrefeitura') }}", {}, function (data, textStatus, jqXHR) {
                if (data.nome) {
                    $('#texto').append($('<h1>').text(data.nome));
                    $("#texto").append('<p>HISTÓRICO DE ABASTECIMENTO</p>');
                    $("#texto").append('<p>DADOS EXTRAÍDOS DO SISTEMA GESTÃO DE ABASTECIMENTO CIDADE FÁCIL - SONNITECH</p>');
                }
            });

            function compararStrings(a, b) {
                var x = a.nome.toLowerCase();
                var y = b.nome.toLowerCase();
                if (x < y) {
                    return -1;
                }
                if (x > y) {
                    return 1;
                }
                return 0;
            }

            $.getJSON("{{ url('getSecretaria') }}", {}, function (data, textStatus, jqXHR) {
                $('#secretarias').empty();
                var parents = data.filter(sec => sec.parent_id == null || sec.parent_id == 0);
                parents.sort(compararStrings);
                $.each(parents, function (index, pai) {
                    $('#secretarias').append($('<option>', {
                        value: pai.id,
                        class: 'optionGroup'
                    }).text(pai.nome));
                    var filhos = data.filter(sec => sec.parent_id == pai.id);
                    filhos.sort(compararStrings)
                    $.each(filhos, function (index, filho) {
                        $('#secretarias').append($('<option>', {
                            value: filho.id,
                            class: 'optionChild'
                        }).text(filho.nome.padStart(4)));
                    });
                });
            })
            .done(function () {
                $('#secretarias').select2({
                    templateResult: function (data) {
                        // We only really care if there is an element to pull classes from
                        if (!data.element) {
                            return data.text;
                        }

                        var $element = $(data.element);

                        var $wrapper = $('<span></span>');
                        $wrapper.addClass($element[0].className);

                        $wrapper.text(data.text);

                        return $wrapper;
                    }
                });
            });

            function getSetores() {
                $.getJSON("{{ url('getSetores') }}", {
                    secretarias: $("#secretarias").val()
                }, function (data, textStatua, jqXHR) {
                    $('#setores').empty();
                    $.each(data, function (index, setor) {
                        $('#setores').append($('<option>', {value: setor.id}).text(setor.nome));
                    })
                }).done(function () {
                    $('#setores').select2()
                });
            }

            function getSubSetores(){
                $.getJSON("{{ url('getSubSetores') }}", {
                    setores: $("#setores").val()
                }, function (data, textStatua, jqXHR) {
                    $('#sub_setores').empty();
                    $.each(data, function (index, sub_setor) {
                        $('#sub_setores').append($('<option>', {value: sub_setor.id}).text(sub_setor.nome));
                    })
                }).done(function () {
                    $('#sub_setores').select2()
                });
            }

            function getServidores(){
                $.getJSON("{{ url('getServidoresToRelatorioPeriodo') }}", {
                    secretarias: $("#secretarias").val()
                }, function (data, textStatus, jqXHR) {
                    $('#servidores').empty();
                    $('#servidores').append($('<option>', {
                        value: '0'
                    }).text('Todos os Servidores'));
                    $.each(data, function (index, element) {
                        $('#servidores').append($('<option>', {
                            value: element.nome
                        }).text(element.nome));
                    });
                }).done(function () {
                    $('#servidores').select2()
                });
            }

            $.getJSON("{{ url('getTipoCombustivel') }}", {}, function (data, textStatus, jqXHR) {
                $('#tipo_combustivel').empty();
                $('#tipo_combustivel').append($('<option>', {
                    value: '0'
                }).text('Todos os Combustíveis'));
                $.each(data, function (index, element) {
                    $('#tipo_combustivel').append($('<option>', {
                        value: element.descricao
                    }).text(element.descricao));
                });
            }).done(function () {
                $('#tipo_combustivel').select2()
            });

            $.getJSON("{{ url('getPostos') }}", {}, function (data, textStatus, jqXHR) {
                $('#posto').empty();
                $('#posto').append($('<option>', {
                    value: '0'
                }).text('Todos os Postos'));
                $.each(data, function (index, element) {
                    $('#posto').append($('<option>', {
                        value: element.id
                    }).text(element.nome));
                });
            }).done(function () {
                $('#posto').select2()
            });

            function getVeiculos() {
                $.getJSON("{{ url('getVeiculosToRelatorioPeriodo') }}", {
                    secretarias: $("#secretarias").val()
                }, function (data, textStatus, jqXHR) {
                    $('#veiculos').empty();
                    $('#veiculos').append($('<option>', {
                        value: '0'
                    }).text('Todos os Veiculos'));
                    $.each(data, function (index, element) {
                        $('#veiculos').append($('<option>', {
                            value: element.id
                        }).text(element.placa));
                    });
                }).done(function () {
                    $('#veiculos').select2()
                });
            }

        // getVeiculoSelect();

            $(document).on('change', '#secretarias', function () {
                $('#lista > tbody').empty();
                getSetores();
                getServidores();
                getVeiculos();
                // getVeiculoSelect();
            });

            $(document).on('change', '#setores', function(){
                getSubSetores();
            });

            $(document).on('click', '#buscar', function () {
                startLoading();
                $('#lista > tbody').empty();
                $.getJSON("{{url('getRelatorioCotasPeriodo')}}", {
                    secretaria_id: $('#secretarias').val(),
                    inicio: $('#inicio').val(),
                    fim: $('#fim').val(),
                    servidor: $('#servidores').val(),
                    veiculo_id: $('#veiculos').val(),
                    tipo_combustivel: $('#tipo_combustivel').val(),
                    posto_id: $('#posto').val(),
                    setor_id: $('#setores').val(),
                    sub_setor_id: $('#sub_setores').val()
                }, function (data, textStatus, jqXHR) {
                    let total_abastecido = 0;
                    var totalKmHs = 0;
                    var totalLitrosConsiderar = 0;
                    $.each(data, function (index, element) {
                        var abastecimento = parseFloat(element.total_abastecido || 0);
                        var km_anterior = element.km_anterior ? (element.km_anterior).toLocaleString() : "1º ABAST.";
                        total_abastecido += element.total_abastecido;
                        var km_percorrido = element.km_anterior ? (element.kilometragem - element.km_anterior).toLocaleString() : "1º ABAST."
                        var km_litro = element.km_anterior ?
                            (parseFloat(element.kilometragem - element.km_anterior) /
                                parseFloat(element.total_abastecido || 0)
                            ).toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) : "1º ABAST."
                        let autonomia = '';
                        if (km_litro !== "1º ABAST.")
                            autonomia = element.instrumento_medida == "Hodômetro" ? "Km/L" : "H/L";
                        if (element.km_anterior) {
                            totalKmHs += parseFloat(element.kilometragem) - parseFloat(element.km_anterior)
                            totalLitrosConsiderar += parseFloat(element.total_abastecido)
                        }
                        if (element.frentista_nome == null) {
                            element.frentista_nome = "Nome não registrado!"
                        }
                        let instrumento_medida = element.instrumento_medida ? element.instrumento_medida : "Não Informado";

                        $('#lista > tbody').append(
                            '<tr>' +
                            '<td>' + element.full_date + '</td>' +
                            '<td>' + element.hora + '</td>' +
                            '<td>' + element.placa + '</td>' +
                            '<td>' + instrumento_medida + '</td>' +
                            '<td>' + element.tipoveiculo + '</td>' +
                            '<td style="text-align: right">' + km_anterior + '</td>' +
                            '<td style="text-align: right">' + (element.kilometragem).toLocaleString() + '</td>' +
                            '<td style="text-align: right">' + km_percorrido + '</td>' +
                            '<td>' + element.descricao + '</td>' +
                            /*'<td>' + element.motorista.split(' ')[0] + '</td>'+*/
                            '<td>' + element.motorista + '</td>' +
                            '<td>' + element.posto + '</td>' +
                            '<td>' + element.frentista_nome + '</td>' +
                            '<td>' + abastecimento + '</td>' +
                            '<td style="text-align: right">' + km_litro + " " + autonomia + '</td>' +
                            '<td class="no-print"><a id="modal-finalizar" data-abastecimento_id="' + element.id + '" data-kilometragem="' + element.kilometragem + '" class="btn btn-success open-modal" title="Editar"><i class="glyphicon glyphicon-check" data-abastecimento_id="' + element.id + '" data-kilometragem="' + element.kilometragem + '" ></i></a></td>' +
                            '<td class="no-print"><a id="excluir" data-abastecimentoid=" '+ element.id +' " class="btn btn-danger open-modal-excluir" title="Excluir"><i class="glyphicon glyphicon-remove open-modal-excluir" data-abastecimentoid="' + element.id + '" ></i></a></td>' +
                            '</tr>');
                    });
                    let somatoria = parseFloat(total_abastecido).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    $("#somatoria").val(somatoria);
                    $("#somatoriaPrint").text(somatoria);
                    let somatoriaKmHs = (totalKmHs).toLocaleString();
                    $("#somatoriaKmHs").val(somatoriaKmHs);
                    $("#somatoriaKmHsPrint").text(somatoriaKmHs);
                    let autonomia = '';
                    if (totalKmHs && totalLitrosConsiderar)
                    {
                        autonomia = parseFloat(totalKmHs / totalLitrosConsiderar).toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                    $("#somatoriaKmHsLitro").val(autonomia);
                    $("#somatoriaKmHsLitroPrint").text(autonomia);
                    stopLoading();
                });
            });

            //modal editar
            $(document).on("click", ".open-modal", function (e) {
                var abastecimento_id = $(this).data("abastecimento_id");
                $.get("{{url('getUltimoAbastecimento')}}", {
                    // veiculo_id: $(this).data("identificacao")
                    abastecimento_id: abastecimento_id
                }, function (data, textStatus, jqXHR) {
                    // console.log(data);
                    $('#exampleModalContent').empty();
                    $('#exampleModalLong').modal();
                    $("#exampleModalLongTitle").text("Edição de Dados!");
                    $("#exampleModalContent").append(
                        '<div>'+
                        '<p> Editar kilometragem: </p>'+
                        '<input id="km_final" value="' + data['abastecimento'][0].kilometragem + '"/>'+
                        '</div>'+
                        '<div>'+
                        '<p> Editar litragem: </p>'+
                        '<input id="litragem" value="' + data['abastecimento'][0].litros + '"/>'+
                        '</div>'
                    );
                    $("#exampleModalContent").append(
                        '<input type="hidden" id="abastecimento_id" value="' + abastecimento_id + '"/>'+
                        '<div>' +
                        '<p> Selecione um veiculo: </p>'+
                        '<select id="placa-modal"></select>' +
                        ' </div>'+
                        '<div>'+
                        '<p> Selecione um tipo de combustivel:</p>'+
                        '<select id="combustivel-modal"></select>' +
                        ' </div>'
                    );

                    $.each(data['veiculos'], function (index, val) {

                        if( data['abastecimento'][0].veiculo_id == val.veiculo_id){
                           $('#placa-modal').append(
                               '<option value = "'+ val.veiculo_id +'" selected>'+
                               val.veiculo_placa +'</option>'
                           );
                        }else{
                            $('#placa-modal').append(
                                '<option value = "'+ val.veiculo_id +'">'+
                                val.veiculo_placa +'</option>'
                            );
                        }
                    });

                    $.each(data['tipocombustivel'], function (index, val) {
                        // console.log(data['tipocombustivel']);
                        if(data['abastecimento'][0].tipo_combustivel == val.descricao){
                            $('#combustivel-modal').append(
                                '<option value = "'+ val.descricao +'" selected>'+
                                val.descricao +'</option>'
                            );
                        }else{
                            $('#combustivel-modal').append(
                                '<option value = "'+ val.descricao +'">'+
                                val.descricao +'</option>'
                            );
                        }
                    });

                    $("#exampleModalContent").append('<input id="veiculo_id_consulta" value="' + data['abastecimento'][0].veiculo_id + '" hidden></input');
                    $("#exampleCancelButton").text('Não');
                    $("#exampleConfirmButton").text('Sim');
                    $("#exampleConfirmButton").removeClass();
                    $("#exampleConfirmButton").addClass('btn btn-success');

                });
            });

            $(document).on("click", "#exampleConfirmButton", function () {
            var veiculo_id_consulta = $('#veiculo_id_consulta').val();
            var kilometragem = $('#km_final').val();
            var combustivel = $('#combustivel-modal').val();
            var veiculo_id = $('#placa-modal').val();
            var litragem = $('#litragem').val();

            //console.log(document.getElementById("placa-modal").value);

                $.post("{{url('updateUltimoAbastecimento')}}", {
                    veiculo_id_consulta: veiculo_id_consulta,
                    kilometragem: kilometragem,
                    litragem: litragem,
                    combustivel: combustivel,
                    veiculo_id: veiculo_id ,
                    abastecimento_id: $("#abastecimento_id").val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (data, textStatus, jqXHR) {
                    $('#exampleModalLong').modal('toggle');
                    $('#buscar').click();
                });

            });

            //modal excluir
            $(document).on("click", ".open-modal-excluir", function (e) {
                $('#ModalExcluir').modal();
                $("#ModalLongTitle").text("Excluir Abastecimento!");
                $("#ModalContent").text('Deseja excluir este abastecimento?');
                $("#ModalContent").append('<input id="excluir_id" value="' + $(this).data("abastecimentoid") + '" hidden>');
                $("#CancelButton").text('Não');
                $("#ConfirmButton").text('Sim');
                $("#ConfirmButton").removeClass();
                $("#ConfirmButton").addClass('btn btn-success');
                //excluir registro no confirm modal
            });

            $(document).on("click", "#ConfirmButton", function (e) {
                $.getJSON("{{url('deleteAbastecimento')}}", {
                    id_abastecimento: $('#excluir_id').val()
                }, function (data, textStatus, jqXHR) {
                    //console.log("Excluiu!");
                    $('#ModalExcluir').modal('toggle');
                    $('#buscar').click();
                });
            });

            $(document).on('click', '#imprimir', function () {
                let secretarias = '';
                $("#secretarias option:selected").each(function(){
                    secretarias += $(this).text() + ", ";
                });
                let setores = '';
                $("#setores option:selected").each(function(){
                    setores += $(this).text() + ", ";
                });
                let sub_setores = '';
                $("#sub_setores option:selected").each(function(){
                    sub_setores += $(this).text() + ", ";
                });
                let servidores = $("#servidores").val() != 0 ? $("#servidores").val() : '';
                let veiculos = $("#veiculos").val() != 0 ? $("#veiculos option:selected")[0].innerHTML : '';
                let periodo_inicio = $("#inicio").val() != undefined ? $("#inicio").val() : '';
                let periodo_fim = $("#fim").val() != undefined ? $("#fim").val() : '';
                let combustivel = $("#tipo_combustivel").val() != 0 ? $("#tipo_combustivel").val() : '';
                let posto = $("#posto").val() != 0 ? $("#posto option:selected")[0].innerHTML : '';
                fillFilters(
                    secretarias.slice(0, -2),
                    setores.slice(0, -2),
                    sub_setores.slice(0, -2),
                    servidores,
                    veiculos,
                    periodo_inicio != '' ? periodo_inicio.split("-")[2] + "/" + periodo_inicio.split("-")[1] + "/" + periodo_inicio.split("-")[0] : '',
                    periodo_fim != '' ? periodo_fim.split("-")[2] + "/" + periodo_fim.split("-")[1] + "/" + periodo_fim.split("-")[0] : '',
                    combustivel,
                    posto
                );
                window.print();
            });

            $("#secretarias").change();
            fillFilters();

            function fillFilters(secretarias, setores, sub_setores, servidores, veiculos, periodo_inicio, periodo_fim,
                                 combustivel, posto){
                $("#filter-secretaria").text(secretarias);
                $("#filter-setores").text(setores);
                $("#filter-sub_setores").text(sub_setores);
                $("#filter-servidores").text(servidores);
                $("#filter-veiculos").text(veiculos);
                $("#filter-periodo-inicio").text(periodo_inicio);
                $("#filter-periodo-fim").text(periodo_fim);
                $("#filter-combustivel").text(combustivel);
                $("#filter-posto").text(posto);
            }

            function startLoading(){
                $("body").append(
                    '<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
                );
                $("body").addClass('body-while-loading');
            }

            function stopLoading(){
                $(".lds-spinner").remove();
                $("body").removeClass('body-while-loading');
            }
        })
    </script>
@endsection