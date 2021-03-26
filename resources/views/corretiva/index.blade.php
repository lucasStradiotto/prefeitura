@extends('layouts.app')

@section('content')

    <div id="estilo">
        <style>
            .divEscondida{
                margin-bottom: 75px;
                display: none;

            }
            #imgLogo{
                width: 125px;
                height: 125px;
            }
            #header{
                width: 658px;
                height: 170px;
            }
            #txtOS{
                margin-top: 25px;
                float: left;
                width: 40%;
                font-size: 1.5em;
            }
            #txtN{
                float: left;
                width: 10%;
                font-size: 1.5em;
            }
            #divIMG{
                float: left;
                width: 50%;
                text-align: center;
            }
            .contents{
                margin-top: 1%;
            }
            .wid80ML95{
                width: 850px;
                margin-left: 95px;
            }
            .wid80MT5{
                width: 658px;
                margin-top: 3%;
            }
            .wid20{
                margin-top: 4px;
                width: 200px;
            }
            .wid10{
                width: 10%;
            }
            .ML95MT2{
                margin-left: 95px;
                margin-top: 5px;
            }
            .borderSolidWid100ML95{
                border: solid 1px black;
                width: 100%;
                margin-left: 95px;
            }
            .borderSolid{
                border: solid 1px black;
            }


            p{
                display: inline;
            }

            @media print{
                #imgLogo{
                    width: 159px;
                    height: 130px;
                }
            }
        </style>
    </div>

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createCorretiva') }}" class="btn btn-success"> Novo</a>
        <div>

            <div>
                <button class="btn btn-primary col-md-offset-10" onclick="addValues()">Preparar para Impressão</button>
            </div>
            <div id="printdiv">
                <div class="divEscondida">
                    <div id="conteudo">
                        <div id="header">
                            <div id="divIMG"><img id="imgLogo" src="{{ URL::asset('img/logo_lins.png') }}"></div>
                            <div id="txtOS">Ordem de Serviço</div>
                            <div id="txtN">N° 1230</div>
                        </div>
                        <div class="contents">
                            <div class="wid80ML95">
                                <p class="wid20">Data de Execução:
                                    <input class="wid20">
                                <p class="wid20">Horário:
                                    <input class="wid10">
                                <p class="wid20">Até:
                                    <input class="wid10">
                            </div>
                            <div class="wid80ML95">
                                <p class="wid20">Secretaria:
                                    <input id="secretaria" value="sec" disabled>
                            </div>
                        </div>
                        <div class="contents">
                            <div>
                                <div class="ML95MT2">Fotos do veículo</div>
                                <div class="ML95MT2" style="float: left" id="fotoveic1"></div>
                                <div class="ML95MT2" id="fotoveic1_placa"></div>
                                                            </div>
                        </div>
                        <div class="contents">
                            <div>
                                <div class="ML95MT2">Descrição do Serviço a Executar</div>
                                <div class="ML95MT2" id="descServ"><textarea rows="4" cols="70"></textarea></div>
                            </div>
                            <div>
                                <div class="ML95MT2">Descrição do Serviço Executado</div>
                                <div class="ML95MT2"><textarea rows="4" cols="70"></textarea></div>
                            </div>
                            <div>
                                <div class="ML95MT2">Ferramentas Utilizadas</div>
                                <div class="ML95MT2"><textarea rows="4" cols="70"></textarea></div>
                            </div>
                        </div>
                        <div class="wid80MT5">
                            <div class="ML95MT2">Peças Utilizadas</div>
                            <table class="borderSolidWid100ML95">
                                <tr class="borderSolid">
                                    <th class="borderSolid">Código</th>
                                    <th class="borderSolid">Descrição</th>
                                    <th class="borderSolid">Quantidade</th>
                                    <th class="borderSolid">Valor Unit.</th>
                                </tr>
                                @for($rows=0; $rows<12; $rows++)
                                    <tr class="borderSolid">
                                        @for($cols=0; $cols<4; $cols++)
                                            <td class="borderSolid">&nbsp;</td>
                                        @endfor
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<div id="img"></div>
            <table class="table">
                <tr>
                    <th>Placa</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Serviço</th>
                    <th>Ações</th>
                    <th>Imprimir</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" class="col-md-offset-10" id="checkPai"> Selecionar Todos</td>
                </tr>
                @for($i=0; $i<count($corretivas); $i++)
                    <tr
                    @if($corretivas[$i]->servico!="")
                        style="background-color: #bcffc7;"
                    @else
                        style="background-color: #ffc9c4;"
                    @endif
                    >
                    @foreach($veiculos as $veiculo)
                        @if ($veiculo->id == $corretivas[$i]->veiculo_id)
                            <td>{{$veiculo->placa}}</td>
                            <td hidden>{{$veiculo->id}}</td>
                            @foreach($secretarias as $secretaria)
                                @if ($secretaria->id == $veiculo->secretaria_id)
                                    <td hidden id="secretaria">{{$secretaria->nome}}</td>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <td>{{$corretivas[$i]->descricao}}</td>
                    @if (isset($corretivas[$i]->data_execucao))
                        <td>{{$corretivas[$i]->data_execucao->format('d/m/Y')}}</td>
                    @else
                        <td>&nbsp;</td>
                    @endif
                    <td>{{$corretivas[$i]->servico}}</td>
                    <td hidden id="corretiva_id">{{$corretivas[$i]->id}}</td>
                    @if($corretivas[$i]->servico!="")
                        <td>&nbsp;</td>
                    @else
                        <td><a href="{{ route('editCorretiva', $corretivas[$i]->id) }}" class="btn btn-danger" title="Fechar Ordem de Serviço"><i class="glyphicon glyphicon-edit"></i></a></td>
                    @endif
                    <td><input type="checkbox" id="check{{$i}}"></td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>

    <script>
        var j = 0;
        $("input:checkbox").change(function(){
            if($(this)[0].id == "checkPai")
            {
                if(!$(this)[0].checked)
                    j = 0;
                else
                    j = $("input:checkbox").length-1;
            }
            else
            {
                if($(this)[0].checked)
                    j++;
                else
                    j--;
            }
        });

        function addValues(){
            var ids = [];
            var secretarias = [];
            var descricoes = [];
            var veiculoimg = [];
            var veiculoplaca = [];

            var i = 0;
            var envia=0
            $("input:checkbox").each(function(){
                if($(this)[0].id != "checkPai")
                {
                    if($(this)[0].checked)
                    {
                        ids[i] = "Nº " + $(this).parent().parent().children()[6].innerHTML; //ação
                        secretarias[i] = $(this).parent().parent().children()[2].innerHTML;
                        descricoes[i] = $(this).parent().parent().children()[3].innerHTML;
                        $.ajax({
                           url: "corretiva/downloadAllImagemVeiculo?veiculo_id=" + $(this).parent().parent().children()[1].innerHTML,
                            async:false,
                            method:"GET",
                        }).done(
                            function (imagem) {
                                if(imagem["response_img"] != undefined){
                                    veiculoimg[i] = "<img src='" + imagem["response_img"].original.encoded + "' style='float:left; width: 200px; height: 180px;'/>";
                                }
                                if(imagem["response_img_placa"] != undefined){
                                    veiculoplaca[i] = "<img src='" + imagem["response_img_placa"].original.encoded + "' style='width: 200px; height: 180px;'/>";
                                }
                                i++;
                            }
                        );
                    }
                }
            });
            printdiv(ids, secretarias, descricoes,veiculoimg,veiculoplaca);
        }

        function printdiv(ids, secretarias, descricoes, veiculoimg,veiculoplaca) {
            var i;
            var data = "";

            for (i=0; i<ids.length;i++)
            {
                if(veiculoimg[i] != undefined){
                    $("#fotoveic1")[0].innerHTML =  veiculoimg[i];
                }else{
                    $("#fotoveic1")[0].innerHTML ="<div style='float:left; width: 200px; height: 180px;'></div>";
                }
                if( veiculoplaca[i] != undefined){
                    $("#fotoveic1_placa")[0].innerHTML =  veiculoplaca[i];
                }else{
                    $("#fotoveic1_placa")[0].innerHTML ="<div style='width: 200px; height: 180px;'></div>";
                }
                $("#txtN")[0].innerHTML = ids[i];
                $("#secretaria")[0].attributes[1].value = secretarias[i];
                $("#descServ")[0].firstChild.innerHTML = descricoes[i];
                // $()
                if (i==0)
                {
                    var headstr = "<html>" +
                        "<head>" +
                        "<style>@media print {#btnPrint{display:none}}<\/style>" +
                        document.head.innerHTML + document.all.item('estilo').innerHTML +
                        "</head>" +
                        "<body>" +
                        "<button onclick='imprimir()' id='btnPrint'>Imprimir</button>";

                    var footstr = "</body>" +
                        "<script>function imprimir(){window.print();}<\/script>" +
                        "</html>";
                }
                var newstr = document.all.item('printdiv').innerHTML;

                if (i==0)
                    data += headstr + newstr;
                else
                    data += newstr;

                if (i==ids.length-1)
                {
                    data += footstr;
                   var newWindow = window.open('about:blank', 'window', 'resizable=1,scrollbars=1,width=800,height=600');
                    newWindow.document.write(data);

                    for (var j=0; j<newWindow.document.getElementsByClassName("divEscondida").length; j++)
                    {
                        newWindow.document.getElementsByClassName("divEscondida")[j].style.display = 'block';
                    }

                    newWindow.document.close();
                    return false;
                }
            }
        }

        $("#checkPai").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
            $("input:checkbox").change();
        });

    </script>
@endsection