@extends('layouts.app')

@section('content')
    <style>
        .floating-tip {
            margin-left: 8px;
            position: relative;
            transition: 1s;
        }
        .floating-tip:hover{
            color: #ee3136;
        }

        .floating-tip p {
            border-radius: 9px;%;
            display: none;
            position: absolute;
            bottom: 8px;
            /*background-color: white;*/
            background: rgba(255, 255, 255, 0.5);
            /*border: 2px solid black;*/
            width: 250px;
            padding: 15px;
            text-align: justify;
        }

        .floating-tip:hover p {
            display: block;
            color: #777;
        }
    </style>

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexVeiculo') }}">Veículos</a></li>
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
        @if(isset($veiculo))
            <form class="container" method="post" id="form-veiculo" enctype="multipart/form-data"  action="{{ route('updateVeiculo', $veiculo->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" id="form-veiculo" enctype="multipart/form-data"  action="{{ route('storeVeiculo') }}">
        @endif
        {!! csrf_field() !!}
        <div>
            Tipo de Veículo
        </div>
        <div>
            <select name="id_tipo_veiculo" name='id_tipo_veiculo'>
                <option value="">Selecione o Tipo do Veículo</option>
                @foreach($tipos as $tipo)
                    <option value="{{$tipo->id}}" 
                        {{old('id_tipo_veiculo') == $tipo->id ? 'selected' : ''}}
                        @if (isset($veiculo) && $tipo->id == $veiculo->id_tipo_veiculo)
                            selected
                        @endif
                    >{{$tipo->nome}}</option>
                @endforeach
            </select>
            <a href="{{ route('createTipoVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div>
            Secretaria
        </div>
        <div>
            <select name="secretaria_id">
                <option value="0">Selecione a Secretaría</option>
                @foreach($secretarias as $secretaria)
                    <option value="{{$secretaria->id}}"
                        {{old('secretaria_id') == $secretaria->id ? 'selected' : ''}}
                        @if (isset($veiculo) && $secretaria->id == $veiculo->secretaria_id)
                            selected
                        @endif
                    >{{$secretaria->nome}}</option>
                @endforeach
            </select>
            <a href="{{ route('createSecretaria') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div>
            Sub Setor
        </div>
        <div>
            <select name="despesa_sub_setor_id">
                <option value="0">Selecione o Subsetor</option>
                @foreach($subSetores as $subSetor)
                    <option value="{{$subSetor->id}}"
                        {{old('despesa_sub_setor_id') == $subSetor->id ? 'selected' : ''}}
                        @if (isset($veiculo) && $subSetor->id == $veiculo->despesa_sub_setor_id)
                            selected
                        @endif
                    >{{$subSetor->nome}}</option>
                @endforeach
            </select>
            <a href="{{ route('createDespesaSubSetores') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div>
            Modelo
        </div>
        <div>
            <input name="modelo" value="{{$veiculo->modelo or old('modelo')}}" id="modelo">
        </div>
        <div>
            Ano
        </div>
        <div>
            <input name="ano" value="{{$veiculo->ano or old('ano')}}" id="ano">
        </div>
        <div>
            Cor
        </div>
        <div>
            <input name="cor" value="{{$veiculo->cor or old('cor')}}" id="cor">
        </div>
        <div>
            Fabricante
        </div>
        <div>
            <input name="fabricante" value="{{$veiculo->fabricante or old('fabricante')}}" id="fabricante">
        </div>
        <div>
            Placa
        </div>
        <div>
            <input name="placa" value="{{$veiculo->placa or old('placa')}}" id="placa" style="text-transform: uppercase">
        </div>
        <div>
            RENAVAM
        </div>
        <div>
            <input name="renavam" value="{{$veiculo->placa or old('renavam')}}" id="renavam" style="text-transform: uppercase">
        </div>
        <div>
            Prefixo
        </div>

        <div>
            <input name="prefixo" value="{{$veiculo->prefixo or old('prefixo')}}" id="prefixo">
        </div>
        <div>
            Número de Série do Rastreador
        </div>
        <div>
            <input name="n_serie_rastreador" maxlength="10" value="{{$veiculo->n_serie_rastreador or old('n_serie_rastreador')}}">
        </div>
        <div>
            Codigo do cartão do veiculo
        </div>
        <div>
            <input name="codigo_barra" value="{{$veiculo->codigo_barra or old('codigo_barra')}}" id="codigo_barra">
        </div>
        <div>
            Tipo de Combustível
        </div>
        <div>
            <select style="width:30%;" name="tipoCombustivel_id[]" id="tipoCombustivel_id" multiple="multiple">
                @foreach($tipoCombustivel as $tipo)
                    <option value="{{$tipo->id}}"
                @if (isset($veiculo))
                    {{(collect($alocacoes)->contains($tipo->id)) ? 'selected':''}}
                @else
                    {{ (collect(old('tipoCombustivel_id'))->contains($tipo->id)) ? 'selected':'' }}
                @endif
                    >
                        {{$tipo->descricao}}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            Proprietário
        </div>
        <div>
            <select name="empresa_id">
                <option value="">Selecione o Proprietário</option>
                @foreach($empresas as $empresa)
                    <option value="{{$empresa->id}}"
                        {{old('empresa_id') == $empresa->id ? 'selected' : ''}}
                        @if (isset($veiculo) && $empresa->id == $veiculo->empresa_id)
                            selected
                        @endif
                    >{{$empresa->nome_fantasia}}</option>
                @endforeach
            </select>
            <a href="{{ route('createEmpresa') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div>
            Horário Programado Específico
        </div>
        <div>
            <select name="horario_programado_id">
                <option value="0">Selecione o Horário Programado</option>
                @foreach($horariosProgramados as $horario)
                    <option value="{{$horario->id}}"
                        {{old('horario_programado_id') == $horario->id ? 'selected' : ''}}
                        @if (isset($veiculo) && $horario->id == $veiculo->horario_programado_id)
                            selected
                        @endif
                    >{{$horario->inicio}} - {{$horario->fim}}</option>
                @endforeach
            </select>
            <span class="glyphicon glyphicon-question-sign floating-tip">
                <p>Selecione um Horário caso este Veículo possua uma jornada diferente de sua Secretaria.</p>
            </span>
            <a href="{{ route('createHorarioProgramado') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div>
            Vencimento DPVAT
        </div>
        <div>
            <input class="campoData" name="vencimentoDPVAT" id="vencimentoDPVAT">
        </div>
        <div>
            Vencimento Licenciamento
        </div>
        <div>
            <input class="campoData" name="vencimentoLicenciamento" id="vencimentoLicenciamento">
        </div>
        <div>
            Selecione uma foto do veículo
        </div>
        <div>
            <input type="file" name="imagem" value="" accept=".jpg, .JPG, .png, .PNG">
        </div>

        <div>
            Selecione uma foto da placa do veículo
        </div>
        <div>
            <input type="file" name="imagem_placa" value="" accept=".jpg, .JPG, .png, .PNG">
        </div>
        <button class="btn btn-success" id="btnEnviar">Enviar</button>

        </form>
    </div>

    {{--Scripts de Mascara (CDN)--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script>
        $(".campoData").mask("99/99/9999");
        $(document).ready(function(){
            $('select').select2();
            // Máscara da Placa
            $('#placa').mask('AAA-AAAA');

            $('#btnEnviar').click(function(){
                $('#placa').val($('#placa').cleanVal());
            });

            //Verificar se o código do cartão já existe no banco
            $("#codigo_barra").blur(function(){
                $.getJSON("{{route('checkBarcode')}}", {
                    barcode: $("#codigo_barra").val(),
                    veiculo_id: {!!$veiculo->id or 0!!}
                }, function(data){
                    if (data.length > 0)
                    {
                        swal({
                            type: 'error',
                            title: 'Já existe um veículo cadastrado com este código na base de dados!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                });
            });

            $("#btnEnviar").click(function(e){
                e.preventDefault();

                $.getJSON("{{route('checkBarcode')}}", {
                    barcode: $("#codigo_barra").val()
                }, function(data){
                    if (data.length > 0)
                    {
                        swal({
                            type: 'error',
                            title: 'Já existe um veículo cadastrado com este código na base de dados!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                    else
                        $("#form-veiculo").submit();
                });
            });
        });
    </script>
@endsection