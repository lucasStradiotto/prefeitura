@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        @include('graficos.container')
        <div id="container-main" class="highchart-container highchart-show"></div>
        <div id="container-two" class="highchart-container"></div>
        <div id="container-three" class="highchart-container"></div>
        <div id="container-four" class="highchart-container"></div>
    </div>

    <script>
        $(document).ready(function(){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getGastoManutencao", {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push("Preventiva");
                    dados.push(item.valor_preventiva);

                    categories.push("Corretiva");
                    dados.push(item.valor_corretiva);
                });
                series.push({
                    name: 'Valor Gasto',
                    data: dados
                });

                var container = "container-main";
                var header = "Valor Gasto com Manutenção";
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
                            format: 'R$: {point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showBySecretaria(this.category);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").addClass("highchart-hide");
                                    $("#container-four").addClass("highchart-hide");
                                    // console.log(this.category);
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

        function showBySecretaria(manutencao){
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getManutencaoSecretaria?manutencao="+manutencao.toLowerCase()+"s", {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(item.nome);
                    dados.push({y: item.valor, secretaria_id: item.secretaria});
                });
                series.push({
                    name: 'Valor Gasto',
                    data: dados
                });
                // console.log(categories);
                // console.log(series);

                var container = "container-two";
                var header = "Valor Gasto com Manutenção "+manutencao;
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
                            format: 'R$: {point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByMes(manutencao, this.secretaria_id, this.category);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    $("#container-four").addClass("highchart-hide");
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

        function showByMes(manutencao, secretaria_id, secretaria){
            // console.log(secretaria_id);
            var categories = [];
            var dados = [];
            var series = [];
            $.getJSON("/controleobras/getManutencaoMes?manutencao="+manutencao.toLowerCase()+"s&secretaria="+secretaria_id, {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(convertMonth(item.mes));
                    dados.push({y: item.valor, mes: item.mes});
                });
                series.push({
                    name: 'Valor Gasto',
                    data: dados
                });
                // console.log(categories);
                // console.log(series);

                var container = "container-three";
                var header = "Valor Gasto com Manutenção "+manutencao+" em "+secretaria+" por mês";
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
                            format: 'R$: {point.y:,.2f}'
                        },
                        point: {
                            events: {
                                click: function(){
                                    showByVeiculo(manutencao, secretaria_id, secretaria, this.mes);
                                    $("#container-two").removeClass("highchart-hide");
                                    $("#container-three").removeClass("highchart-hide");
                                    $("#container-four").removeClass("highchart-hide");
                                    // console.log(this.category);
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

        function showByVeiculo(manutencao, secretaria_id, secretaria, mes){
            var categories = [];
            var dados = [];
            var series = [];
            // console.log(mes);
            $.getJSON("/controleobras/getManutencaoVeiculo?manutencao="
                        +manutencao.toLowerCase()
                        +"s&secretaria="+secretaria_id
                        +"&mes="
                        +mes, {}, function (data) {

            }).done(function (data) {
                // console.log(data);
                $.each(data, function(indice, item){
                    categories.push(item.veiculo);
                    dados.push(item.valor);
                });
                series.push({
                    name: 'Valor Gasto',
                    data: dados
                });
                // console.log(categories);
                // console.log(series);

                var container = "container-four";
                var header = "Valor Gasto com Manutenção "+manutencao+" em "+secretaria+" em "+ convertMonth(mes) +" por veículo";
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        // cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            align: 'center',
                            color: '#000000',
                            x: 0,
                            format: 'R$: {point.y:,.2f}'
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
                        text: 'R$'
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