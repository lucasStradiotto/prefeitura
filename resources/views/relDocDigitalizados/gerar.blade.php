@extends('layouts.app')

@section('content')

<style>
.tbl_rel_doc_dig
{
    width:1000px;
    border: 1px solid #000;
    z-index:999;
}
.tbl_rel_doc_dig .rel_inicio
{
    background-color: #FFF;
    padding:3px;
}
.tbl_rel_doc_dig .rel_resto
{
    background-color: #bde9ba;
    padding:3px;
}
</style>

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>     
    </div>
    <div>
        <button id='btn_imprimir'>Imprimir</button>

        <button id='btn_lotes'>Com/Sem Lotes</button>
    </div>

	<br />

        <?php
            echo($relat);
        ?>
         <script>
        $(document).ready(function()
        {
        var estilo  = 
        `<style>
        .div_rel_central
        {
            width: 100%;
            background-color:#fff;
        }
        .div_setor, .div_quadra, .div_qtdProj, .div_lote
        {
            text-align:center;
            width: 24%;
            display: inline-block;
            margin: 0 auto;
            border:1px solid #000;
        }
        .div_setor div, .div_quadra div, .div_qtdProj div, .div_lote div
        {
            border:1px solid #000;
        }
        </style>`;
            let cont =1;
            $("#btn_lotes").click(function()
            {
                cont++;
                if(cont%2==0)
                {
                    $("#div_lote").hide();
                }
                else
                {
                    $("#div_lote").show();
                }
            });
            $('#btn_imprimir').click(function()
            {
                var content = $('#div_rel_central').html();
                newDoc = window.open('');
                newDoc.document.write(estilo+""+content);
                newDoc.print();
                newDoc.close();
            });
        });
    </script>
@endsection