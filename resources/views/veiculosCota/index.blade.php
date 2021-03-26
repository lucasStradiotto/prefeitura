@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <div class="col-md-12">
            <div class="col-md-2">
                <p>Secretaria:</p>
            </div>
            <div class="col-md-10">
                <select style="height: 50px;" id="secretarias" class="select-filtro">
                    <option value="0">Todas as Secretarias</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-2">
                <p>Veiculo</p>
            </div>
            <div class="col-md-10">
                <select style="width: 30%;height: 30px;" id="veiculos" class="select-filtro">
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <p>Definir cota recorrente?</p>
            </div>
            <div class="col-md-9">
                <input type="checkbox" id="chk-cota-recorrente"/>
            </div>
        </div>
        <div class="col-md-12" id="div-cota-recorrente">

        </div>

        <div class="col-md-12">
            <div class="col-md-2">
                <p>Cota Mensal</p>
            </div>
            <div class="col-md-10">
                <input style="width: 30%;" id="cota"/>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 1%;">
            <div class="col-md-2">
                <p>Somatória</p>
            </div>
            <div class="col-md-10">
                <input readonly style="width: 30%;" id="somatoria" value=""/>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom: 18px;">
            <div class="col-md-2 col-md-offset-3">
                <button id="salvar" class="btn btn-success col-md-12">Definir Cota
                </button>
            </div>
        </div>
        <div>
            <table class="table tablemedia" id="lista" name="lista">
                <thead>
                <th>Selecione Todos
                    <input class="tickcheckboxall" type="checkbox">
                </th>
                <th>Veículo</th>
                <th>Cota</th>
                <th>Periodo</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var click = 0;
        var arrayupdate = [];
        $(document).ready(function () {
            function appendYears(which){
                now = new Date;
                var year = now.getFullYear();

                for (i = 0; i <= 2; i++) {
                    var yearaux = year + i;
                    let mes = ((now.getMonth()+1) < 10) ? "0"+(now.getMonth()+1) : now.getMonth()+1;
                    if (which == "inicial")
                    {
                        $("#ano-inicial").append(
                            '<option value="' + yearaux + '">' + yearaux
                        );
                        $("#mes-inicial").val(mes);
                    }
                    else if (which == "final")
                    {
                        $("#ano-final").append(
                            '<option value="' + yearaux + '">' + yearaux
                        );
                        $("#mes-final").val(mes);
                    }
                    else
                    {
                        $('#ano').append(
                            '<option value="' + yearaux + '">' + yearaux
                        );
                        $("#mes").val(mes);
                    }
                }
            }

            appendYears();

            $(document).on("change", ".select-filtro", function(){
                arrayupdate.length = 0;
                if($(this)[0].id == "secretarias")
                    getVeiculoSelect();
                getAll();
            });

            function getAll(){
                $('#lista > tbody').empty();
                $.getJSON("{{ url('getVeiculosCotasFiltros') }}", {
                    secretaria: $("#secretarias").val(),
                    veiculo: $("#veiculos").val(),
                    mes: $("#mes").val(),
                    ano: $("#ano").val(),
                    recorrente: $("#chk-cota-recorrente")[0].checked,
                    mes_inicial: $("#mes-inicial").val(),
                    mes_final: $("#mes-final").val(),
                    ano_inicial: $("#ano-inicial").val(),
                    ano_final: $("#ano-final").val(),
                }, function (data, textStatus, jqXHR) {
                    $.each(data, function (index, element) {
                        element.cota_litros = element.cota_litros == null ? 0 : element.cota_litros;
                        let mes_ano = element.mes == null ? "Não Cadastrado" : element.mes + "/" + element.ano;
                        $('#lista > tbody').append('<tr>\n' +
                            '<td><input class="tickcheckbox" type="checkbox" value="' + element.id + '"></td>' +
                            '<td>' + element.placa + '</td>\n' +
                            '<td>' + element.cota_litros + '  L</td>\n' +
                            '<td>' + mes_ano + '</td>\n' +
                            '</tr>');
                    });
                });
            }

            function getVeiculoSelect() {
                $("#veiculos").val(0);
                $.getJSON("{{ url('getVeiculosSecretariaSelect') }}", {
                    id: $('#secretarias').val()
                }, function (data, textStatus, jqXHR) {
                    $('#veiculos').empty();
                    $('#veiculos').append($('<option>', {value: '0'}).text('Todos os Veiculos'));
                    $.each(data, function (index, element) {
                        $('#veiculos').append($('<option>', {value: element.id}).text(element.placa));
                    });
                });
            }

            function getSecretarias(){
                $.getJSON("{{ url('getSecretaria') }}", {}, function (data, textStatus, jqXHR) {
                    $('#secretarias').empty();
                    $('#secretarias').append($('<option>', {value: '0'}).text('Todas as Secretarias'));
                    $.each(data, function (index, element) {
                        $('#secretarias').append($('<option>', {value: element.id}).text(element.nome));
                    });
                });
            }

            getSecretarias();
            getVeiculoSelect();

            $(document).on('click', '.tickcheckbox', function () {
                arrayupdate.length = 0;
                $.each($(".tickcheckbox:checked"), function (index, element) {
                    arrayupdate.push($(this).val());
                });
            });

            $(document).on('click', '.tickcheckboxall', function () {
                if (click == 0) {
                    arrayupdate.length = 0;
                    $('.tickcheckbox').prop("checked", true);
                    $.each($(".tickcheckbox:checked"), function (index, element) {
                        arrayupdate.push($(this).val());
                    });
                    click = 1;
                } else {
                    arrayupdate.length = 0;
                    $('.tickcheckbox').prop("checked", false);
                    click = 0;
                }
            });

            $(document).on('click', '#salvar', function () {
                if ($('#cota').val() == '') {
                    alert("Por favor insira uma cota");
                } else if (arrayupdate.length == 0) {
                    alert("Por Favor, selecione um veiculo");
                } else {
                    $.getJSON("{{ url('updateVeiculosCota') }}", {
                        id: arrayupdate,
                        cota: $('#cota').val(),
                        mes: $('#mes').val(),
                        ano: $('#ano').val(),
                        recorrente: $("#chk-cota-recorrente")[0].checked,
                        mes_inicial: $("#mes-inicial").val(),
                        mes_final: $("#mes-final").val(),
                        ano_inicial: $("#ano-inicial").val(),
                        ano_final: $("#ano-final").val(),
                    });
                    setTimeout(function () {
                        $('#lista > tbody').empty();
                    }, 500);
                    setTimeout(function () {
                        getAll()
                    }, 1000);
                    getVeiculoSelect();
                }
            });

            $("#chk-cota-recorrente").change(function(e){
                if (e.target.checked)
                {
                    let toAppend = '';
                    toAppend += '<div class="col-md-12">';
                    toAppend += '<div class="col-md-2">';
                    toAppend += '<p>Mês / Ano Inicial</p>';
                    toAppend += '</div>';
                    toAppend += '<div class="col-md-10">';
                    toAppend += '<select style="width:  14.7%;height: 30px;" id="mes-inicial" class="select-filtro">';
                    toAppend += '<option value="01">Janeiro</option>';
                    toAppend += '<option value="02">Fevereiro</option>';
                    toAppend += '<option value="03">Março</option>';
                    toAppend += '<option value="04">Abril</option>';
                    toAppend += '<option value="05">Maio</option>';
                    toAppend += '<option value="06">Junho</option>';
                    toAppend += '<option value="07">Julho</option>';
                    toAppend += '<option value="08">Agosto</option>';
                    toAppend += '<option value="09">Setembro</option>';
                    toAppend += '<option value="10">Outubro</option>';
                    toAppend += '<option value="11">Novembro</option>';
                    toAppend += '<option value="12">Dezembro</option>';
                    toAppend += '</select>';
                    toAppend += '<select style="width: 15%;height: 30px;" id="ano-inicial" class="select-filtro">';
                    toAppend += '</select>';
                    toAppend += '</div>';
                    toAppend += '</div>';

                    toAppend += '<div class="col-md-12">';
                    toAppend += '<div class="col-md-2">';
                    toAppend += '<p>Mês / Ano Final</p>';
                    toAppend += '</div>';
                    toAppend += '<div class="col-md-10">';
                    toAppend += '<select style="width:  14.7%;height: 30px;" id="mes-final" class="select-filtro">';
                    toAppend += '<option value="01">Janeiro</option>';
                    toAppend += '<option value="02">Fevereiro</option>';
                    toAppend += '<option value="03">Março</option>';
                    toAppend += '<option value="04">Abril</option>';
                    toAppend += '<option value="05">Maio</option>';
                    toAppend += '<option value="06">Junho</option>';
                    toAppend += '<option value="07">Julho</option>';
                    toAppend += '<option value="08">Agosto</option>';
                    toAppend += '<option value="09">Setembro</option>';
                    toAppend += '<option value="10">Outubro</option>';
                    toAppend += '<option value="11">Novembro</option>';
                    toAppend += '<option value="12">Dezembro</option>';
                    toAppend += '</select>';
                    toAppend += '<select style="width: 15%;height: 30px;" id="ano-final" class="select-filtro">';
                    toAppend += '</select>';
                    toAppend += '</div>';
                    toAppend += '</div>';

                    $("#div-cota-recorrente").empty().append(toAppend);
                    appendYears("inicial");
                    appendYears("final");
                }
                else
                {
                    let toAppend = '';
                    toAppend += '<div class="col-md-2">';
                    toAppend += '<p>Mês / Ano</p>';
                    toAppend += '</div>';
                    toAppend += '<div class="col-md-10">';
                    toAppend += '<select style="width:  14.7%;height: 30px;" id="mes" class="select-filtro">';
                    toAppend += '<option value="01">Janeiro</option>';
                    toAppend += '<option value="02">Fevereiro</option>';
                    toAppend += '<option value="03">Março</option>';
                    toAppend += '<option value="04">Abril</option>';
                    toAppend += '<option value="05">Maio</option>';
                    toAppend += '<option value="06">Junho</option>';
                    toAppend += '<option value="07">Julho</option>';
                    toAppend += '<option value="08">Agosto</option>';
                    toAppend += '<option value="09">Setembro</option>';
                    toAppend += '<option value="10">Outubro</option>';
                    toAppend += '<option value="11">Novembro</option>';
                    toAppend += '<option value="12">Dezembro</option>';
                    toAppend += '</select>';
                    toAppend += '<select style="width: 15%;height: 30px;" id="ano" class="select-filtro">';
                    toAppend += '</select>';
                    toAppend += '</div>';

                    $("#div-cota-recorrente").empty().append(toAppend);
                    appendYears(false);
                }
            });
            $("#chk-cota-recorrente").change();
            getAll();
        });
    </script>
@endsection