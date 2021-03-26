@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <div>
            <form method="post" action="{{route('validateDocument')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="tipo_documento" value="Certidão de Construção"/>
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
                    <input type="hidden" name="comodos" value="{{$comodos}}"/>
                @else
                    <input type="hidden" name="metragem_com" value="{{$metragem_com}}"/>
                    <input type="hidden" name="metragem_res" value="{{$metragem_res}}"/>
                    <input type="hidden" name="comodos_com" value="{{$comodos_com}}"/>
                    <input type="hidden" name="comodos_res" value="{{$comodos_res}}"/>
                @endif

                <input type="hidden" name="numero_matricula" value="{{$matricula}}"/>
                <input type="hidden" name="tipo_construcao" value="{{$tipo_construcao}}"/>

                @if(isset($protocolo->data_fim))
                    <input type="hidden" name="data_fim" value="{{$protocolo->data_fim}}"/>
                @endif
                @if(isset($protocolo->data_inicio))
                    <input type="hidden" name="data_inicio" value="{{$protocolo->data_inicio}}"/>
                @endif

                <input type="hidden" name="pagina" value="{{$protocolo->pagina}}"/>
                <input type="hidden" name="livro" value="{{$protocolo->livro}}"/>


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
            <b>{{$engenheiro->nome}}</b><hr style="border: solid 1px black;">
            <p class="printTextCerCon">
                <b>CREA - {{$engenheiro->crea}}</b> - Responsável pela Divisão de Projetos, da Prefeitura Municipal de
                Lins, Estado de São Paulo, <b>CERTIFICA</b>, em virtude do referido despacho do Sr. Prefeito Municipal
                ao qual
                lhe foi requerido em Petição <b>n.º {{$protocolo->l}}</b>
                para os fins de direito, que se encontra edificado à <b>{{$protocolo->endereco}}</b>,
                <b>n°{{$protocolo->numero}}</b>,
                SETOR <b>{{$protocolo->setor}}</b>, QUADRA <b>{{$protocolo->quadra}}</b>,
                LOTE <b>{{$protocolo->lote}}</b>. Conforme matrícula de n° {{$matricula}}, com área construída de
                @if ($tipo_predio != "Misto")
                    <b>{{$protocolo->m2}}m²</b>,
                @else
                    <b>{{$metragem_com + $metragem_res}}m²</b>
                @endif
                de um prédio {{$tipo_predio}} em {{$tipo_construcao}}, com cobertura de telhas de {{$tipo_cobertura}}, contendo as seguintes
                dependências:
                <br><br>
                @if ($tipo_predio != "Misto")
                    {{$tipo_predio}}: {{$comodos}}.
                @else
                    Residencial: {{$comodos_res}}
                    <br>
                    Comercial: {{$comodos_com}}
                @endif
                <br><br>
                Protocolado sob <b>nº {{$protocolo->protF}}</b> às folhas <b>{{$protocolo->pagina}}</b> do Livro n°
                <b>{{$protocolo->livro}}</b>
                de <b> {{isset($protocolo->data_inicio) ? $protocolo->data_inicio->format('d/m/Y') : ''}} </b> de propriedade do(a) Sr.(a)
                <b>{{$protocolo->proprietario}}</b>,
                conforme consta em projeto aprovado de nosso arquivo. O referido é verdade e dá fé. Lins
                , {{date('d')}} / {{date('m')}} / 20{{date('y')}}, _____________________________ responsável pela Divisão de Projetos.
                <br>
                Req. O mesmo.
            </p>
        </div>

        <div align="center">
            <h4 class="printDateCerCon">
                {{--Lins, {{date('d')}} / {{date('m')}} / 20{{date('y')}}<br><br>--}}
                {{--_____________________________, responsável pela Divisão de Projetos.<br><br>--}}
                {{--Req. O mesmo.<br><br>--}}
                Projeto vistado em {{isset($protocolo->data_fim) ? $protocolo->data_fim->format('d/m/Y') : '__/__/____'}} com área de:
                @if ($tipo_predio != "Misto")
                    {{$protocolo->m2}}m²
                @else
                    {{$metragem_com + $metragem_res}}m²
                @endif
                <br>
                {{$obs}}
                {{--<b>Residência: {{$protocolo->m2}}m².</b>--}}
            </h4>
        </div>
        <div align="center">
            <h5 class="printFooter">
                <b>Esta certidão tem validade de seis (6) meses a partir da data de emissão.</b>
                <br>
                <br>
                <b>Prefeitura Municipal de Lins</b><br>
                Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                {{\Illuminate\Support\Facades\Auth::user()->name}}
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
