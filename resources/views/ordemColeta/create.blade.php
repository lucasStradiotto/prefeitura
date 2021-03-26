@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexOrdemColeta') }}">Ordens de Coleta</a></li>
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
        @if(isset($ordemColeta))
            <form class="container" method="post" action="{{ route('updateOrdemColeta', $ordemColeta->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeOrdemColeta') }}">
                @endif
                {!! csrf_field() !!}
                <div>
                    Empresa
                </div>
                <div>
                    <input readonly value="{{isset(\Illuminate\Support\Facades\Auth::user()->empresa) ? \Illuminate\Support\Facades\Auth::user()->empresa->nome_fantasia : ''}}">
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                </div>
                <div>
                    Numero do CTR
                </div>
                <div>
                    <input name="numero_ctr" value="{{$ordemColeta->numero_ctr or old('numero_ctr')}}" required />
                </div>
                <div>
                    Veículo
                </div>
                <div>
                    <select name="veiculo_id" class="col-md-5">
                        <option value="0">Selecione um Veículo</option>
                        @foreach ($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}"
                                    @if (isset($ordemColeta) && $veiculo->id == $ordemColeta->veiculo_id)
                                    selected
                                    @endif>{{ $veiculo->placa}}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>
                    Material Predominante
                </div>
                <div>
                    <select name="material_predominante_id" class="col-md-5">
                        <option value="0">Selecione um Tipo de Material</option>
                        @foreach ($tipoEntulho as $tipo)
                            <option value="{{ $tipo->id }}"
                            @if (isset($ordemColeta) && $tipo->id == $ordemColeta->material_predominante_id)
                            selected
                            @endif>{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('createTipoEntulho') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>
                    Nome do Solicitante
                </div>
                <div>
                    <input name="nome_solicitante"
                           value="{{$ordemColeta->nome_solicitante or old('nome_solicitante')}}" required />
                </div>
                <div>
                    Bairro da Cobrança
                </div>
                <div>
                    <select name="bairro_cobranca_id" id="bairro_cobranca" class="col-md-5">
                        <option value="0">Selecione o Bairro</option>
                        @foreach($bairros as $bairro)
                            <option value="{{$bairro->id}}"
                            @if (isset($ordemColeta) && $bairro->id == $ordemColeta->bairro_cobranca_id)
                            selected
                            @endif>{{$bairro->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    Endereço da Cobrança
                </div>
                <div>
                    <select name="endereco_cobranca_id" id="endereco_cobranca"  class="col-md-5">
                        <option value="0">Selecione a Rua</option>
                    </select>
                </div>
                <div>
                    Número da Casa
                </div>
                <div>
                    <select name="numero_casa_cobranca_id" id="numero_cobranca"  class="col-md-5">
                        <option value="">Selecione o Número</option>
                    </select>
                </div>
                <div>
                    Fone
                </div>
                <div>
                    <input name="telefone" value="{{$ordemColeta->telefone or old('telefone')}}" type="text" required />
                </div>
                <div>
                    CPF
                </div>
                <div>
                    <input name="cpf" value="{{$ordemColeta->cpf or old('cpf')}}" type="text" />
                </div>
                <div>
                    CNPJ
                </div>
                <div>
                    <input name="cnpj" value="{{$ordemColeta->cnpj or old('cnpj')}}" type="text" />
                </div>
                <div>
                    I.E.
                </div>
                <div>
                    <input name="inscricao_estadual" value="{{$ordemColeta->inscricao_estadual or old('inscricao_estadual')}}" type="text" />
                </div>
                <div>
                    R.G.
                </div>
                <div>
                    <input name="rg" value="{{$ordemColeta->rg or old('rg')}}" type="text" />
                </div>
                <div>
                    Bairro da Obra
                </div>
                <div>
                    <select name="bairro_obra_id" id="bairro_obra"  class="col-md-5">
                        <option value="0">Selecione o Bairro</option>
                        @foreach($bairros as $bairro)
                            <option value="{{$bairro->id}}"
                            @if (isset($ordemColeta) && $bairro->id == $ordemColeta->bairro_obra_id)
                            selected
                            @endif>{{$bairro->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    Endereço da Obra
                </div>
                <div>
                    <select name="endereco_obra_id" id="endereco_obra" class="col-md-5">
                        <option value="0">Selecione a Rua</option>
                    </select>
                </div>
                <div>
                    Número da Obra
                </div>
                <div>
                    <select name="numero_obra" id="numero_obra"  class="col-md-5">
                        <option value="">Selecione o Número</option>
                    </select>
                </div>
                <div>
                    Valor
                </div>
                <div>
                    <input name="valor" value="{{$ordemColeta->valor or old('valor')}}" type="text" required />
                </div>

                <button class="btn btn-success" id="btnEnviar">Enviar</button>
            </form>
    </div>
    <script>
        $(document).ready(function () {
            $("select").select2();



            $(document).on('change', '#bairro_cobranca, #bairro_obra', function (e) {
                e.preventDefault();

                if ($(this).val() !== '0') {

                    nomeSelectAlvo = '#endereco_' + this.id.split('_')[1];
                    $selectAlvo = $(nomeSelectAlvo);

                    $selectAlvo.empty();
                    $selectAlvo.append($('<option>', { value: '0' }).text('Selecione a Rua'));

                    $.getJSON("{{ route('getRuas') }}", {
                        bairro_id: $(this).val()
                    }, function (data, textStatus, jqXHR) {

                        $.each(data, function (indice, rua) {
                            if(nomeSelectAlvo == "#endereco_cobranca")
                            {
                                if ("{{isset($ordemColeta) ? $ordemColeta->endereco_cobranca_id : 0}}" == rua.id)
                                    $selectAlvo.append($('<option>', {value: rua.id, selected:true}).text(rua.nome));
                                else
                                    $selectAlvo.append($('<option>', {value: rua.id}).text(rua.nome));
                            }
                            else if(nomeSelectAlvo == "#endereco_obra")
                            {
                                if ("{{isset($ordemColeta) ? $ordemColeta->endereco_obra_id : 0}}" == rua.id)
                                    $selectAlvo.append($('<option>', {value: rua.id, selected: true}).text(rua.nome));
                                else
                                    $selectAlvo.append($('<option>', {value: rua.id}).text(rua.nome));
                            }
                        })

                    });
                }
            });

            $(document).on('change', '#endereco_cobranca, #endereco_obra', function (e) {
                e.preventDefault();

                if ($(this).val() !== '0') {
                    nomeSelectAlvo = '#numero_' + this.id.split('_')[1];
                    $selectAlvo = $(nomeSelectAlvo);
                    nomeBairro = '#bairro_' + this.id.split('_')[1];
                    $elementoBairro = $(nomeBairro);

                    $selectAlvo.empty();

                    $selectAlvo.append($('<option>', { value: '0' }).text('Selecione o Número'));

                    $.getJSON("{{ route('getNumeros') }}", {
                        bairro_id: $elementoBairro.val(),
                        rua_id: $(this).val()
                    }, function (data, textStatus, jqXHR) {
                        $.each(data, function (indice, numero) {
                            if(nomeSelectAlvo == "#numero_cobranca")
                            {
                                if ("{{isset($ordemColeta) ? $ordemColeta->numero_casa_cobranca_id : 0}}" == numero.numero)
                                    $selectAlvo.append($('<option>', {
                                        value: numero.numero,
                                        selected: true
                                    }).text(numero.numero));
                                else
                                    $selectAlvo.append($('<option>', {value: numero.numero}).text(numero.numero));
                            }
                            else if(nomeSelectAlvo == "#numero_obra")
                            {
                                if ("{{isset($ordemColeta) ? $ordemColeta->numero_casa_cobranca_id : 0}}" == numero.numero)
                                    $selectAlvo.append($('<option>', {
                                        value: numero.numero,
                                        selected: true
                                    }).text(numero.numero));
                                else
                                    $selectAlvo.append($('<option>', {value: numero.numero}).text(numero.numero));
                            }
                        })
                    });
                }
            });

            async function carregar() {
                $("#bairro_cobranca").trigger("change");
                await sleep(1000);
                $("#bairro_obra").trigger("change");
                await sleep(1000);
                $("#endereco_cobranca").trigger("change");
                await sleep(1000);
                $("#endereco_obra").trigger("change");
            }
            carregar();
            /*$('form').validate({
                rules: {
                    bairro_cobranca_id: {min: 1}
                }
            });*/
        });

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    </script>
@endsection