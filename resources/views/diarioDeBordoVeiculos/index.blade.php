@extends('layouts.app')
<style>
    .fieldset-border {
        border: 3px groove #f2f2f2;
        padding: 0 1.4em 1.4em 1.4em;
        margin: 0 0 1.5em 0;
        -webkit-box-shadow: 0px 0px 0px 0px #f2f2f2;
        box-shadow: 0px 0px 0px 0px #f2f2f2;
    }

    .fieldset-border .legend-border {
        font-size: 1.0em;
        text-align: left;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    .table {
        margin-left: auto;
        margin-right: auto;
    }

    .logo-size {
        width: 200px;
        height: 200px;

    }

    .titulo-style {
        font-size: 1.5em;
        text-align: center;
        margin-top: 11px;
    }

    label {
        margin-top: 4px;
    }

    @media print {
        .display-none {
            display: none;
        }

        .div-select-pai {
            margin-top: -32px;
        }

        .div-select {
            margin-bottom: -11px;
        }

        .form-control {
            margin-top: 0px;
            -webkit-appearance: none;
            border: none !important;
        }

        .titulo-style-print {
            margin-left: 30px;
            text-align: center;
            font-size: 1.0em;
        }

        .logo-size-print {
            width: 125px;
            height: 125px;
        }

        #a_data {
            margin-left: -27px !important;
            font-size: 0.8em;
        }

        .resumo-print {
            margin-left: 62px;
        }

    }
</style>
@section('content')

    <title>Diario de Bordo Veiculo</title>

    <script src=""></script>

    <div id="impressao" class="container">
        <ul class="breadcrumb display-none">
            <li class="active">Diario de Bordo Veiculo</li>
        </ul>
        <br>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style=" margin-top: 8px;margin-bottom: 61px;">
            <div class="col-lg-2 col-lg-offset-1 col-xs-3">
                @if(isset($prefeitura) && isset($prefeitura['nome']))
                    <img src="{{asset('img/'.$prefeitura->logo)}}" class="logo-size logo-size-print" id="logo">
                @endif
            </div>
            <div class="col-lg-9">
                <t id="titulo"
                   class="titulo-style titulo-style-print col-lg-7 col-lg-offset-2 col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-6 col-xs-offset-1"></t>
                <t class="titulo-style titulo-style-print col-lg-7 col-lg-offset-2 col-md-7 col-md-offset-2 col-sm-7 col-sm-offset-2 col-xs-6 col-xs-offset-1"
                   style="margin-top: 33px;">Diário de Bordo
                </t>
                <t class="titulo-style titulo-style-print col-lg-12 col-md-12 col-sm-12 col-xs-12"
                   style="margin-top: 33px; font-size: 1em;">DADOS EXTRAÍDOS DO SISTEMA GESTÃO DE ABASTECIMENTO CIDADE FÁCIL - SONNITECH
                </t>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="div-select-pai col-md-12 col-lg-6 col-sm-12 col-xs-12">
                <div class="div-select col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <label class="col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xs-2 col-xs-offset-0">Veiculo:</label>
                    <div class="col-md-8 col-lg-10 col-sm-8 col-xs-10">
                        <select class="form-control mbot15" name="selectveiculo" id="selectveiculo">
                        </select>
                    </div>
                </div>
                <div class="div-select col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 9px;">
                    <label class="col-md-2 col-lg-2 col-md-offset-1 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xs-2 col-xs-offset-0">Periodo:</label>
                    <div class="col-md-4 col-lg-5 col-sm-4 col-xs-4" style="margin-right: -26px;">
                        <input class="form-control" id="datainicio" type="date">
                    </div>
                    <div id="a_data" class="col-md-1 col-lg-1 col-sm-1 col-xs-1 col-xs-offset-0"
                         style="margin-left: 5px;margin-right: -21px;">
                        <input value="a"
                               style="background-color: transparent;border-color: transparent;margin-top: 5px;"
                               disabled>
                    </div>
                    <div class="col-md-4 col-lg-5 col-sm-4 col-xs-4">
                        <input class="form-control" id="datafim" type="date">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 9px;">
                    <label class="col-md-2 col-lg-2 col-md-offset-1 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xs-2 col-xs-offset-0">Eventos:</label>
                    <div class="col-md-8 col-lg-10 col-sm-8 col-xs-10">
                        <select class="form-control mbot15" name="eventos" id="eventos" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style=" margin-top: 2%;">
                    <div class="col-md-2 col-md-offset-3 col-lg-2 col-lg-offset-3 col-sm-2 col-sm-offset-3 col-xs-2 col-xs-offset-3 display-none">
                        <button id="buscar" type="button" class="btn btn-success">Buscar
                        </button>
                    </div>
                    <div class="col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1 col-sm-2 col-sm-offset-1 col-xs-2 col-xs-offset-1 display-none">
                        <button id="baixar" type="button" class="btn btn-success">Baixar
                        </button>
                    </div>
                    <div class="col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1 display-none">
                        <button id="imprimir" type="button" class="btn btn-primary">Imprimir
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <fieldset class="resumo-print fieldset-border col-md-12 col-lg-6 col-sm-12 col-xs-10">
                    <legend class="legend-border">Resumo</legend>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7">Veículo
                        disponível:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="veiculo-disponivel"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">h</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7">Veículo
                        ligado:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="veiculo-ligado"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">h</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7">Veículo
                        desligado:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="veiculo-desligado"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">h</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">
                        Utilização:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="resultutil"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">%</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">Veículo
                        ligado e em movimento:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="veiculo-movimento"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">h</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">Veículo
                        ligado e parado:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="veiculo-parado"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">h</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">
                        Ociosidade:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="ociosidade"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">%</div>

                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">Distancia
                        percorrida:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="resultdistancia"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">Km</div>


                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">Velocidade
                        Máxima:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="resultvelo"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">Km/h</div>


                    <label class="col-md-3 col-md-offset-4 col-lg-7 col-lg-offset-0 col-sm-4 col-sm-offset-3 col-xs-7 ">RPM
                        Máxima:</label>
                    <input class="col-md-2 col-lg-3 col-sm-2 col-xs-4" value="0" id="resultrpm"
                           style="background-color: transparent;border-color: transparent;margin-top: -2px;" disabled>
                    <div class="col-md-1 col-lg-2 col-sm-3 col-xs-1" style="margin-left: -26px;">RPM</div>

                </fieldset>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <table class="table tablemedia" id="lista" name="lista">
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Eventos</th>
                    <th>Velocidade</th>
                    <th>RPM</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>

    <script>
        var endereco;
        var points;
        $(document).ready(function () {

            // Limitando a data máxima para ontem
            var hoje = new Date();
            var ontem = new Date(hoje.setDate(hoje.getDate() - 1));
            var maxDate = ontem.toISOString().substring(0, 10);

            $('#datainicio').attr('max', maxDate);
            $('#datafim').attr('max', maxDate);

            //

            function downloadFile(file) {
                var a = document.createElement('a');
                if (window.URL && window.Blob && ('download' in a) && window.atob) {
                    // Do it the HTML5 compliant way
                    var blob = base64ToBlob(file.download.data, file.download.mimetype);
                    var url = window.URL.createObjectURL(blob);
                    a.href = url;
                    a.download = file.download.filename;
                    a.click();
                    window.URL.revokeObjectURL(url);
                }
            }

            function base64ToBlob(base64, mimetype, slicesize) {
                if (!window.atob || !window.Uint8Array) {
                    // The current browser doesn't have the atob function. Cannot continue
                    return null;
                }
                mimetype = mimetype || '';
                slicesize = slicesize || 512;
                var bytechars = atob(base64);
                var bytearrays = [];
                for (var offset = 0; offset < bytechars.length; offset += slicesize) {
                    var slice = bytechars.slice(offset, offset + slicesize);
                    var bytenums = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        bytenums[i] = slice.charCodeAt(i);
                    }
                    var bytearray = new Uint8Array(bytenums);
                    bytearrays[bytearrays.length] = bytearray;
                }
                return new Blob(bytearrays, {type: mimetype});
            }


            function submitForm() {
                document.getElementById("pesquisa").submit();
            }

            $.getJSON("{{ url('getLogo') }}", {},
                function (data, textStatus, jqXHR) {
                    if (data.nome) {
                        $('#titulo').append(data.nome);
                    }

                }
            );

            function imprimir() {
                window.print();

            }

            function clearBusca() {
                $('#lista > tbody').empty();
            }

            function clearResumo() {
                $('#veiculo-disponivel').val(0);
                $('#veiculo-ligado').val(0);
                $('#veiculo-desligado').val(0);
                $('#resultutil').val(0);
                $('#veiculo-movimento').val(0);
                $('#veiculo-parado').val(0);
                $('#ociosidade').val(0);
                $('#resultrpm').val(0);
                $('#resultdistancia').val(0);
                $('#resultvelo').val(0);
            }

            function resumo() {
                clearResumo();
                $.getJSON("{{ url('getResumo') }}", {
                    selectveiculo: $('#selectveiculo').val(),
                    datainicio: $('#datainicio').val(),
                    datafim: $('#datafim').val()
                }, function (data, textStatus, jqXHR) {
                    $('#veiculo-disponivel').val(data.horasDisponivel);
                    $('#veiculo-ligado').val(data.horasLigado);
                    $('#veiculo-desligado').val(data.horasDesligado);
                    $('#resultutil').val(data.utilizacao);
                    $('#veiculo-movimento').val(data.horasLigadoMovimento);
                    $('#veiculo-parado').val(data.horasLigadoParado);
                    $('#ociosidade').val(data.ociosidade);
                    $('#resultrpm').val(data.objeto[0].rpm);
                    $('#resultdistancia').val(data.objeto[0].distanciatotal);
                    $('#resultvelo').val(data.objeto[0].velocidade);
                });
            }

            var enderecos = [];
            var tamanho = 0;
            var contador = 0;

            function baixar() {
                $.getJSON("{{ url('getDownload') }}", {
                    selectveiculo: $('#selectveiculo').val(),
                    datainicio: $('#datainicio').val(),
                    datafim: $('#datafim').val(),
                    eventos: $('#eventos').val()
                }, function (data, textStatus, jqXHR) {
                    //console.log(data);
                    downloadFile(data);
                });
            }

            function busca() {
                clearBusca();
                $.getJSON("{{ url('getBuscaDiarioBordo') }}", {
                    selectveiculo: $('#selectveiculo').val(),
                    datainicio: $('#datainicio').val(),
                    datafim: $('#datafim').val(),
                    eventos: $('#eventos').val()
                }, function (data, textStatus, jqXHR) {
                    tamanho = data.length;
                    if (data == '') {
                        alert("Nenhum dado existente para o periodo, veiculo e evento selecionado!");
                    } else {
                        $.each(data, function (index, pesquisa) {
                            $('#lista > tbody').append('<tr>\n' +
                                '                    <td>' + pesquisa.data + '</td>\n' +
                                '                    <td>' + pesquisa.hora + '</td>\n' +
                                '                    <td>' + pesquisa.evento + '</td>\n' +
                                '                    <td>' + pesquisa.velocidade + '</td>\n' +
                                '                    <td>' + pesquisa.rpm + '</td>\n' +
                                '                </tr>');
                        });
                    }
                });
            }

            function compare(a, b) {
                if (a.data + '_' + a.hora < b.data + '_' + b.hora)
                    return -1;
                if (a.data + '_' + a.hora > b.data + '_' + b.hora)
                    return 1;
                return 0;
            }

            function preenche() {
                enderecos.sort(compare);
                $.each(enderecos, function (index, element) {
                    $('#lista > tbody').append('<tr>\n' +
                        '                    <td>' + element.data + '</td>\n' +
                        '                    <td>' + element.hora + '</td>\n' +
                        '                    <td>' + element.evento + '</td>\n' +
                        '                    <td>' + element.endereco + '</td>\n' +
                        '                    <td>' + element.velocidade + '</td>\n' +
                        '                </tr>');
                });
            }

            function geocodeLatLng(geocoder, points, pesquisa) {
                var obj = {
                    data: pesquisa.data, endereco: "Não Encontrado!",
                    hora: pesquisa.hora, evento: pesquisa.evento, velocidade: pesquisa.velocidade
                };
                geocoder.geocode({'location': points}, function (results, status) {
                    if (status === 'OK' && results[1]) {
                        obj = {
                            data: pesquisa.data, endereco: results[0].formatted_address,
                            hora: pesquisa.hora, evento: pesquisa.evento, velocidade: pesquisa.velocidade
                        };
                    }
                    enderecos.push(obj);
                    contador++;
                    if (contador === tamanho)
                        preenche();
                });
            }

            $.getJSON("{{ url('getAllVeiculos') }}", {}, function (data, textStatus, jqXHR) {
                $('#selectveiculo').empty();
                $('#eventos').empty();
                $('#selectveiculo').append($('<option>', {value: '0'}).text('Selecione um veiculo'));
                $('#eventos').append($('<option>', {value: '0'}).text('Todos os eventos'));
                $.each(data, function (index, veiculo) {
                    $('#selectveiculo').append($('<option>', {value: veiculo.id}).text(veiculo.placa));
                });
            })
            .done(function () {
                $('#selectveiculo').select2()
            });

            $(document).on('change', '#datainicio', function () {
                clearResumo();
                clearBusca();
                document.getElementById('datainicio').style.border = "1px solid gray";
            });

            $(document).on('change', '#datafim', function () {
                clearResumo();
                clearBusca();
                document.getElementById('datafim').style.border = "1px solid gray";
            });

            $(document).on('change', '#eventos', function () {
                clearResumo();
                clearBusca();
            });

            $(document).on('change', '#selectveiculo', function () {
                clearResumo();
                clearBusca();
                $('#eventos').empty();
                $('#eventos').append($('<option>', {value: '0'}).text('Todos os eventos'));
                $('#eventos').append($('<option>', {value: '666'}).text('Filtrar por paradas'));
                document.getElementById('selectveiculo').style.border = "1px solid gray";

                $.getJSON("{{ url('getEventosVeiculo') }}", {
                    selectveiculo: $('#selectveiculo').val()
                }, function (data, textStatus, jqXHR) {
                    $.each(data, function (index, evento) {
                        $('#eventos').append($('<option>', {value: evento.id}).text(evento.tipo));
                    });
                });
            });

            $("#buscar").click(function (e) {
                e.preventDefault();
                if ($('#selectveiculo').val() == '0') {
                    document.getElementById('selectveiculo').style.border = "1px solid red";
                } else if ($('#datainicio').val() == '') {
                    document.getElementById('datainicio').style.border = "1px solid red";
                } else if ($('#datafim').val() == '') {
                    document.getElementById('datafim').style.border = "1px solid red";
                } else {
                    resumo();
                    busca();
                    //submitForm();
                }
            });

            $('#baixar').click(function (e) {
                if ($('#selectveiculo').val() == '0') {
                    document.getElementById('selectveiculo').style.border = "1px solid red";
                } else if ($('#datainicio').val() == '') {
                    document.getElementById('datainicio').style.border = "1px solid red";
                } else if ($('#datafim').val() == '') {
                    document.getElementById('datafim').style.border = "1px solid red";
                } else {
                    e.preventDefault();
                    baixar();
                }

            });

            $("#imprimir").click(function (e) {
                e.preventDefault();
                if ($('#selectveiculo').val() == '0') {
                    document.getElementById('selectveiculo').style.border = "1px solid red";
                } else if ($('#datainicio').val() == '') {
                    document.getElementById('datainicio').style.border = "1px solid red";
                } else if ($('#datafim').val() == '') {
                    document.getElementById('datafim').style.border = "1px solid red";
                } else {
                    imprimir();
                }
            });
        });
    </script>

@endsection