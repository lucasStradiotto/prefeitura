@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexEmpresa') }}">Proprietários</a></li>
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
        @if(isset($empresa))
            <form class="container" method="post" action="{{ route('updateEmpresa', $empresa->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeEmpresa') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Razão Social
            </div>
            <div>
                <input name="razao_social" value="{{$empresa->razao_social or old('razao_social')}}">
            </div>
            <div>
                Nome Fantasia
            </div>
            <div>
                <input name="nome_fantasia" value="{{$empresa->nome_fantasia or old('nome_fantasia')}}">
            </div>
            <div>
                CEP
            </div>
            <div>
                <input name="cep" value="{{$empresa->cep or old('cep')}}" maxlength="8" size="8" id="cep">
                <strong id="error" style="color: red;"></strong>
            </div>

            <div>
                CNPJ
            </div>
            <div>
                <input name="cnpj" value="{{$empresa->cnpj or old('cnpj')}}" maxlength="14" id="cnpj">
            </div>
            <div>
                Inscrição Municipal
            </div>
            <div>
                <input name="inscricao_municipal"
                       value="{{$empresa->inscricao_municipal or old('inscricao_municipal')}}">
            </div>
            <div>
                Inscrição Estadual
            </div>
            <div>
                <input name="inscricao_estadual"
                       value="{{$empresa->inscricao_estadual or old('inscricao_estadual')}}">
            </div>
            <div>
                Estado
            </div>
            <div>
                <input name="estado" value="{{$empresa->estado or old('estado')}}" id="estado" readonly>
            </div>
            <div>
                Cidade
            </div>
            <div>
                <input name="cidade" value="{{$empresa->cidade or old('cidade')}}" id="cidade" readonly>
            </div>
            <div>
                Logradouro
            </div>
            <div>
                <input name="logradouro" value="{{$empresa->logradouro or old('logradouro')}}" id="logradouro" readonly>
            </div>
            <div>
                N°
            </div>
            <div>
                <input name="numero" value="{{$empresa->numero or old('numero')}}" size="5">
            </div>
            <div>
                Bairro
            </div>
            <div>
                <input name="bairro" value="{{$empresa->bairro or old('bairro')}}" id="bairro" readonly>
            </div>
            <div>
                Responsável
            </div>
            <div>
                <input name="responsavel" value="{{$empresa->responsavel or old('responsavel')}}">
            </div>
            <div>
                Telefone
            </div>
            <div>
                <input name="telefone" value="{{$empresa->telefone or old('telefone')}}" id="telefone"
                       type="tel" maxlength="20" size="20">
            </div>
            <button class="btn btn-success" id="btnEnviar">Enviar</button>
            </form>
    </div>

    {{--Scripts de Mascara (CDN)--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            // Máscara do CNPJ
            $('#cnpj').mask('00.000.000/0000-00', {reverse: true});

            // Máscara do CEP
            $('#cep').mask('00000-000');

            // Máscara do Telefone
            var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };

            $('#telefone').mask(SPMaskBehavior, spOptions);

            // Sistema de pesquisar o CEP
            $('#cep').change(function(){
                $.ajax({
                    url:'http://cep.republicavirtual.com.br/web_cep.php',
                    type:'get',
                    dataType:'json',
                    crossDomain: true,
                    data:{
                        cep: $('#cep').val(), //pega valor do campo
                        formato:'json'
                    },
                    success: function(res){
                        //CEP COMPLETO
                        if (res.resultado == 1)
                        {
                            $('#error').empty();
                            $('#estado').val(res.uf);
                            $('#estado').attr("readonly",true);
                            $('#cidade').val(res.cidade);
                            $('#cidade').attr("readonly",true);
                            $('#logradouro').val(res.tipo_logradouro + " " + res.logradouro);
                            $('#logradouro').attr("readonly",true);
                            $('#bairro').val(res.bairro);
                            $('#bairro').attr("readonly",true);
                        }
                        // CEP INVALIDO
                        else if (res.resultado == 0)
                        {
                            $('#error').empty();
                            $('#error').append('CEP inválido!');

                            $('#logradouro').val("");
                            $('#logradouro').attr("readonly",true);
                            $('#bairro').val("");
                            $('#bairro').attr("readonly",true);
                            $('#estado').val("");
                            $('#estado').attr("readonly",true);
                            $('#cidade').val("");
                            $('#cidade').attr("readonly",true);
                        }
                        // CEP APENAS CIDADE
                        else if (res.resultado == 2)
                        {
                            $('#error').empty();

                            $('#estado').val(res.uf);
                            $('#estado').attr("readonly",true);
                            $('#cidade').val(res.cidade);
                            $('#cidade').attr("readonly",true);

                            $('#logradouro').val("");
                            $('#logradouro').attr("readonly", false);
                            $('#bairro').val("");
                            $('#bairro').attr("readonly", false);
                        }
                    }
                });
            });

            $('#btnEnviar').click(function(){
                $('#cnpj').val($('#cnpj').cleanVal());
                $('#cep').val($('#cep').cleanVal());
                $('#telefone').val($('#telefone').cleanVal());
            });
        });
    </script>
@endsection