@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="no-print">
        <select id="slc-ano"></select>
        <button class="btn btn-primary" id="btn-buscar">Buscar</button>
    </div>

    <div class="container">
        @include('graficoAbastecimento.container')
        <div id="container-main" class="highchart-container highchart-show"></div>
        <div id="container-two" class="highchart-container"></div>
        <div id="container-three" class="highchart-container"></div>
        <div id="container-four" class="highchart-container"></div>
        <div id="container-five" class="highchart-container"></div>
    </div>

    <script>
        $(document).ready(function(){
            const d = new Date();
            const y = d.getFullYear();
            let toAppend = `<option value="${y}">${y}</option>`;
            toAppend += `<option value="${y-1}">${y-1}</option>`;
            toAppend += `<option value="${y-2}">${y-2}</option>`;
            $("#slc-ano").append(toAppend);
            $("#btn-buscar").click(function() {
                showByMes($("#slc-ano").val());
            });
            showByMes(y);
        });

        function showByMes(ano) {
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("{{ route('getKmLitroMes') }}", {
                ano: ano
            }, function (data) {

            }).done(function (data) {
                $.each(data, function(indice, item){
                    categories.push(convertMonth(item.mes));
                    dados.push({y: item.km_litro, ano: ano});
                });
                series.push({
                    name: 'Quilometragem / Litro',
                    data: dados
                });

                var container = "container-main";
                var header = "Quilometragem / Litro - Mês";
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: '{point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showBySetor(this.category, this.ano);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").addClass("highchart-hide");
                                    $("#container-four").addClass("highchart-hide");
                                    $("#container-five").addClass("highchart-hide");
                                    $('html, body').animate({
                                        scrollTop: $("#container-two").offset().top
                                    }, 2000);
                                }
                            }
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function showBySetor(mes, ano){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("{{ route('getKmLitroSetor') }}", {
                mes: disconvertMonth(mes),
                ano: ano
            }, function (data) {

            }).done(function (data) {
                $.each(data, function(indice, item){
                    categories.push(item.nome);
                    dados.push({y: item.km_litro, setor_id: item.id, ano: ano});
                });
                series.push({
                    name: 'Quilometragem / Litro',
                    data: dados
                });

                var container = "container-two";
                var header = "Quilometragem / Litro - Setor / Mês "+mes ;
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: '{point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showBySubSetor(mes, this.setor_id, this.category, this.ano);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    $("#container-four").addClass("highchart-hide");
                                    $("#container-five").addClass("highchart-hide");
                                    $('html, body').animate({
                                        scrollTop: $("#container-three").offset().top
                                    }, 2000);
                                }
                            }
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function showBySubSetor(mes, setor_id, setor, ano){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("{{ route('getKmLitroSubSetor') }}", {
                mes: disconvertMonth(mes), setor_id: setor_id,
                ano: ano
            }, function (data) {

            }).done(function (data) {
                $.each(data, function(indice, item){
                    categories.push(item.nome);
                    dados.push({y: item.km_litro, sub_setor_id: item.id, ano: ano});
                });
                series.push({
                    name: 'Quilometragem / Litro',
                    data: dados
                });

                var container = "container-three";
                var header = "Quilometragem / Litro - Sub Setor / Mês "+mes+" / Setor "+setor;
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: '{point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByVeiculo(mes, this.sub_setor_id, this.category, this.ano);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    $("#container-four").removeClass("highchart-hide");
                                    $("#container-five").addClass("highchart-hide");
                                    $('html, body').animate({
                                        scrollTop: $("#container-four").offset().top
                                    }, 2000);
                                }
                            }
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function showByVeiculo(mes, sub_setor_id, subsetor, ano){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("{{ route('getKmLitroVeiculo') }}", {
                mes: disconvertMonth(mes), sub_setor_id: sub_setor_id,
                ano: ano
            }, function (data) {

            }).done(function (data) {
                $.each(data, function(indice, item){
                    categories.push(item.placa);
                    dados.push({y: item.km_litro, veiculo_id: item.id, ano: ano});
                });
                series.push({
                    name: 'Quilometragem / Litro',
                    data: dados
                });

                var container = "container-four";
                var header = "Quilometragem / Litro - Veículo / Mês "+mes+" / Sub Setor "+subsetor;
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: '{point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByDay(mes, this.veiculo_id, this.category, this.ano);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    $("#container-four").removeClass("highchart-hide");
                                    $("#container-five").removeClass("highchart-hide");
                                    $('html, body').animate({
                                        scrollTop: $("#container-five").offset().top
                                    }, 2000);
                                }
                            }
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function showByDay(mes, veiculo_id, veiculo, ano){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("{{ route('getKmLitroDia') }}", {
                mes: disconvertMonth(mes), veiculo_id: veiculo_id,
                ano: ano
            }, function (data) {

            }).done(function (data) {
                $.each(data, function(indice, item){
                    categories.push(item.dia);
                    dados.push(item.km_litro);
                });
                series.push({
                    name: 'Quilometragem / Litro',
                    data: dados
                });

                var container = "container-five";
                var header = "Quilometragem / Litro - Dia / Mês "+mes+" / Veículo "+veiculo;
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: '{point.y:,.2f}'
                        },
                        point: {
                            events: {
                            }
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function drawHighCharts(container, header, categories, plotOptions, series){
            Highcharts.chart(container, {
                credits: false,
                chart: {
                    type: 'column',
                    height: "500px"
                },
                title: {
                    text: header
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Litros'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.2f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: plotOptions,
                series: series
            });
        }

        function convertMonth(mes){
            switch (parseInt(mes))
            {
                case 1:
                    return "Janeiro";
                case 2:
                    return "Fevereiro";
                case 3:
                    return "Março";
                case 4:
                    return "Abril";
                case 5:
                    return "Maio";
                case 6:
                    return "Junho";
                case 7:
                    return "Julho";
                case 8:
                    return "Agosto";
                case 9:
                    return "Setembro";
                case 10:
                    return "Outubro";
                case 11:
                    return "Novembro";
                case 12:
                    return "Dezembro";
            }
        }

        function disconvertMonth(mes){
            switch (mes)
            {
                case "Janeiro":
                    return 1;
                case "Fevereiro":
                    return 2;
                case "Março":
                    return 3;
                case "Abril":
                    return 4;
                case "Maio":
                    return 5;
                case "Junho":
                    return 6;
                case "Julho":
                    return 7;
                case "Agosto":
                    return 8;
                case "Setembro":
                    return 9;
                case "Outubro":
                    return 10;
                case "Novembro":
                    return 11;
                case "Dezembro":
                    return 12;
            }
        }
    </script>
@endsection