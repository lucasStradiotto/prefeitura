@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createVeiculosExames') }}" class="btn btn-success"> Atribuir Novos Exames</a>
        <br><br>
        <div>
            <select id="veiculoSelecionado">
                <option value="0">Filtrar por Veículo</option>
                @foreach($veiculos as $veiculo)
                    <option value="{{$veiculo->id}}">
                        {{$veiculo->placa}}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-success" id="btnFiltrar">Filtrar</button>
        </div>
        <form action="{{route('deleteVeiculosExames')}}">
            <div id="tabelaExames">

            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#btnFiltrar").click(function(){
                if ($("#veiculoSelecionado").val() != 0)
                {
                    $.getJSON("{{ route('getExamesDoVeiculo') }}", {
                        veiculo_id: $("#veiculoSelecionado").val()
                    }, function (data, textStatus, jqXHR) {
                        if (data.length > 0)
                        {
                            $("#tabelaExames").empty();
                            $("#tabelaExames").append("<table class='table' id='exames'><tr><th>Exames Atribuidos</th><th>Remover</th></tr>");
                            $.each(data, function (indice, retorno) {
                                $("#exames").append("<tr>" +
                                    "<td>" + retorno.nome + "</td>" +
                                    "<td><input type='checkbox' name='veiculo_exame_id_" + retorno.veiculo_exame_id + "' id='" + retorno.veiculo_exame_id + "' value='" + retorno.veiculo_exame_id + "'/></td>" +
                                    "</tr>");
                            });
                            $("#tabelaExames").append("</table>");
                            $("#tabelaExames").append("<button disabled class='btn btn-danger' id='btnDeletar'>Remover Exames</button>");
                        }
                        else
                        {
                            $("#tabelaExames").empty();
                            $("#tabelaExames").append("<table class='table' id='exames'><tr><th>Não foram encontrados Exames atribuídos à este Veículo.</th></tr></table>");
                        }
                    });
                }
                else
                {
                    $("#tabelaExames").empty();
                }
            });

            $(document).on("change", "input:checkbox", function(){
                if ($('input:checkbox:checked').length > 0)
                    $("#btnDeletar").removeAttr('disabled');
                else
                    $("#btnDeletar").attr('disabled', true);
            });
        })
    </script>
@endsection