@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">
                        <p>
                            <a class="btn btn-success" href="{{route('perfil.index')}}">Perfis</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('permissao.index')}}">Permissões</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('usuarios.create')}}">Usuários</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('usuarios.perfis')}}">Usuários / Perfis</a>
                        </p>
                        <h1>App Cidade Fácil</h1>
                        <p>
                            <a class="btn btn-success" href="{{route('indexIconesCidadeFacil')}}">Ícones App Cidade Fácil</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexItemCidadeFacil')}}">Itens App Cidade Fácil</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexIconeItemCidadeFacil')}}">Ícones / Item</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexRoleIcons')}}">Perfis / Icones</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPerfilItemCidadeFacil')}}">Perfis / Item</a>
                        </p>

                        <h1>Web Cidade Fácil</h1>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPerfilItemWeb')}}">Perfis / Itens</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection