@extends('layouts.app')

@section('content')
<style>
    .margin5{
        margin-top: 5vh;
    }

    .margin15{
        margin-top: 15vh;
    }

    .bordered{
        border-radius: 10px;
        border: solid 1px black;
        margin: 5px;
    }

    .wrapper{
        display: grid;
        grid-template-columns: auto auto auto;
        text-align: center;
    }

    /* ICON HIDE/SHOW ANIMIATION */
    .hidden-itens{
        opacity:0;
        transform: scale(0);
        height: 0;
        transition: all 0.2s linear;
    }

    .shown-itens{
        opacity:1;
        transform: scale(1);
        transition: all 0.2s linear;
    }
    /* FIM ICON HIDE/SHOW ANIMIATION */

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
        <form action="{{route('setPerfilItemWeb')}}" method="POST" class="container">
            {{csrf_field()}}
            <ul class="breadcrumb">
                <li class="active">{{ $title }}</li>
            </ul>
            <div>
                Selecione o Perfil:
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6 col-sm-6">
                    <select id="slc-perfis" name="role_id">
                        <option value="0">Todos os Perfis</option>
                        @foreach($perfis as $perfil)
                            <option value="{{$perfil->id}}">{{$perfil->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="itens-header" class="margin15"></div>
            <div id="itens-container" class="wrapper"></div>
            <div id="itens-button" class="col-md-12 col-sm-12 margin15"></div>
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
            let $slcPerfis = $("#slc-perfis");
            $slcPerfis.select2();
            let $container = $("#itens-container");
            $slcPerfis.change(function(){
                if ($(this).val() !== 0)
                {
                    showLoading();
                    let role = $(this).val();
                    $container.empty();
                    //traz todos os icones cadastrados no banco da web
                    $.getJSON("{{route('getIconsWeb')}}", {}, function(icons){
                        //traz todos os icones que ja estao atrelados ao perfil selecionado, pra poder
                        //deixar eles marcados ao carregar a pagina
                        $.getJSON("{{route('getIconsRoleCheckedWeb')}}", {
                            role: role
                        }, function(checked_icons){
                            //traz todos os itens que ja estao atrelados ao perfil selecionado, pra poder
                            //deixar eles marcados ao carregar a pagina
                            $.getJSON("{{route('getItensRoleCheckedWeb')}}", {
                                role: role
                            }, function(checked_itens){
                                $.each(icons, function(index, icon){
                                    //traz todos os itens filhos do icone da vez do foreach
                                    $.getJSON("{{route('getItensByIconWeb')}}", {
                                        icon_id: icon.id
                                    }, function(itens){
                                        if(itens.length > 0 || icon.accordion == true)
                                        {
                                            if (checked_icons.includes(icon.id))
                                                toAppend = '<div id="icon-'+icon.id+'"><input type="checkbox" checked value="'+icon.id+'" class="icon-checkbox" name="icons[]" id="check-'+icon.id+'"/><strong>'+icon.nome+'</strong></div>';
                                            else
                                                toAppend = '<div id="icon-'+icon.id+'"><input type="checkbox" value="'+icon.id+'" class="icon-checkbox" name="icons[]" id="check-'+icon.id+'"/><strong>'+icon.nome+'</strong></div>';
                                            $container.append(toAppend);
                                            toAppend = '';
                                            $.each(itens, function(index, item){
                                                if (checked_itens.includes(item.id))
                                                    toAppend += '<p><input type="checkbox" checked name="itens[]" value="'+item.id+'" id="item-'+item.id+'" class="item-checkbox check-'+icon.id+'"/>'+item.nome+'</p>';
                                                else
                                                {
                                                    toAppend += '<p><input type="checkbox" name="itens[]" value="'+item.id+'" id="item-'+item.id+'" class="item-checkbox check-'+icon.id+'"/>'+item.nome+'</p>';
                                                }
                                            });
                                            $("#icon-"+icon.id).append(toAppend);
                                            dismissLoading();
                                        }
                                    });
                                });
                                toAppend = '<button class="btn btn-success">Salvar</button>';
                                $("#itens-button").empty().append(toAppend)
                            });
                        });
                    });
                }
                else
                {
                    alert('Escolha um perfil');
                    $container.empty();
                }
            });

            //quando clicar no checkbox pai (cada um dos icones)
            $(document).on("click", ".icon-checkbox", function(){
                //se este checkbox estiver marcado, marca todos os itens filhos deste icone
                if (this.checked)
                    $("."+($(this)[0].id)).prop("checked", true);
                //se este checkbox estiver desmarcado, desmarca todos os itens filhos deste icone
                else
                    $("."+($(this)[0].id)).prop("checked", false);
            });

            //quando clicar em um checkbox que tenha a classe item-checkbox (cada um dos itens)
            $(document).on("click", ".item-checkbox", function(){
                //se o checkbox clicado ficou marcado, marca tambem o checkbox do icone pai dele
                if (this.checked)
                    $("#"+($(this)[0].classList[1])).prop("checked", true);
                else
                {
                    //se o checkbox clicado ficou desmarcado, verifica se existe algum outro item marcado
                    //para este icone, se nao existir nenhum item marcado, desmarca o icone tambem
                    if (!$("."+$(this)[0].classList[0]).is(":checked"))
                        $("#"+($(this)[0].classList[1])).prop("checked", false);
                }
            });

            $(document).on("click", ".itens", function(){
                $(this)[0].nextSibling.classList.toggle('hidden-itens');
                $(this)[0].nextSibling.classList.toggle('shown-itens');
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