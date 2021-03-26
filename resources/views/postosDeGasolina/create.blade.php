@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexPosto') }}">Postos De Gasolina</a></li>
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
        @if(isset($posto))
            <form class="container" method="post"
                  action="{{ route('updatePosto', $posto->id) }}">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                @else
                    <form class="container" method="post" action="{{ route('storePosto') }}">
                        {!! csrf_field() !!}
                        @endif
                        <div>
                            nome
                        </div>
                        <div>
                            <input name="nome" value="{{$posto->nome or old('nome')}}" id="nome">
                        </div><div>
                            Endereço
                        </div>
                        <div>
                            <input name="endereco" value="{{$posto->endereco or old('endereco')}}" id="endereco">
                        </div>
                        <div>
                            Nome fantasia
                        </div>
                        <div>
                            <input name="nome_fantasia" value="{{$posto->nome_fantasia or old('nome_fantasia')}}"
                                   id="nome_fantasia">
                        </div>
                        <div>
                            cep
                        </div>
                        <div>
                            <input name="cep" value="{{$posto->cep or old('cep')}}" id="cep">
                        </div>
                        <div>
                            numero
                        </div>
                        <div>
                            <input name="numero" value="{{$posto->numero or old('numero')}}"
                                   id="numero">
                        </div>
                        <div>
                            cidade
                        </div>
                        <div>
                            <input name="cidade" value="{{$posto->cidade or old('cidade')}}" id="cidade">
                        </div>
                        <div>
                            bairro
                        </div>

                        <div>
                            <input name="bairro" value="{{$posto->bairro or old('bairro')}}" id="bairro">
                        </div>
                        <div>
                            completemento
                        </div>

                        <div>
                            <input name="completemento" value="{{$posto->completemento or old('completemento')}}"
                                   id="completemento">
                        </div>
                        <div>
                            cnpj
                        </div>

                        <div>
                            <input name="cnpj" value="{{$posto->cnpj or old('cnpj')}}" id="cnpj">
                        </div>
                        <div>
                            inscricao_estadual
                        </div>
                        <div>
                            <input name="inscricao_estadual"
                                   value="{{$posto->inscricao_estadual or old('inscricao_estadual')}}"
                                   id="inscricao_estadual">
                        </div>
                        <div>
                            inscricao Municipal
                        </div>
                        <div>
                            <input name="inscricao_municipal"
                                   value="{{$posto->inscricao_municipal or old('inscricao_municipal')}}"
                                   id="inscricao_municipal">
                        </div>
                        <div>
                            telefone
                        </div>
                        <div>
                            <input name="telefone" value="{{$posto->telefone or old('telefone')}}" id="telefone">
                        </div>
                        <div>
                            telefone_dois
                        </div>
                        <div>
                            <input name="telefone_dois" value="{{$posto->telefone_dois or old('telefone_dois')}}"
                                   id="telefone_dois">
                        </div>
                        <div>
                            contato
                        </div>
                        <div>
                            <input name="contato" value="{{$posto->contato or old('contato')}}" id="contato">
                        </div>
                        <div>
                            email
                        </div>
                        <div>
                            <input name="email" value="{{$posto->email or old('email')}}" id="email">
                        </div>
                        <div>
                            caixa_postal
                        </div>

                        <div>
                            <input name="caixa_postal" value="{{$posto->caixa_postal or old('caixa_postal')}}"
                                   id="caixa_postal">
                        </div>

                        <br>

                        <div>
                            Selecione os combustíveis:
                        </div>

                        <div>
                            @foreach ($tiposCombustivel as $tipoCombustivel)
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <input type="checkbox" class="tipoCombustivel" name="tipo_combustivel[]" value="{{$tipoCombustivel->id}}" style="margin-right: 1%;" {{isset($tipoCombustivel->tipo_combustivel_id) ? "checked" : ""}}>  
                                    <label for=".tipoCombustivel">{{$tipoCombustivel->descricao}}</label>
                                </div>
                                <div class="col-md-1 text-left">
                                    <input type="text" class="vlUn" name="valor_unitario[]" placeholder="R$" size="10" style="margin: 1px;" pattern="[0-9]{2},[0-9]{2}">
                                </div>
                            </div>    
                            @endforeach
                        </div>

                        <button class="btn btn-success" id="btnEnviar">Enviar</button>

                    </form>
    </div>
    {{--Scripts de Mascara (CDN)--}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> --}}
    <script>
        $(document).ready(function () {
            $(document).on('blur','vlUn', function(){
                var campo = $(this).val();
                var path = '/[\d]/g';
                var result = campo.Math(path);
                if(result > 1){
                    alert();
                }
            });    
            // Máscara da Placa
            /*$('#placa').mask('AAA-0000');

            $('#btnEnviar').click(function () {
                $('#placa').val($('#placa').cleanVal());
            });*/
        });
    </script>
@endsection