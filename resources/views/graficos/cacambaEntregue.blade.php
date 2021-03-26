@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        @include('graficos.container')
        <div id="container-main" class="highchart-container highchart-show"></div>
        <div id="container-two" class="highchart-container"></div>
        <div id="container-three" class="highchart-container"></div>
    </div>

    <script>
        $(document).ready(function(){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getCacambaEntregue", {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(convertMonth(item.mes));
                    dados.push({y: item.qtd, mes: item.mes});
                });
                series.push({
                    name: 'Caçambas Entregues',
                    data: dados
                });

                var container = "container-main";
                var header = "Caçambas Entregues por Mês";
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
                            // format: 'R$: {point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByMes(this.mes);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").addClass("highchart-hide");
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
        });

        function showByMes(mes){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getCacambaMes?mes="+mes, {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(item.nome);
                    dados.push(item.qtd);
                });
                series.push({
                    name: 'Caçambas Entregues',
                    data: dados
                });
                // console.log(categories);
                // console.log(series);

                var container = "container-two";
                var header = "Caçambas Entregues em "+convertMonth(mes);
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
                            // format: 'R$: {point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByEmpresa(this.category);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    // console.log(this.category);
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

        function showByEmpresa(empresa){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getCacambaEmpresa?empresa="+empresa, {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(convertMonth(item.mes));
                    dados.push(item.qtd);
                });
                series.push({
                    name: 'Caçambas Entregues',
                    data: dados
                });
                // console.log(categories);
                // console.log(series);

                var container = "container-three";
                var header = "Caçambas Entregues pela empresa "+empresa;
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            // format: 'R$: {point.y:,.2f}'
                        }
                    }
                };
                drawHighCharts(container, header, categories, plotOptions, series);
            });
        }

        function drawHighCharts(container, header, categories, plotOptions, series){
            Highcharts.chart(container, {
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
                        text: 'Quantidade'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.,2f}</b></td></tr>',
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
    </script>
@endsection