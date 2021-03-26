@extends('layouts.app')

@section('content')

    <style>
        .inputfile {
        display: inline-block;
        margin-bottom: 0;
        font-weight: normal;
        text-align: center;
        touch-action: manipulation;
        cursor: pointer;
        width: 34px;
        height: 34px;
        font-size: 14px;
        color: white;
        background-color: #2ab27b;
        border-radius:4px;
        vertical-align:middle;
        padding: 6px 12px;
        line-height: 1.42857143;
        }

        .inputfile:focus,
        .inputfile:hover {
        background-color: #259d6d;
        }

        .inputfile:active::after{
            background-color:red;
        }



    </style>

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexCorretiva') }}">Corretivas</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        @if(isset($corretiva))
            <form id="formCorretiva" class="container" method="post" action="{{ route('updateCorretiva', $corretiva->id) }}" enctype="multipart/form-data">
                {!! method_field('PUT') !!}
        @else
            <form id="formCorretiva" class="container" method="post" action="{{ route('storeCorretiva') }}" enctype="multipart/form-data">
        @endif
            {!! csrf_field() !!}
            <div style="display:inline-block;margin-right:20px;">
                <label for="name" style="display:block">Veículo</label>
                <select name="veiculo_id">
                    @foreach($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}"
                        @if(isset($corretiva) && $corretiva->veiculo_id == $veiculo->id)
                            selected
                        @endif
                        >
                            {{$veiculo->placa}}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>

            @if (isset($corretiva))
                <div style="display:inline-block;margin-right:20px;">
                    <label for="data_execucao" style="display:block">Data</label>
                    <input type="date" name="data_execucao" id="data_execucao">
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="horario_inicio" style="display:block">Horário Início</label>
                    <input type="time" name="horario_inicio" id="horario_inicio">
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="horario_fim" style="display:block">Horário Fim</label>
                    <input type="time" name="horario_fim" id="horario_fim">
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="numero_orcamento" style="display:block">Nº Orçamento</label>
                    <input type="number" name="numero_orcamento" id="numero_orcamento">
                    <input type="file" name="numero_orcamento_doc" id="numero_orcamento_doc" accept=".pdf, .PDF, .png, .PNG, .jpg, .JPG,.jpeg, .JPEG" style="display:none">
                    <label for="numero_orcamento_doc" class="inputfile"><i class="glyphicon glyphicon-plus" title="Anexar Arquivo" style="vertical-align:middle;"></i></label>
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="numero_empenho" style="display:block">Nº Empenho</label>
                    <input type="number" name="numero_empenho" id="numero_empenho">
                    <input type="file" name="numero_empenho_doc" id="numero_empenho_doc" accept=".pdf, .PDF, .png, .PNG, .jpg, .JPG, .jpeg, .JPEG" style="display:none">
                    <label for="numero_empenho_doc" class="inputfile"><i class="glyphicon glyphicon-plus" title="Anexar Arquivo" style="vertical-align:middle;"></i></label>
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="numero_autorizacao" style="display:block">Nº Autorização</label>
                    <input type="number" name="numero_autorizacao" id="numero_autorizacao">
                    <input type="file" name="numero_autorizacao_doc" id="numero_autorizacao_doc" accept=".pdf, .PDF, .png, .PNG, .jpg, .JPG, .jpeg, .JPEG" style="display:none">
                    <label for="numero_autorizacao_doc" class="inputfile"><i class="glyphicon glyphicon-plus" title="Anexar Arquivo" style="vertical-align:middle;"></i></label>
                </div>

                <div style="display:inline-block;margin-right:20px;">
                    <label for="nf" style="display:block">Nº Nota Fiscal</label>
                    <input type="number" name="nf" id="nf">
                    <input type="file" name="nf_doc" id="nf_doc" accept=".pdf, .PDF, .png, .PNG, .jpg, .JPG, .jpeg, .JPEG" style="display:none;">
                    <label for="nf_doc" class="inputfile"><i class="glyphicon glyphicon-plus" title="Anexar Arquivo" style="vertical-align:middle;"></i></label>
                </div>
            @endif


            <div>
                <label style="display:block">Descrição</label>
                <textarea id="placeholder" name="descricao" rows= "6" cols= "120" placeholder="{{$corretiva->descricao or 'Descrição'}}"></textarea>
            </div>
            @if (isset($corretiva))
                <div>
                    <label style="display:block">Serviço</label>
                    <textarea name="servico" rows= "6" cols= "120" value="{{old('servico')}}"></textarea>
                </div>

                <div>
                    <label style="display:block">Ferramentas (Opcional)</label>
                    <textarea name="ferramenta" rows= "6" cols= "120" value="{{old('ferramenta')}}"></textarea>
                </div>
                <div>
                    <label style="display:block">Peças Utilizadas</label>
                    <table border="1" style="text-align: center; width: 97%;" id="tabelaPecas">
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
            @endif
            <button class="btn btn-success" id="btnEnviar">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            var update;
            if ($("#tabelaPecas").length > 0)
                update = true;
            else
                update = false;

            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);

            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            var hours = ("0" + now.getHours()).slice(-2);
            var minutes = ("0" + now.getMinutes()).slice(-2);

            var timeNow = hours+":"+minutes;

            $('#data_execucao').val(today);
            $('#horario_inicio').val(timeNow);

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
                    "<span class='btn btn-danger btnRmPeca' id='"+indexTr+"' style='width: 100%;'>-</span>" +
                    "</td>" +
                    "</tr>");
                indexTr++;
            });

            $("#btnEnviar").click(function(e){
                e.preventDefault();
                var valueDescricao;
                if ($("#placeholder")[0].value == "")
                   valueDescricao = $("#placeholder")[0].placeholder;
                else
                    valueDescricao = $("#placeholder")[0].value;

                if (valueDescricao != "Descrição")
                {
                    $("#placeholder")[0].value = valueDescricao;

                    var codigos = document.getElementsByClassName("codigo");
                    var valores = document.getElementsByClassName("valor");
                    var nomes = document.getElementsByClassName("nome");
                    var total = 0;
                    var nulo = false;
                    if (update)
                    {
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
                                $("#formCorretiva").submit();
                            }
                        }
                        else
                            alert("Preencha a tabela de peças.");
                    }
                    else
                    {
                        $("#formCorretiva").submit();
                    }
                }
                else
                {
                    alert("Preencha uma Descrição para a Ordem de Serviço.");
                }
            });
            $(document).on("click", ".btnRmPeca", function(){
                var linha = $(this)[0].id;
                $("#tr"+linha).remove();
            });
        });
    </script>
@endsection