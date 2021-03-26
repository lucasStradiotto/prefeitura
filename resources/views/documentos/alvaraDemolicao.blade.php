@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">

        <div>
            <form method="post" action="{{route('validateDocument')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="tipo_documento" value="Alvará de Demolição"/>
                <input type="hidden" name="numero_documento" value="{{$numDoc}}/{{date('Y')}}"/>
                <input type="hidden" name="nome_eng" value="{{$engenheiro->nome}}"/>
                <input type="hidden" name="crea_eng" value="{{$engenheiro->crea}}"/>
                <input type="hidden" name="numero_protocolo" value="{{$protocolo->numero}}"/>
                <input type="hidden" name="nome_solicitante" value="{{$protocolo->proprietario}}"/>
                <input type="hidden" name="end_rua" value="{{$protocolo->endereco}}"/>
                <input type="hidden" name="end_numero" value="{{$protocolo->numero}}"/>
                <input type="hidden" name="end_setor" value="{{$protocolo->setor}}"/>
                <input type="hidden" name="end_quadra" value="{{$protocolo->quadra}}"/>
                <input type="hidden" name="end_lote" value="{{$protocolo->lote}}"/>
                <input type="hidden" name="tipo_predio" value="{{$tipo_predio}}"/>
                <input type="hidden" name="data_emissao" value="{{\Carbon\Carbon::now()}}"/>

                @if ($tipo_predio != "Misto")
                <input type="hidden" name="area_construida" value="{{$protocolo->m2}}"/>
                @else
                <input type="hidden" name="metragem_com" value="{{$metragem_com}}"/>
                <input type="hidden" name="metragem_res" value="{{$metragem_res}}"/>
                @endif

                <button class="btn btn-primary noPrintBtn">Validar Documento</button>
            </form>
        </div>
        <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
        <div align="center">
            <img src="{{ URL::asset('img/logo_lins.png') }}" class="printImg">
        </div>
        <div align="center" class="printNomeDoc">
            <h4>
                <b>{{$title}} {{$numDoc}}/{{date('Y')}}</b>
            </h4>
        </div>
        <div align="justify">
            <p class="printText">
                <b>{{$engenheiro->nome}}</b><br>
                <b>CREA - {{$engenheiro->crea}}</b> - Responsável pela Divisão de Projeto da Prefeitura Municipal de Lins,
                Estado de São Paulo, CERTIFICA, ao que lhe foi requerido em Petição n° <b>{{$protocolo->l}}</b>
                por <b>{{$protocolo->proprietario}}</b>
                para
                os fins de Direito, que não se trata de imóvel de Patrimônio Histórico, <b>autoriza a Demolição</b> de
                um prédio
                {{$tipo_predio}} que se encontra edificado à <b>{{$protocolo->endereco}}</b>, n° <b>{{$protocolo->numero}}</b>,
                SETOR <b>{{$protocolo->setor}}</b>, QUADRA <b>{{$protocolo->quadra}}</b>,
                LOTE <b>{{$protocolo->lote}}</b>. Com área construída de
                @if ($tipo_predio != "Misto")
                    {{$protocolo->m2}}m².
                @else
                    {{$metragem_res}}m² Residencial e {{$metragem_com}}m² Comercial
                @endif
            </p>
        </div>
        <div align="center">
            <h4 class="printDate">
                Lins, {{date('d')}} / {{date('m')}} / 20{{date('y')}}<br><br>
                _____________________________
            </h4>
        </div>
        <div align="center">
            <h5 class="printFooter">
                <b>Prefeitura Municipal de Lins</b><br>
                Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
{{--                {{$estagiario}}--}}
                {{Auth::user()->name}}
            </h5>
        </div>
    </div>
    {{--PROVISÓRIO--}}
    <script>
        function printPage() {
            window.print();
        }
    </script>
@endsection
