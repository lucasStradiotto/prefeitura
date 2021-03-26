@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexExame') }}">Exames</a></li>
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
        @if(isset($exame))
            <form class="container" method="post" action="{{ route('updateExame', $exame->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeExame') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$exame->nome or old('nome')}}">
                        </div>
                        <div>
                            Grupo de Exame
                        </div>
                        <div>
                            <select name="tipo_exame_id">
                                <option value="">Selecione o grupo do Exame</option>
                                @foreach ($tiposExame as $tipoExame)
                                    <option value="{{$tipoExame->id}}"
                                            @if (isset($exame))
                                                @if ($tipoExame->id == $exame->tipo_exame_id)
                                                    selected
                                                @endif
                                            @endif
                                    >{{$tipoExame->nome}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createTipoExame') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Tipo de Padrão
                        </div>
                        <div>
                            <select name="tipo_padroes_id" id="slcTipoPadrao">
                                <option value="0">Selecione o tipo de Padrão</option>
                                @foreach ($tiposPadrao as $tipoPadrao)
                                    <option value="{{$tipoPadrao->id}}"
                                            @if (isset($exame))
                                                @if ($tipoPadrao->id == $exame->tipo_padroes_id)
                                                    selected
                                                @endif
                                            @endif
                                    >{{$tipoPadrao->nome}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createTipoPadroes') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div id="divPadrao">

                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>

    <script>
        $(document).ready(function(){
            $(document).on("change","#slcTipoPadrao",function(e){
                e.preventDefault();
                if ($("#slcTipoPadrao option:selected").text()=="Binário")
                {
                    $("#divPadrao").empty();
                    $("#divPadrao").append("Esperado<br>");
                    $("#divPadrao").append("<select id='slcPadraoEsperado' name='padrao_esperado_id'>");
                    $("#slcPadraoEsperado").append("<option value='0'>Selecione o Padrão Esperado</option>");

                    $("#divPadrao").append("<br>Não Esperado<br>");
                    $("#divPadrao").append("<select id='slcPadraoNaoEsperado' name='padrao_nao_esperado_id'>");
                    $("#slcPadraoNaoEsperado").append("<option value='0'>Selecione o Padrão Não Esperado</option>");

                    $.getJSON("{{ route('getPadroes') }}", {
                        tipo_padrao_id: $("#slcTipoPadrao option:selected").val()
                    }, function (data, textStatus, jqXHR) {
                        $.each(data, function (indice, padrao) {
                            // recuperado o padrão esperado se for uma edição de exame
                            var esperado = '@if(isset($exame)){{$exame->padrao_esperado_id}}'@endif;
                            var naoEsperado = '@if(isset($exame)){{$exame->padrao_nao_esperado_id}}'@endif;

                            // verifica se o padrão do foreach é igual ao padrão do exame
                            if (esperado == padrao.id)
                            {
                                $("#slcPadraoEsperado").append($('<option>', {value: padrao.id, selected: 'true'}).text(padrao.nome));
                            }
                            else
                            {
                                $("#slcPadraoEsperado").append($('<option>', {value: padrao.id, selected: false}).text(padrao.nome));
                            }
                            if (naoEsperado == padrao.id)
                            {
                                $("#slcPadraoNaoEsperado").append($('<option>', {value: padrao.id, selected: 'true'}).text(padrao.nome));
                            }
                            else
                            {
                                $("#slcPadraoNaoEsperado").append($('<option>', {value: padrao.id, selected: false}).text(padrao.nome));
                            }
                        });
                    });
                }
                else if ($("#slcTipoPadrao option:selected").text()=="Intervalo")
                {
                    $("#divPadrao").empty();
                    $("#divPadrao").append("Min<br>");
                    $("#divPadrao").append("<select id='slcPadraoMinimo' name='min_esperado_id'>");
                    $("#slcPadraoMinimo").append("<option value='0'>Min</option>");

                    $("#divPadrao").append("<br>Max<br>");
                    $("#divPadrao").append("<select id='slcPadraoMaximo' name='max_esperado_id'>");
                    $("#slcPadraoMaximo").append("<option value='0'>Max</option>");

                    $.getJSON("{{ route('getPadroes') }}", {
                        tipo_padrao_id: $("#slcTipoPadrao option:selected").val()
                    }, function (data, textStatus, jqXHR) {
                        $.each(data, function (indice, padrao) {
                            var min = '@if(isset($exame)){{$exame->min_esperado_id}}'@endif;
                            var max = '@if(isset($exame)){{$exame->max_esperado_id}}'@endif;
                            if (min == padrao.id)
                            {
                                $("#slcPadraoMinimo").append($('<option>', {value: padrao.id, selected: 'true'}).text(padrao.nome));
                            }
                            else
                            {
                                $("#slcPadraoMinimo").append($('<option>', {value: padrao.id, selected: false}).text(padrao.nome));
                            }
                            if (max == padrao.id)
                            {
                                $("#slcPadraoMaximo").append($('<option>', {value: padrao.id, selected: 'true'}).text(padrao.nome));
                            }
                            else
                            {
                                $("#slcPadraoMaximo").append($('<option>', {value: padrao.id, selected: false}).text(padrao.nome));
                            }
                        });
                    });
                }
            });
            $("#slcTipoPadrao").change();
        });
    </script>
@endsection