@extends('layouts.app')

@section('content')
    <div id="estilo">
        <style>
            .divEscondida{
                display: none;
                height: 29cm;
            }
            #imgLogo{
                width: 239px;
                height: 196px;
            }
            #header{
                width: 80%;
                height: 200px;
            }
            #txtOS{
                float: left;
                width: 40%;
                font-size: 2em;
            }
            #txtN{
                float: left;
                width: 10%;
                font-size: 2em;
            }
            #divIMG{
                float: left;
                width: 50%;
                text-align: center;
            }
            .contents{
                width: 80%;
                margin-top: 1%;
            }
            .wid80ML95{
                width: 80%;
                margin-left: 95px;
            }
            .wid80MT5{
                width: 80%;
                margin-top: 3%;
            }
            .wid20{
                width: 20%;
            }
            .wid10{
                width: 10%;
            }
            .ML95MT2{
                margin-left: 95px;
                margin-top: 2%;
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
            <table class="table">
                <tr>
                    <th>Preventiva</th>
                    <th>Placa</th>
                    <th>Setor</th>
                    <th>Imprimir</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" class="col-md-offset-10" id="checkPai"> Selecionar Todos</td>
                </tr>
                @for($i=0; $i<count($preventivas); $i++)
                    <tr id="{{$i}}">
                        <td>{{$tiposPreventiva[$i][0]->nome}}</td>
                        <td>{{$veiculos[$i][0]->placa}}</td>
                        <td>{{$secretarias[$i][0]->nome}}</td>
                        <td style="display: none;" id="preventiva_id">{{$preventivas[$i]->id}}</td>
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
            var i = 0;
            $("input:checkbox").each(function(){
                if($(this)[0].id != "checkPai")
                {
                    if($(this)[0].checked)
                    {
                        ids[i] = "Nº " + $(this).parent().parent().children()[3].outerText;
                        secretarias[i] = $(this).parent().parent().children()[2].innerHTML;
                        descricoes[i] = $(this).parent().parent().children()[0].innerHTML;
                        i++;
                    }
                }
            });
            printdiv(ids, secretarias, descricoes);
        }

        function printdiv(ids, secretarias, descricoes) {
            var i;
            var data = "";
            for (i=0; i<ids.length;i++)
            {
                $("#txtN")[0].innerHTML = ids[i];
                $("#secretaria")[0].attributes[1].value = secretarias[i];
                $("#descServ")[0].firstChild.innerHTML = descricoes[i];
                if (i==0)
                {
                    var headstr = "<html><head><style>@media print {#btnPrint{display:none}}<\/style>" + document.head.innerHTML + document.all.item('estilo').innerHTML + "</head><body><button onclick='imprimir()' id='btnPrint'>Imprimir</button>";
                    var footstr = "</body><script>function imprimir(){window.print();}<\/script></html>";
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