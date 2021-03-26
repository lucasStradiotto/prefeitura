@extends('layouts.app')

@section('content')
    <style>
        .secretaria_label{
            margin-left: 25vw;
        }

        .secretaria_content{
            margin-left: 10vw;
        }

        .each-secretaria{
            float: left;
            padding-left: 5vw;
        }

        .checkbox-secretaria{
            margin-left: 3vw;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    @if(isset($errors) && count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('usuarios.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirme a Senha</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Perfil</label>

                                <div class="col-md-6">
                                    <select name="perfis" id="perfis" class="form-control">
                                        <option value="">Selecione o Perfil</option>
                                        @foreach ($perfis as $perfil)
                                            <option value="{{ $perfil->id }}">{{ $perfil->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('perfil.create') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="empresa_id" class="col-md-4 control-label">Empresa</label>

                                <div class="col-md-6">
                                    <select name="empresa_id" id="empresa_id" class="form-control">
                                        <option value="">Selecione a Empresa</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nome_fantasia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('createEmpresa') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="secretaria_label">
                                    Secretarias
                                </label>

                                <div class="secretaria_content">
                                    @foreach($secretarias as $secretaria)
                                        <div class="each-secretaria">
                                            <label for="secretaria_{{$secretaria->id}}">
                                                {{$secretaria->nome}}
                                            </label>

                                            <div class="checkbox-secretaria">
                                                <input value="{{$secretaria->id}}" name="secretaria[]" type="checkbox"/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="receber_notificacao" class="col-md-4 control-label">
                                    Enviar notificações para este usuário?
                                </label>

                                <div class="col-md-6">
                                    <input type="checkbox" name="receber_notificacao" id="receber_notificacao" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Criar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#empresa_id").select2();
            $("#perfis").select2();
        });
    </script>
@endsection