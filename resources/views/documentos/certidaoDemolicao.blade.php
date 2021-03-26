@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <div>
            <form method="post" action="{{route('validateDocument')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="tipo_documento" value="Certidão de Demolição"/>
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
                <input type="hidden" name="data_emissao" value="{{\Carbon\Carbon::now()}}"/>

                <input type="hidden" name="tipo_construcao" value="{{$tipo_construcao}}"/>

                <button class="btn btn-primary noPrintBtn">Validar Documento</button>
            </form>
        </div>
        <button class="btn btn-primary col-md-offset-10 noPrintBtn" onclick="printPage()">Imprimir</button>
        <div align="center">
            <img src="{{ URL::asset('img/logo_lins.png') }}" class="printImg">
        </div>
        <div align="center" class="printNomeDoc">
            <h4>
                <b>{{$title}} N.° {{$numDoc}}/{{date('Y')}}</b>
            </h4>
        </div>
        <div align="justify">
            <p class="printText">
                <b>{{$engenheiro->nome}}</b><br>
                <b>CREA - {{$engenheiro->crea}}</b> - Responsável pela Divisão de Projetos, da Prefeitura Municipal de
                Lins, Estado de São Paulo, <b>CERTIFICA</b>, em virtude do despacho do Sr. Prefeito Municipal ao qual
                lhe foi requerido para os fins de direito, que no imóvel situado à
                <b>{{$protocolo->endereco}}</b>, <b>n°{{$protocolo->numero}}</b>,
                SETOR <b>{{$protocolo->setor}}</b>, QUADRA <b>{{$protocolo->quadra}}</b>,
                LOTE <b>{{$protocolo->lote}}</b>, de propriedade de <b>{{$protocolo->proprietario}}</b>, foi demolido uma
                construção em {{$tipo_construcao}} de um prédio {{ $tipo_predio }}, com <b>{{$protocolo->m2}}m² demolidos</b>. O referido é verdade e da fé.
            </p>
        </div>
        <div align="center">
            <h4 class="printDate">
                Lins, {{date('d')}} / {{date('m')}} / 20{{date('y')}}<br><br>
                _____________________________, responsável pela Divisão de Projetos.<br><br>
                Req. O mesmo.
            </h4>
        </div>
        <div align="center">
            <h5 class="printFooter">
                <b>Prefeitura Municipal de Lins</b><br>
                Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                {{--{{$estagiario}}--}}
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
