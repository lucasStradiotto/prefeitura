@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}: {{$datas['nomeMes']}} de {{$datas['ano']}}</li>
        </ul>
        <div style="overflow-x: scroll">
            <!-- Modal -->
            <div class="modal fade" id="modalOrdemServico" role="dialog">
                <div class="modal-dialog" style="width: 65%;">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ordem de Serviço</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="formPreventiva" action="{{route('storeCronogramaManutencao')}}">
                                {!! csrf_field() !!}
                                <div>
                                    Data de Execução: <input type="date" name="data_execucao" id="data_execucao">
                                    <input type="hidden" name="data_prevista" id="data_prevista">
                                </div>
                                <br>
                                <div>
                                    Horário De: <input type="time" name="horario_inicio" id="horario_inicio">
                                    Até: <input type="time" name="horario_fim" id="horario_fim">
                                </div>
                                <div>
                                    Secretaria
                                </div>
                                <div>
                                    <input name="secretaria" disabled id="secretaria">
                                    <input type="hidden" name="veiculo_id" id="veiculo_id">
                                </div>
                                <div>
                                    Descrição do Problema
                                </div>
                                <div>
                                    <textarea name="descricao" id="descricao"></textarea>
                                    <input type="hidden" name="preventiva_id" id="preventiva_id">
                                </div>
                                <div>
                                    Descrição do Serviço Executado
                                </div>
                                <div>
                                    <textarea name="servico" id="servico"></textarea>
                                </div>
                                <div>
                                    Ferramentas Utilizadas
                                </div>
                                <div>
                                    <textarea name="ferramenta" id="ferramenta"></textarea>
                                </div>
                                <div>
                                    Peças Utilizadas
                                    <table border="1" style="text-align: center; width: 100%" id="tabelaPecas">
                                        <tr>
                                            <th>Código</th>
                                            <th>Peça</th>
                                            <th>Quantidade</th>
                                            <th>Valor Unitário (R$)</th>
                                            <th><span class="btn btn-success" id="btnAddPeca" style="width: 100%;">+</span></th>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" name="valor_total" id="valor_total">
                                <div>
                                    <button class="btn btn-success" id="btnFinalizar">Finalizar Ordem de Serviço</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table" style="width: 40%">
                <form action="{{route('indexCronogramaManutencao')}}">
                    <tr>
                        <th>Legenda</th>
                        <th>Filtros</th>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">
                            <img src="{{ URL::asset('img/vermelho.png') }}">
                            Atrasado
                        </td>
                        <td>
                            Secretaria
                        </td>
                        <td>
                            <select id="slcSecretaria" name="filtro_secretaria">
                                <option value="">Todas</option>
                                @foreach($secretarias as $secretaria)
                                    <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">
                            <img src="{{ URL::asset('img/verde.png') }}">
                            Executado
                        </td>
                        <td>
                            Veículo
                        </td>
                        <td>
                            <select id="slcVeiculo" name="filtro_veiculo">
                                <option value="">Veículos</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px;">
                            <img src="{{ URL::asset('img/cinza.png') }}">
                            Planejado
                        </td>
                        <td colspan="2">
                            <button class="btn btn-success">Filtrar</button>
                        </td>
                    </tr>
                </form>
            </table>
            <table class="table">
                <tr>
                    <th>&nbsp;</th>
                    @for ($i = 1; $i <= $datas['qtdDias']; $i++)
                        <th style="padding: 0px;
                        @if($i == date('d'))
                              background-color: yellow;
                        @endif
                        ">
                            {{$i}}
                        </th>
                    @endfor
                </tr>
                @foreach ($veiculos as $veiculo)
                    <tr>
                        <th>{{$veiculo->placa}}</th>
                    </tr>
                    @foreach($preventivas as $preventiva)
                        @if($veiculo->id == $preventiva->veiculo_id)
                            @foreach($tiposPreventiva as $tipoPreventiva)
                                @if ($tipoPreventiva->id == $preventiva->tipo_preventiva_id)
                                    <tr>
                                        <td>{{$tipoPreventiva->nome}}</td>
                                        @for ($i = 1; $i <= $datas['qtdDias']; $i++)
                                            <?php $resultado = \App\Http\Controllers\CronogramaManutencaoController::verificarData($preventiva->id, date('m/Y'), $i); ?>
                                            @if($resultado['status'] == "finalizado")
                                                <td style="padding: 0px;"><img src="{{ URL::asset('img/verde.png') }} " data-toggle="modal" data-target="#modalOrdemServico"  onclick="readOnlyValores({{$resultado['id']}})"></td>
                                            @elseif($resultado['status'] == "planejado")
                                                <td style="padding: 0px;"><img src="{{ URL::asset('img/cinza.png') }} " data-toggle="modal" data-target="#modalOrdemServico"  onclick="atribuirValores({{$preventiva->id}})"></td>
                                            @elseif($resultado['status'] == "atrasado")
                                                <td style="padding: 0px;"><img src="{{ URL::asset('img/vermelho.png') }}" data-toggle="modal" data-target="#modalOrdemServico" onclick="atribuirValores({{$preventiva->id}})"></td>
                                            @else
                                                <td style="padding: 0px;"><img src="{{ URL::asset('img/branco.png') }}"></td>
                                            @endif
                                        @endfor
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var indexTr = 0;
            $("#btnAddPeca").click(function(){
                $("#tabelaPecas").append(
                    "<tr id='tr"+indexTr+"'>" +
                    "<td>" +
                    "<input name='codigos[]' class='codigo'>" +
                    "</td>" +
                    "<td>" +
                    "<input name='nomes[]' class='nome'>" +
                    "</td>" +
                    "<td>" +
                    "<input name='qtds[]' class='qtd' type='number'>" +
                    "</td>" +
                    "<td>" +
                    "<input name='valores[]' class='valor' type='number'>" +
                    "</td>" +
                    "<td>" +
                    "<span class='btn btn-danger btnRmPeca' id='"+indexTr+"'>-</span>" +
                    "</td>" +
                    "</tr>");
                indexTr++;
            });

            $(document).on("click", ".btnRmPeca", function(){
                var linha = $(this)[0].id;
                $("#tr"+linha).remove();
            });


            $("#btnFinalizar").click(function(e){
                e.preventDefault();

                var codigos = document.getElementsByClassName("codigo");
                var valores = document.getElementsByClassName("valor");
                var nomes = document.getElementsByClassName("nome");
                var total = 0;
                var nulo = false;
                if (nomes.length > 0)
                {
                    $(".qtd").each(function (index, qtd) {
                        if (valores[index].value == "" || qtd.value == "" ||
                            nomes[index].value == "" || codigos[index].value == "")
                            nulo = true;
                        else
                            total += qtd.value * valores[index].value;
                    });
                    if (nulo)
                        alert("Preencha a tabela de peças.");
                    else
                    {
                        $("#valor_total").val(total);
                        $("#formPreventiva").submit();
                    }
                }
                else
                    alert("Preencha a tabela de peças.");
            });


           $("#slcSecretaria").change(function(){
               $("#slcVeiculo").empty();
               $("#slcVeiculo").append("<option value=''>Veículo</option>");
               $.getJSON("{{ route('getVeiculosPorSecretaria') }}", {
                   id: $(this).val()
               }, function (data, textStatus, jqXHR) {
                   $.each(data, function (indice, resultado) {
                       $("#slcVeiculo").append($('<option>', {value: resultado.id}).text(resultado.placa));
                   });
               });
           }) ;
        });

        Date.prototype.addDays = function(days) {
            var dat = new Date(this.valueOf());
            dat.setDate(dat.getDate() + days);
            return dat;
        };

        function readOnlyValores(id){
            $('#data_execucao').attr('disabled', 'true');
            $('#horario_inicio').attr('disabled', 'true');
            $('#horario_fim').attr('disabled', 'true');
            $('#descricao').attr('disabled', 'true');
            $('#servico').attr('disabled', 'true');
            $('#ferramenta').attr('disabled', 'true');
            $('#btnFinalizar').prop('disabled', true);

            $.getJSON("{{ route('getOrdemServico') }}", {
                id: id
            }, function (data, textStatus, jqXHR) {
                $.each(data, function (indice, resultado) {

                    $('#data_execucao').val(resultado.data_execucao.split(" ")[0]);
                    $('#horario_inicio').val(resultado.horario_inicio);
                    $('#horario_fim').val(resultado.horario_fim);
                    $('#descricao').val(resultado.descricao);
                    $('#servico').val(resultado.servico);
                    $('#ferramenta').val(resultado.ferramenta);
                    $('#secretaria').val(resultado.secretaria);
                });
            });
        }

        function atribuirValores(id){
            $('#data_execucao').attr('disabled', null);
            $('#horario_inicio').attr('disabled', null);
            $('#horario_fim').attr('disabled', null);
            $('#descricao').attr('disabled', null);
            $('#servico').attr('disabled', null);
            $('#ferramenta').attr('disabled', null);
            $('#btnFinalizar').prop('disabled', null);
            $('#horario_fim').val("");
            $('#servico').val("");
            $('#ferramenta').val("");
            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);

            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            var hours = ("0" + now.getHours()).slice(-2);
            var minutes = ("0" + now.getMinutes()).slice(-2);

            var timeNow = hours+":"+minutes;

            $.getJSON("{{ route('getTipoPreventiva') }}", {
                preventiva_id: id
            }, function (data, textStatus, jqXHR) {
                $.each(data, function (indice, resultado) {
                    $("#descricao").val(resultado.tipo_preventiva);
                    $("#secretaria").val(resultado.secretaria);
                    $("#veiculo_id").val(resultado.veiculo);
                    //Formatar a data para salvar no banco (data_prevista)
                    var data_prevista = resultado.data_prevista.split(" ");
                    var ano_previsto = data_prevista[0].split("-")[0];
                    var mes_previsto = data_prevista[0].split("-")[1];
                    var dia_previsto = data_prevista[0].split("-")[2];
                    var data = new Date(ano_previsto, parseInt(mes_previsto)-1, dia_previsto);
                    data = data.addDays(parseInt(resultado.intervalo));

                    var day = ("0" + data.getDate()).slice(-2);
                    var month = ("0" + (data.getMonth() + 1)).slice(-2);
                    data_prevista = data.getFullYear()+"-"+(month)+"-"+(day) ;

                    $("#data_prevista").val(data_prevista);
                });
            });

            $('#data_execucao').val(today);
            $('#horario_inicio').val(timeNow);
            $('#preventiva_id').val(id);
        }
    </script>
@endsection