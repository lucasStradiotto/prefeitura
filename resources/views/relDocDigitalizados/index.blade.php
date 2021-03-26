@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form action="{{route('gerarRelDocDigitalizados')}}">
            
            <div>Ano</div>
            <div>
                <select name="ano" id="slc-ano"></select>
            </div>
            
            <div>Mês</div>
            <div>
                <select name="mes">
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
            </div>

            <div>Secretaria: </div>
            <div>
                <select name="secretaria" id="slc_secretaria"></select>
            </div>

            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
    <script>
    var nomes = [];
        $(document).ready(function()
        {
            //Preechendo anos no select
            let ano = new Date().getFullYear();
            let toAppend = '<option value='+(ano-2)+'>'+(ano-2);
            toAppend += '<option value='+(ano-1)+'>'+(ano-1);
            toAppend += '<option selected value='+(ano)+'>'+(ano);
            $("#slc-ano").append(toAppend);
            $("#slc-veiculo").select2();

            $.getJSON("{{route('getSecretariasRelDocDigitalizados')}}", {} , function(data)
            {
                $.each(data,function(index, item)
                {
                    $("#slc_secretaria").append(`<option value='${item.id}'>${item.nome}</option>`);
                })
            });
    });
    </script>
@endsection