@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexMotorista') }}">Motoristas</a></li>
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
        @if(isset($motorista))
            <form class="container" method="post" action="{{ route('updateMotorista', $motorista->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeMotorista') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$motorista->nome or old('nome')}}">
                        </div>
                        <div>
                            CPF
                        </div>
                        <div>
                            <input name="cpf" value="{{$motorista->cpf or old('cpf')}}" id="cpf" size="14">
                        </div>
                        <div>
                            RG
                        </div>
                        <div>
                            <input name="rg" value="{{$motorista->rg or old('rg')}}" size="14">
                        </div>
                        <div>
                            Número CNH
                        </div>
                        <div>
                            <input name="cnh_numero" value="{{$motorista->cnh_numero or old('cnh_numero')}}" size="14" maxlength="11">
                        </div>
                        <div>
                            Categoria CNH
                        </div>
                        <div>
                            <select name="cnh_categoria">
                                <option value="">Selecione</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div>
                            Validade CNH
                        </div>
                        <div>
                            <input type="date" name="cnh_validade">
                        </div>
                        <div>
                            Empresa
                        </div>
                        <div>
                            <select name="empresa_id">
                                @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}"
                                            @if (isset($motorista) && $empresa->id == $motorista->empresa_id)
                                            selected
                                            @endif
                                    >{{$empresa->nome_fantasia}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createEmpresa') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Secretaria
                        </div>
                        <div>
                            <select name="secretaria_id">
                                <option value="">Selecione a Secretaría</option>
                                @foreach($secretarias as $secretaria)
                                    <option value="{{$secretaria->id}}"
                                            @if (isset($motorista) && $secretaria->id == $motorista->secretaria_id)
                                                selected
                                            @endif
                                    >{{$secretaria->nome}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createSecretaria') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Jornada de Trabalho
                        </div>
                        <div>
                            <select name="jornada_trabalho_id">
                                <option value="">Selecione a Jornada de Trabalho</option>
                                @foreach($jornadasTrabalho as $jornada)
                                    <option value="{{$jornada->id}}"
                                            @if (isset($motorista) && $jornada->id == $motorista->jornada_trabalho_id)
                                                selected
                                            @endif
                                    >{{$jornada->inicio}}-{{$jornada->fim}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createJornadaTrabalho') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <button class="btn btn-success" id="btnEnviar">Enviar</button>

                    </form>
    </div>

    {{--Scripts de Mascara (CDN)--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            // Máscara do CPF
            $('#cpf').mask('000-000-000-00');

            $('#btnEnviar').click(function(){
                $('#cpf').val($('#cpf').cleanVal());
            });
        });
    </script>
@endsection