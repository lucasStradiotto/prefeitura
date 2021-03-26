@extends('layouts.app')

@section('content')
    <title>Quilometros Rodados</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">Relatorio Trafego</li>
        </ul>
        <br>
        <form id="pesquisa">

            <div class="col-md-12 text-center">
                <label class="col-md-1 col-md-offset-1">Secretaria:</label>
                <div class="col-md-3">
                    <select class="form-control mbot15" name="secretaria" id="secretaria" required>
                    </select>
                </div>
                <div class="col-md-1">
                    Período:
                </div>
                <div class="col-md-2">
                    <input id="datainicio" type="date" required>
                </div>
                <div class="col-md-1">
                    <p>a</p>
                </div>

                <div class="col-md-2">
                    <input id="datafim" type="date" required>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <div class="col-md-1 col-md-offset-1">
                    Veiculo:
                </div>
                <div class="col-md-3">
                    <select class="form-control mbot15" name="veiculo" id="veiculo">
                    </select>
                </div>
                <div class="col-md-1">
                    Motorista:
                </div>
                <div class="col-md-3">
                    <select class="form-control mbot15" name="motorista" id="motorista">
                    </select>
                </div>
                <div class="col-md-1 ">
                    <button id="buscar" type="button" class="btn btn-success" data-dismiss="modal">Buscar</button>
                </div>
            </div>

        </form>
        <br><br><br>
        <div>
            <table class="table" id="lista" name="lista">
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Local</th>
                    <th>Secretaria</th>
                    <th>Motorista</th>
                    <th>Distancia Percorrida (Metros)</th>
                    <th>Limite de velocidade</th>
                    <th>Observação</th>
                </tr>


                {{-- @if($ == null)
                     <tr>
                         <td>Aguarde, nenhuma informação !</td>
                     </tr>
                 @endif
                 @foreach ($motoristas as $motorista)

                         <td>{{$motorista->nome_fantasia}}</td>
                         <td>{{$motorista->cnh_categoria}}</td>
                         <td>{{$motorista->cnh_numero}}</td>
                         <td>{{Carbon\Carbon::parse($motorista->cnh_validade)->format('d/m/y')}}</td>
                     </tr>
                 @endforeach--}}
            </table>
            <div class="col-md-12 text-center ">
                <button type="button" class="btn btn-success" data-dismiss="modal">Imprimir</button>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            var validaend;
            var secretaria;
            var artigos;
            var incrementador = 0;
            var promises = [];


            function submitForm() {
                document.getElementById("formpesquisa").submit();

            }

            function buscarmoto() {

                    $('.tabela').empty();

                    $.getJSON("{{ url('getPesquisa') }}", {
                        secretaria_id: jQuery('#secretaria').val(),
                        motorista_id: jQuery('#motorista').val(),
                        veiculo_id: jQuery('#veiculo').val(),
                        datainicio: jQuery('#datainicio').val(),
                        datafim: jQuery('#datafim').val()
                    }, function(data, textStatus, jqXHR) {
                        console.log(data);
                        $.each(data, function (index, lista) {
                            $('#lista').append('<tr class="tabela">' +
                                '<td>' + lista.data_utilizacao + '</td>' +
                                '<td>' + lista.hora_utilizacao + '</td>' +
                                '<td>' + "ainda nao tem" + '</td>' +
                                '<td>' + lista.secretarianome + '</td>' +
                                '<td>' + lista.motoristanome + '</td>' +
                                '<td>' + "ainda nao tem" + '</td>' +
                                '<td>' + "ainda nao tem" + '</td>' +
                                '<td>' + "ainda nao tem" + '</td>' +
                                '</tr>');
                        });

                    });

            }

            //TODO: Criar rota GET para uma action que retorna todos os livros

            $.getJSON("{{ url('getSecretaria') }}", {}, function (data, textStatus, jqXHR) {
                $('#secretaria').empty();
                $('#secretaria').append($('<option>', {value: '0'}).text('Selecione uma secretaria'));
                $('#veiculo').append($('<option>', {value: '0'}).text('Selecione um veiculo'));
                $('#motorista').append($('<option>', {value: '0'}).text('Selecione um motorista'));
                //console.log(data);
                $.each(data, function (index, secretaria) {
                    $('#secretaria').append($('<option>', {value: secretaria.id}).text(secretaria.nome));
                });
            });

            $.getJSON("{{ url('getLista') }}", {}, function (data, textStatus, jqXHR) {
                $.each(data, function (index, lista) {
                    //console.log(data);
                    //var dia = lista.data_utilizacao.split(" ")[0];
                    //var hora = dia.slice(0,dia);
                    $('#lista').append('<tr class="tabela">' +
                        '<td>' + lista.data_utilizacao + '</td>' +
                        '<td>' + lista.hora_utilizacao + '</td>' +
                        '<td>' + "ainda nao tem" + '</td>' +
                        '<td>' + lista.secretarianome + '</td>' +
                        '<td>' + lista.motoristanome + '</td>' +
                        '<td>' + "ainda nao tem" + '</td>' +
                        '<td>' + "ainda nao tem" + '</td>' +
                        '<td>' + "ainda nao tem" + '</td>' +
                        '</tr>');
                });

            });


            $(document).on('change', '#secretaria', function () {

                $('#veiculo').empty();
                $('#veiculo').append($('<option>', {value: '0'}).text('Selecione veiculo'));
                $('#motorista').empty();
                $('#motorista').append($('<option>', {value: '0'}).text('Selecione um motorista'));
                //TODO: Buscar os artigos baseados no livro selecionado

                $.getJSON("{{ url('getVeiculos') }}", {
                    secretaria_id: jQuery('#secretaria').val()
                }, function (data, textStatus, jqXHR) {
                    //console.log(data);
                    $.each(data, function (index, veiculo) {
                        $('#veiculo').append($('<option>', {value: veiculo.id}).text(veiculo.placa));
                    });
                });

                $.getJSON("{{ url('getMotoristas') }}", {
                    secretaria_id: jQuery('#secretaria').val()
                }, function (data, textStatus, jqXHR) {
                    //console.log(data);
                    $.each(data, function (index, motorista) {
                        $('#motorista').append($('<option>', {value: motorista.id}).text(motorista.nome));
                    });
                });

            });
            $(document).on('change', '#veiculo', function () {
                $('#motorista').empty();
                $('#motorista').append($('<option>', {value: '0'}).text('Selecione motorista'));
                // Buscar os artigos baseados no livro selecionado

                $.getJSON("{{ url('getVeiculosMotoristas') }}", {
                    secretaria_id: jQuery('#secretaria').val(),
                    veiculo_id: jQuery('#veiculo').val()
                }, function (data, textStatus, jqXHR) {
                    console.log(data);
                    $.each(data, function (index, motorista) {
                        $('#motorista').append($('<option>', {value: motorista.motoristaid}).text(motorista.motoristanome));
                    });
                });
            });
            $("#buscar").click(function (e) {
                e.preventDefault();
                if($('#secretaria').val() == '0') {
                    alert("Selecione uma secretaria ");
                }else if($('#datainicio').val() == '' || $('#datafim').val() == ''){
                    alert("Selecione um periodo desejado");
                }else{
                    buscarmoto();
                }
            });

            $("select").select2({
                maximumSelectionLength: 2
            });
        });
    </script>
@endsection