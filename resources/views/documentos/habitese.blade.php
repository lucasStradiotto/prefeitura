@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <div>
            <form method="post" action="{{route('validateDocument')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="tipo_documento" value="Habite-se"/>
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

                @if(isset($protocolo->data_fim))
                    <input type="hidden" name="data_fim" value="{{$protocolo->data_fim}}"/>
                @endif

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
            <p class="printTextHabitese">
                <b>{{$engenheiro->nome}}</b><br>
                <b>CREA - {{$engenheiro->crea}}</b> - responsável pela Divisão de Projetos, da Prefeitura Municipal de
                Lins, Estado de São Paulo, atendendo ao respeitável despacho proferido pelo Sr. Prefeito Municipal, na
                petição n° <b>{{$protocolo->l}}</b> fornece o presente <b>HABITE-SE</b>,
                a {{$protocolo->proprietario}}, em virtude de após haver sido efetuada competente vistoria, ter constado
                que o prédio {{$tipo_predio}} em {{$tipo_construcao}}, constante de várias dependências, situada
                a <b>{{$protocolo->endereco}}, n° {{$protocolo->numero}}</b>,
                SETOR <b>{{$protocolo->setor}}</b>, QUADRA <b>{{$protocolo->quadra}}</b>, LOTE
                <b>{{$protocolo->lote}}</b>, nesta cidade, se apresenta nesta data, com os requisitos necessários de
                habitabilidade e higiene.
                <br><br>
                Req. O mesmo.
                <br><br><br>
                Projeto aprovado em {{isset($protocolo->data_fim) ? $protocolo->data_fim->format('d/m/Y') : date('d')}} / {{date('m')}} / 20{{date('y')}} com área de:
                <b>
                    @if ($tipo_predio != "Misto")
                        Residência: {{$protocolo->m2}}m².
                    @else
                        {{$metragem_res}}m² Residencial e {{$metragem_com}}m² Comercial
                    @endif
                </b>.
            </p>
        </div>
        <div align="center">
            <h4 class="printDateHabitese">
                Lins, {{date('d')}} / {{date('m')}} / 20{{date('y')}}<br><br>
                _____________________________
                <br>
                Responsável pela Divisão de Projetos.<br><br>
            </h4>
        </div>
        <div align="center">
            <h5 class="printFooterHabitese">
                <b>Esta certidão tem validade de seis (6) meses a partir da data de emissão.</b>
                <br>
                <br>
                <b>Prefeitura Municipal de Lins</b><br>
                Av. Nicolau Zarvos, 754 - Vila Bela Vista - Lins/SP - CEP: 16401-300 - Fone (14)3533-4287<br>
                e-mail: diprolins@gmail.com / dipro.guias@gmail.com / dipro@lins.sp.gov.br<br>
                {{--{{$estagiario}}--}}
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
