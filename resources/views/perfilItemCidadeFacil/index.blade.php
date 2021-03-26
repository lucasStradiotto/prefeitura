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
        <form action="{{route('setPerfilItem')}}" method="POST" class="container">
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
            $("#slc-perfis").select2();
            $("#slc-perfis").change(function(){
                showLoading();
                let role = $(this).val();
                let $container = $("#itens-container");
                let _cont_icons = 0;
                let _max_icons = 0;
                $.getJSON("{{route('getIcons')}}", {}, function(data){
                    toAppend = '<p>Selecione os Itens</p>';
                    $("#itens-header").empty().append(toAppend);
                    $container.empty();

                    $.getJSON("{{route('getItensRoleChecked')}}", {
                        role: role
                    }, function(checked){
                        $.each(data, function(index, element){
                            getIconImage(element.id).then(function(ret){
                                toAppend = '<div class="margin5 bordered" id="'+ret.id+'"><p><strong><input id="'+ret.id+'" class="family-checkbox" type="checkbox"/>'+element.display_name+'</strong></p>';
                                $container.append(toAppend);
                                $("#"+ret.id).append(ret.toAppend);
                                _max_icons = data.length;

                                $.getJSON("{{route('getItensByIcon')}}", {
                                    icon_id: element.id
                                }, function(data){
                                    _cont_icons++;
                                    toAppend = '<div class="shown-itens">';
                                    $.each(data, function(index, element){
                                        if (checked.includes(element.id))
                                            toAppend += '<p><input name="itens[]" value="'+element.id+'" class="'+ret.id+'" checked type="checkbox"/>'+element.display_name+'</p>';
                                        else
                                            toAppend += '<p><input name="itens[]" value="'+element.id+'" class="'+ret.id+'" type="checkbox"/>'+element.display_name+'</p>';
                                    });
                                    toAppend += '</div>';
                                    $("#"+ret.id).append(toAppend);
                                    $container.append('</div>');
                                    if (_cont_icons == _max_icons)
                                        dismissLoading();
                                });
                            });
                        });
                        toAppend = '<button class="btn btn-success">Salvar</button>';
                        $("#itens-button").empty().append(toAppend)
                    });
                });
            });

            $(document).on("click", ".family-checkbox", function(){
                if (this.checked)
                    $("."+($(this)[0].id)).attr("checked", true);
                else
                    $("."+($(this)[0].id)).removeAttr("checked");
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

        function getIconImage(id){
            return new Promise(function(resolve, reject){
                $.get("{{route('getIconImage')}}", {
                    id: id
                }, function(data){
                    let ret = {
                        id: id,
                        toAppend:'<img class="itens" src="'+data+'" width="100px" height="100px"/>'
                    };
                    resolve(ret);
                });
            });
        }
    </script>
@endsection