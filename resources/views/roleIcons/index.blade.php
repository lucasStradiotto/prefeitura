@extends('layouts.app')

@section('content')
<style>
    .classe{
        display: inline-block;
        margin-right: 20px;
        text-align: center;
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
    <div id="body" class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form action="{{route('storeRoleIcons')}}" method="post">
            {!! csrf_field() !!}
            <div>Perfil</div>
            <div>
                <select id="slc-role" name="role_id">
                    <option value="0">Todos os Perfis</option>
                    @foreach($perfis as $perfil)
                        <option value="{{$perfil->id}}">{{$perfil->display_name}}</option>
                    @endforeach
                </select>
            </div>

            <div>Icones</div>
            <div id="icons-container"></div>

            <div>
                <button class="btn btn-success">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        $("select").select2();

        $(document).ready(function(){
            $("#slc-role").change(function(){
                startLoading();

                let role_id = $(this).val();
                $.getJSON("{{route('getIcons')}}", {}, function(data){
                    $("#icons-container").empty();
                    appendCheckboxes(data, role_id).then(()=>{
                        loadImages().then(()=>{
                            stopLoading();
                        });
                    });
                });
            });

            function appendCheckboxes(data, role_id){
                return new Promise(function(resolve, reject){
                    $.getJSON("{{route('getIconsRoleChecked')}}", {
                        role_id: role_id
                    }, function(checked){
                        for(let i=0; i<data.length; i++)
                        {
                            let toAppend = '<div class="classe">';
                            toAppend += '<div class="imagem" id="' + data[i].id + '"></div>';
                            if (checked.includes(data[i].id))
                                toAppend += '<div><input type="checkbox" checked value="' + data[i].id + '" name="icons[]"/></div>';
                            else
                                toAppend += '<div><input type="checkbox" value="' + data[i].id + '" name="icons[]"/></div>';
                            toAppend += '</div>';
                            $("#icons-container").append(toAppend);
                            if (i==data.length-1)
                                resolve(true);
                        }
                    });
                });
            }

            function startLoading(){
                let $loading = $("#loading");
                let loadingToAppend = '<div class="container-loader">';
                loadingToAppend += '<div class="points-loader first-point"></div>';
                loadingToAppend += '<div class="points-loader second-point"></div>';
                loadingToAppend += '<div class="points-loader third-point"></div>';
                loadingToAppend += '</div>';
                $loading.append(loadingToAppend);

                $("#body").addClass('opacity');
            }

            function stopLoading(){
                let $loading = $("#loading");
                $loading.empty();
                $("#body").removeClass('opacity');
            }

            function loadImages(){
                return new Promise(function(resolve, reject){
                    $(".imagem").each(function(i){
                        var $icone = $(this);
                        $.get("/controleobras/downloadIcone?icone_id="+$icone[0].id, {}, function(data){
                        }).done(function(data){
                            $icone.empty();
                            $icone.append("<img src='"+data+"' style='width: 150px; height: 150px;'/>");

                            if (i==$(".imagem").length-1)
                                resolve(true);
                        }).catch(function(err){
                            console.log(err);
                        });
                    });
                });
            }
        });
    </script>
@endsection