<style>
    .highchart-container {
        min-width: 310px;
        height: 500px;
        /*margin: 0 auto;*/
    }

    .highchart-hide {
        display: none;
    }

    .header {
        width: 100%;
        height: 200px;
    }

    .logo-prefeitura {
        float: left;
    }

    .logo-prefeitura img {
        width: 150px;
        height: auto;
    }

    .txt-header {
        float: left;
    }

    .txt-header h1, h4, h5 {
        color: black;
        font-weight: bold;
        margin-left: 5%;
    }

    .txt-header h1 {
        width: 100%;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>
@if(isset($prefeitura) && isset($prefeitura['nome']))
    <div class="header">
        <div class="logo-prefeitura">

            <img style="width: 170px;" src="{{asset('img/'.$prefeitura->logo)}}"/>

        </div>
        <div id="texto" class="txt-header" style='text-align: center;'>
            {{--<h4>INVENTÁRIO E DIAGNÓSTICO DA ARBORIZAÇÃO URBANA</h4>--}}
            {{--<h5>MUNICÍPIO VERDE E AZUL</h5>--}}
        </div>
    </div>
@endif
{{--<div id="container-cidade" class="highchart-container"></div>--}}
<script>
    $(document).ready(function () {

        $.getJSON("{{ url('getPrefeitura') }}", {}, function (data, textStatus, jqXHR) {
            if (data.nome) {
                $('#texto').append($('<h1>').text(data.nome));
                $("#texto").append("<p>DADOS EXTRAÍDOS DO SISTEMA GESTÃO DE ABASTECIMENTO CIDADE FÁCIL - SONNITECH</p>");
                console.log($("#texto"));
            }
        });

    });

</script>
