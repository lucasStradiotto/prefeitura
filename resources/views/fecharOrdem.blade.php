@extends('layouts.app')

@section('content')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

<body>

    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Parâmetros</a></li>
        <li class="active">Ordens de Coleta</li>
    </ul>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ordem De Coleta</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">O.C.</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="ordemColetaModal" value="">
                    </div>
                    <hr>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Solicitante</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="solicitanteModal">
                    </div>
                    <hr>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Rua</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="ruaModal">


                        <span class="input-group-addon" id="basic-addon1">Número</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="numeroModal">
                    </div>
                    <hr>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Data de Entrega</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="dataEntregaModal">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <hr>
                    <div class="input-group date">
                        <span class="input-group-addon" id="basic-addon1">Empresa</span>
                        <input disabled type="text" class="form-control" aria-describedby="basic-addon1" id="empresaModal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btnFechaOrdem">Fechar Ordem</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        Empresa:
                        <select class="selectpicker form-control" id="slcEmpresa">
                            <option value="0">Selecione a Empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{$empresa->id}}">{{$empresa->nome_fantasia}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


        <div class="row">
            <div class="col-xs-3">
                <div class="form-group">
                    Caminhão:
                    <select class="selectpicker form-control" id="slcCaminhao">
                        <option value="0">Selecione o Caminhão</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>O.C.</th>
            <th>Solicitante</th>
            <th>Bairro</th>
            <th>Rua</th>
            <th>Número</th>
            <th>Data</th>
        </tr>
        </thead>
        <tbody id="trAlvoFiltro"> <!-- Contéudo que é gerado pelo Jquery vai aqui dentro -->

        </tbody>
    </table>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        /*
           * by: ICF
           * Consulta dados AJAX e cria as opções do select
        */
        $(document).on('change', '#slcEmpresa', function (e) {
            e.preventDefault();
            if ($(this).val() !== '0') {

                nomeSelectAlvo = '#slcCaminhao';
                $selectAlvo = $(nomeSelectAlvo);

                $selectAlvo.empty();
                $selectAlvo.append($('<option>', { value: '0' }).text('Selecione o Caminhão'));

                $.getJSON("{{ route('getCaminhoes') }}", {
                    empresa_id: $(this).val()
                }, function (data) {

                    $.each(data, function (indice, caminhao) {
                        $selectAlvo.append($('<option>', {value: caminhao.id, selected:false}).text(caminhao.placa));

                    })
                });
            }else{
                $("#slcCaminhao").empty();
                $("#slcCaminhao").append($('<option>', { value: '0' }).text('Selecione o Caminhão'));

            }
        });

        /*
           * by: ICF
           * Consulta dados AJAX insere na tabela para consulta e
           * insere no Modal para realizar o fechamento da mesma
        */
        $(document).on('change', '#slcCaminhao', function (e) {
            e.preventDefault();
            if ($(this).val() !== '0') {

                nomeTrAlvo = '#trAlvoFiltro';
                $selectAlvo = $(nomeTrAlvo);

                $selectAlvo.empty();

                $.getJSON("{{ route('getOrdensColeta') }}", {
                    veiculo_id: $(this).val()
                }, function (data) {

                    $.each(data, function (indice, ordemColeta) {
                        if(!ordemColeta.data_retirada && ordemColeta.data_entrega){
                            $selectAlvo.append($(
                                '<tr id="tr'+indice+'"><td> <a href="#" id="btnOrdemColeta'+indice+'" data-toggle="modal" data-target="#myModal" value="'+indice+'"> Ordem: ' + ordemColeta.numero_ctr + '</a></td>'+
                                '<td>' + ordemColeta.nome_solicitante + '</td>' +
                                '<td>' + ordemColeta.bairrosNome + '</td>' +
                                '<td>' + ordemColeta.ruasNome + '</td>' +
                                '<td>' + ordemColeta.numero_casa_cobranca_id + '</td>' +
                                '<td>' + ordemColeta.data + '</td></tr>'));
                        }
                        var dataAtual = new Date();

                        var mes = dataAtual.getMonth()+1;
                        var dia = dataAtual.getDate();

                        var data = (dia<10 ? '0' : '') + dia + '-' + (mes<10 ? '0' : '') + mes + '-' + dataAtual.getFullYear()
                        + ' ' + dataAtual.getHours() + ':' + dataAtual.getMinutes();

                        var dataBanco = dataAtual.getFullYear() + '-' +(mes<10 ? '0' : '') + mes + '-' + (dia<10 ? '0' : '') + dia
                            + ' ' + dataAtual.getHours() + ':' + dataAtual.getMinutes() + ':' + dataAtual.getSeconds();

                        $("#btnOrdemColeta"+indice).click(function(){
                            $("#ordemColetaModal").val(ordemColeta.numero_ctr);
                            $("#solicitanteModal").val(ordemColeta.nome_solicitante);
                            $("#ruaModal").val(ordemColeta.ruasNome);
                            $("#numeroModal").val(ordemColeta.numero_casa_cobranca_id);
                            $("#dataEntregaModal").val(data);
                            $("#empresaModal").val(ordemColeta.razao_social);
                            $("#btnFechaOrdem").val(indice);
                        });
                        $("#btnFechaOrdem").click(function(){
                            $(this).val() == indice ? updateDataOrdemColeta(dataBanco, ordemColeta.ordemId, indice) : console.log('trab');
                        });
                    });
                });

            }else{
                $("#trAlvoFiltro").empty();
            }
        });

        function updateDataOrdemColeta(data_atual, ordem_id, indice){
            $.ajax({
                type: "GET",
                url: "{{ route('updateDataOrdemColeta')  }}",
                data: {ordem_id: ordem_id, data_atual: data_atual},
                success: function(data) {
                    if(data){
                        alert('Ordem fechada com sucesso!');
                        $('#tr'+indice).remove();
                    }
                }
            });
        }
    </script>
@endsection