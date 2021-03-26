@extends('layouts.app')

@section('styles')
@parent
<style>
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

    .height30px{
        height: 30px;
    }

    .txt-header h1 {
        width: 100%;
    }

    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }

    .optionGroup {
        font-weight: bold;
        font-style: italic;
    }
        
    .optionChild {
        padding-left: 15px;
    }
    
    .right-aligned{
        text-align: right;
    }

    .vehicle-identification{
        font-size: 0.9em;
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
        width: 40vw;
        height: auto;
    }

    .mes-div{
        width: 15vw;
        height: auto;
    }

    .ano-div{
        width: 15vw;
        height: auto;
    }

    @media print{
        .filter-div{
            display: block;
        }
    }
</style>
@endsection

@section('content')

@if(isset($prefeitura) && isset($prefeitura->nome))
<div class="header">
    <div class="logo-prefeitura">
        <img style="width: 170px;" src="{{asset('img/'.$prefeitura->logo)}}" />
    </div>
    <div id="texto" class="txt-header" style="text-align: center;"></div>
</div>
@endif

<div class="container">

    <div class="no-print">
        <div class="col-md-12" style="margin-bottom: 32px;">
            <div class="col-md-6">
                <div class="col-md-12">
                    <p class="col-md-3">Secretaria:</p>
                    <select class="col-md-9 height30px" id="secretarias" multiple>
                    </select>
                </div>
                <div class="col-md-12">
                    <p class="col-md-3">Mês:</p>
                    <select id="mes" class="col-md-9 height30px">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <p class="col-md-3">Ano:</p>
                    <select id="ano" class="col-md-9 height30px">
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 18px;">
            <div class="col-md-1 col-md-offset-5">
                <button id="buscar" class="btn btn-success col-md-12">Buscar
                </button>
            </div>
            <div class="col-md-2 col-md-offset-4">
                <button id="imprimir" class="btn btn-primary col-md-12">Imprimir
                </button>
            </div>
        </div>
    </div>
    <div>
        <div class="filter-div">
            <div class="each-filter">
                <p class="filter-label">Secretaria: </p>
                <div class="bordered-div secretarias-div" id="filter-secretaria"></div>
            </div>
            <div class="each-filter">
                <p class="filter-label">Mês: </p>
                <div class="bordered-div mes-div" id="filter-mes"></div>
                <p class="filter-label">Ano: </p>
                <div class="bordered-div ano-div" id="filter-ano"></div>
            </div>
        </div>
        <table class="table tablemedia" id="lista" name="lista">
            <thead>
                <th>Veículo</th>
                <th>Cota</th>
                <th>Utilizado</th>
                <th>Disponível</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var now = new Date;
        var year = now.getFullYear();

        $('#ano').append(`<option value="${year-2}">${year-2}`);
        $('#ano').append(`<option value="${year-1}">${year-1}`);
        $('#ano').append(`<option value="${year}">${year}`);
        $('#ano').append(`<option value="${year+1}">${year+1}`);
        $('#ano').append(`<option value="${year+2}">${year+2}`);

        $('#mes').val(now.getMonth()+1);

        // function getVeiculoSelect() {
        //     $.getJSON("{{ url('getVeiculosSecretariaSelect') }}", {
        //         id: $('#secretarias').val()
        //     }, function (data, textStatus, jqXHR) {
        //         $('#veiculos').empty();
        //         $('#veiculos').append($('<option>', {
        //             value: '0'
        //         }).text('Todos os Veiculos'));
        //         $.each(data, function (index, element) {
        //             $('#veiculos').append($('<option>', {
        //                 value: element.id
        //             }).text(element.placa));
        //         });
        //     });
        // }

        $.getJSON("{{ url('getPrefeitura') }}", {}, function (data, textStatus, jqXHR) {
            if (data.nome) {
                $('#texto').append($('<h1>').text(data.nome));
                $("#texto").append('<p>HISTÓRICO DE ABASTECIMENTO</p>');
                $("#texto").append(
                    '<p>DADOS EXTRAÍDOS DO SISTEMA GESTÃO DE ABASTECIMENTO CIDADE FÁCIL - SONNITECH</p>'
                );
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

        // getVeiculoSelect();

        $(document).on('change', '#secretarias', function () {
            $('#lista > tbody').empty();
            // getVeiculoSelect();
        });

        $(document).on('click', '#buscar', function () {
            $('#lista > tbody').empty();
            $.getJSON("{{url('getRelatorioCotas')}}", {
                secretaria_id: $('#secretarias').val(),
                ano: $('#ano').val(),
                mes: $('#mes').val()
            }, function (data, textStatus, jqXHR) {
                $.each(data, function (index, element) {
                    console.log(element);
                    var cota = parseFloat(element.cota_litros);
                    var abastecimento = parseFloat(element.total_abastecido || 0);
                    var disponivel = parseFloat(cota - abastecimento);
                    $('#lista > tbody').append('<tr>\n' +
                        '                    <td class="vehicle-identification">' + element.codigo_barra + ' - ' +
                        element.modelo + '</td>\n' +
                        '                    <td class="right-aligned">' + cota.toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</td>\n' +
                        '                    <td class="right-aligned">' + abastecimento.toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</td>\n' +
                        '                    <td class="right-aligned">' + disponivel.toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</td>\n' +
                        '                </tr>');
                })
            })
        });

        $(document).on('click', '#imprimir', function () {
            let secretarias = '';
            $("#secretarias option:selected").each(function(){
                secretarias += $(this).text() + ", ";
            });
            let mes = $("#mes").val();
            let ano = $("#ano").val();

            fillFilters(secretarias.slice(0, -2), mes, ano);
            window.print();
        });

        function fillFilters(secretarias, mes, ano){
            $("#filter-secretaria").text(secretarias);
            $("#filter-mes").text(mes);
            $("#filter-ano").text(ano);
        }
    })
</script>

@endsection