@extends('layouts.app')

@section('content')
    <style>
        .margin15{
            margin-top: 15vh;
        }

        .wrapper{
            display: grid;
            grid-template-columns: auto auto auto;
            text-align: justify;
        }

        /* LOADING */
        .opacity{
            opacity:0.2;
            height: 85vh;
            overflow-y: hidden;
        }

        .container-loader{
            left: 45vw;
            top: 45vh;
            position: absolute;
        }

        .points-loader{
            display: inline-flex;
            width: 1vw;
            height: 1vw;
            background-color: #00601d;
            border-radius: 50%;
            margin-left: 1vw;
        }

        .first-point{
            animation:  loading 0.5s infinite ease;
        }
        .second-point{
            animation:  loading 0.5s infinite ease;
            animation-delay: 0.1s;
        }
        .third-point{
            animation:  loading 0.5s infinite ease;
            animation-delay: 0.2s;
        }

        @keyframes loading {
            0% { opacity: 0.3;}
            100% { opacity: 1;}

        }
        /* FIM LOADING */
    </style>
    <title>{{$title}}</title>
    <div id="loading"></div>
    <div id="body">
        <form action="{{route('setPerfilUsuarioWeb')}}" method="POST" class="container">
            {{csrf_field()}}
            <ul class="breadcrumb">
                <li><a href="{{ route('controleAcesso') }}">Controle de acesso</a></li>
                <li class="active">{{ $title }}</li>
            </ul>
            <div>
                Selecione o Usuário:
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6 col-sm-6">
                    <select id="slc-usuarios" name="user_id">
                        <option value="0">Todos os Usuários</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="perfis-header" class="margin15"></div>
            <div id="perfis-container" class="wrapper"></div>
            <div id="perfis-button" class="col-md-12 col-sm-12 margin15"></div>
        </form>
    </div>

    <script>
        let toAppend;
        let $loading = $("#loading");
        let loadingToAppend = '<div class="container-loader">';
        loadingToAppend += '<div class="points-loader first-point"></div>';
        loadingToAppend += '<div class="points-loader second-point"></div>';
        loadingToAppend += '<div class="points-loader third-point"></div>';
        loadingToAppend += '</div>';

        $(document).ready(function(){
            let $slcUsuarios = $("#slc-usuarios");
            $slcUsuarios.select2();
            let $container = $("#perfis-container");
            $slcUsuarios.change(function(){
                if ($(this).val() !== 0)
                {
                    showLoading();
                    let user = $(this).val();
                    $container.empty();
                    //traz todos os perfis cadastrados no banco da web
                    $.getJSON("{{route('getRolesWeb')}}", {}, function(roles){
                        //traz todos os perfis que ja estao atrelados ao usuario selecionado, pra poder
                        //deixar eles marcados ao carregar a pagina
                        $.getJSON("{{route('getRolesUserChecked')}}", {
                            user: user
                        }, function(checked_roles){
                            toAppend = '';
                            $.each(roles, function(index, role){
                                if (checked_roles.includes(role.id))
                                    toAppend = '<div><input type="checkbox" checked value="'+role.id+'" name="roles[]"/><strong>'+role.display_name+'</strong></div>';
                                else
                                    toAppend = '<div><input type="checkbox" value="'+role.id+'" name="roles[]"/><strong>'+role.display_name+'</strong></div>';
                                $container.append(toAppend);
                                dismissLoading();
                            });
                        });
                        toAppend = '<button class="btn btn-success">Salvar</button>';
                        $("#perfis-button").empty().append(toAppend)
                    });
                }
                else
                {
                    alert('Escolha um usuário');
                    $container.empty();
                }
            });
        });

        function showLoading(){
            $loading.append(loadingToAppend);
            $("#body").addClass('opacity');
        }

        function dismissLoading(){
            $loading.empty();
            $("#body").removeClass('opacity');
        }
    </script>
@endsection