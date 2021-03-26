@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li><a href="{{ route('indexProtocolo') }}">Protocolos</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
    <form method="post" target="_blank" action="{{route("triagemDocumentos", $idProtocolo)}}">
        {{csrf_field()}}
        <div>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        </div>
        <br>
        <div>
            <h2>Engenheiro Responsável</h2>
            <select name="engenheiro">
                @foreach ($engenheiros as $engenheiro)
                    <option value="{{$engenheiro->nome}}"> {{$engenheiro->nome}} </option>
                @endforeach
            </select>
        </div>
        {{--<div>--}}
            {{--<h2>Estagiário Responsável</h2>--}}
            {{--<select name="estagiario">--}}
                {{--@foreach ($estagiarios as $estagiario)--}}
                    {{--<option value="{{$estagiario->nome}}"> {{$estagiario->nome}} </option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        <div>
            <h2>Tipo do Documento</h2>
            <select name="documento" id="documento">
                <option value="alvDem">Alvará de Demolição</option>
                <option value="cerDem">Certidão de Demolição</option>
                <option value="habite">Habite-se</option>
                <option value="cerCon">Certidão de Construção</option>
            </select>
        </div>
        <div>
            Tipo do Prédio
        </div>
        <div>
            <select name="tipo-predio" id="tipo-predio">
                <option value="Residencial">Residencial</option>
                <option value="Comercial">Comercial</option>
                <option value="Misto">Misto</option>
            </select>
        </div>
        <br>
        <button id="btn-avancar" class="btn btn-danger">Avançar</button>
        <div id="conteudo-adicional"></div>
        <div id="btns"></div>
    </form>
    <script>
        $(document).ready(function (e) {
            $("#btn-avancar").click(function(e){
                e.preventDefault();
                let $documento = $("#documento option:selected");
                let $tipoPredio = $("#tipo-predio option:selected");

                let $conteudoAdicional = $("#conteudo-adicional");
                $conteudoAdicional.empty();

                if ($documento.val() == "cerCon") {
                    let toAppend = '<br><div><label>';
                    toAppend += '<input type="text" name="matricula"></input>Nº de Matrícula';
                    toAppend += '</label></div>';
                    $conteudoAdicional.append(toAppend);

                    let topAppend = '<div>Construção</div><div>';
                    topAppend += '<select name="tipo-construcao" id="tipo-construcao">';
                    topAppend += '<option value="Alvenaria">Alvenaria</option>';
                    topAppend += '<option value="Madeira">Madeira</option>';
                    topAppend += '</select></div>';
                    $conteudoAdicional.append(topAppend);

                    if ($tipoPredio.val() == "Misto")
                    {
                        let toappend = "<br><label>Residencial: <input style='width: 50px;' type='text' name='metragem_res'></input>m²</label>";
                        toappend += "<br><label>Comercial: <input style='width: 50px;' type='text' name='metragem_com'>m²</input></label>";
                        $conteudoAdicional.append(toappend);

                        let toAppend = '<br><b>Comodos Residenciais</b><br><textarea name="comodos_res"></textarea>';
                        toAppend += '<br><b>Comodos Comerciais</b><br><textarea name="comodos_com"></textarea>';
                        $conteudoAdicional.append(toAppend);
                    }
                    else
                    {
                        let toAppend = '<br><b>Comodos</b><br><textarea name="comodos"></textarea>';
                        $conteudoAdicional.append(toAppend);
                    }

                    toAppend = '<br><b>Projetos Anteriores</b><br>';
                    toAppend += '<textarea name="obs"></textarea>';
                    $conteudoAdicional.append(toAppend);

                    toAppend = '<br><b>Tipo de Cobertura</b><br>';
                    toAppend += '<input name="tipo_cobertura"></input>';
                    $conteudoAdicional.append(toAppend);
                }
                else if ($documento.val() == "cerDem")
                {
                    let topAppend = '<div>Construção</div><div>';
                    topAppend += '<select name="tipo-construcao" id="tipo-construcao">';
                    topAppend += '<option value="Alvenaria">Alvenaria</option>';
                    topAppend += '<option value="Madeira">Madeira</option>';
                    topAppend += '</select></div>';
                    $conteudoAdicional.append(topAppend);
                }
                else if ($documento.val() == "habite")
                {
                    if ($tipoPredio.val() == "Misto")
                    {
                        let toappend = "<br><label>Residencial: <input style='width: 50px;' type='text' name='metragem_res'></input>m²</label>";
                        toappend += "<br><label>Comercial: <input style='width: 50px;' type='text' name='metragem_com'>m²</input></label>";
                        $conteudoAdicional.append(toappend);
                    }

                    let topAppend = '<div>Construção</div><div>';
                    topAppend += '<select name="tipo-construcao" id="tipo-construcao">';
                    topAppend += '<option value="Alvenaria">Alvenaria</option>';
                    topAppend += '<option value="Madeira">Madeira</option>';
                    topAppend += '</select></div>';
                    $conteudoAdicional.append(topAppend);
                }
                else if ($documento.val() == "alvDem"){

                }

                let toAppend = '<button class="btn btn-success">Gerar</button>';
                $("#btns").empty();
                $("#btns").append(toAppend);
            });
            //Quando alterar o valor do select Tipo de Documento
            // $("#documento").change(function () {
            //     let $documento = $("#documento option:selected");
            //
            //     let $conteudoAdicional = $("#conteudo-adicional");
            //     $conteudoAdicional.empty();
            //     if ($documento.val() == "cerCon")
            //     {
            //         let toAppend = '<br><div><label>';
            //         toAppend += '<input type="text" name="matricula"></input>Nº de Matrícula';
            //         toAppend += '</label></div>';
            //         $conteudoAdicional.append(toAppend);
            //
            //         let topAppend = '<div>Construção</div><div>';
            //         topAppend += '<select name="tipo-construcao" id="tipo-construcao">';
            //         topAppend += '<option value="Alvenaria">Alvenaria</option>';
            //         topAppend += '<option value="Madeira">Madeira</option>';
            //         topAppend += '</select></div>';
            //         $conteudoAdicional.append(topAppend);
            //
            //         if ($("#tipo-predio option:selected").val() == "Misto")
            //         {
            //             let toAppend = '<br><b>Comodos Residenciais</b><br><textarea name="comodos_res"></textarea>';
            //             toAppend += '<br><b>Comodos Comerciais</b><br><textarea name="comodos_com"></textarea>';
            //             $conteudoAdicional.append(toAppend);
            //         }
            //         else
            //         {
            //             let toAppend = '<br><b>Comodos</b><br><textarea name="comodos"></textarea>';
            //             $conteudoAdicional.append(toAppend);
            //         }
            //     }
            //     else if (($documento.val() == "cerDem")||
            //         ($documento.val() == "habite"))
            //     {
            //         let topAppend = '<div>Construção</div><div>';
            //         topAppend += '<select name="tipo-construcao" id="tipo-construcao">';
            //         topAppend += '<option value="Alvenaria">Alvenaria</option>';
            //         topAppend += '<option value="Madeira">Madeira</option>';
            //         topAppend += '</select></div>';
            //         $conteudoAdicional.append(topAppend);
            //     }
            //     else
            //     {
            //     }
            // });

            //Quando alterar o valor do select Tipo de Prédio
            // $("#tipo-predio").change(function(){
            //     if ($(this).val() == 'Misto')
            //     {
            //         let toappend = "<br><label>Residencial: <input style='width: 50px;' type='text' name='metragem_res'></input>m²</label>";
            //         toappend += "<br><label>Comercial: <input style='width: 50px;' type='text' name='metragem_com'>m²</input></label>";
            //         $conteudoAdicional.append(toappend);
            //
            //         if ($("#documento option:selected").val() == "cerCon")
            //         {
            //             let toAppend = '<br><b>Comodos Residenciais</b><br><textarea name="comodos_res"></textarea>';
            //             toAppend += '<br><b>Comodos Comerciais</b><br><textarea name="comodos_com"></textarea>';
            //             $conteudoAdicional.append(toAppend);
            //
            //             toAppend = '<br><b>Informações adicionais</b><br>';
            //             toAppend += '<textarea name="obs"></textarea>';
            //             $conteudoAdicional.append(toAppend);
            //         }
            //         else
            //         {
            //         }
            //     }
            //     else {
            //         $metragem.empty();
            //         if ($("#documento option:selected").val() == "cerCon")
            //         {
            //             $comodos.empty();
            //             let toAppend = '<br><b>Comodos</b><br><textarea name="comodos"></textarea>';
            //             $comodos.append(toAppend);
            //
            //             $obs.empty();
            //             toAppend = '<br><b>Informações adicionais</b><br>';
            //             toAppend += '<textarea name="obs"></textarea>';
            //             $obs.append(toAppend);
            //         }
            //         else
            //         {
            //             $comodos.empty();
            //         }
            //     }
            // });
        });
    </script>

@endsection
