@extends('layouts.app')

@section('content')
<style>
    .margin5{
        margin-top: 5vh;
    }

    .margin15{
        margin-top: 15vh;
    }
</style>
    <title>{{$title}}</title>

    <form action="{{route('setIconItem')}}" method="POST" class="container">
        {{csrf_field()}}
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <div>
            Selecione o ícone:
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="col-md-6 col-sm-6">
                <select id="slc-icons" name="icon_id">
                    <option value="0">Todos os ícones</option>
                    @foreach($icones as $icone)
                        <option value="{{$icone->id}}">{{$icone->display_name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="icon-img" class="col-md-6 col-sm-6"></div>
        </div>
        <div id="itens-header" class="margin15"></div>
        <div id="itens-container" class="col-md-10 col-sm-10 margin5"></div>
        <div id="itens-button" class="col-md-10 col-sm-10 margin15"></div>
    </form>

    <script>
        $(document).ready(function(){
            $("#slc-icons").select2();

            $("#slc-icons").change(function(){
                let icon = $(this).val();
                $.getJSON("{{route('getItens')}}", {}, function(data){
                    $.getJSON("{{route('getItensIconChecked')}}", {
                        icon: icon
                    }, function(checked){
                        $("#itens-container").empty();
                        let toAppend = '<p>Selecione os Itens</p>';
                        $("#itens-header").empty().append(toAppend);
                        $.each(data, function(index, element){
                            let toAppend = '<div class="col-md-4 col-sm-5 margin5">';
                            if (checked.includes(element.id))
                                toAppend += '<input name="itens[]" value="'+element.id+'" checked type="checkbox"/>'+element.display_name;
                            else
                                toAppend += '<input name="itens[]" value="'+element.id+'" type="checkbox"/>'+element.display_name;
                            toAppend += '</div>';
                            $("#itens-container").append(toAppend);
                        });
                        toAppend = '<button class="btn btn-success">Salvar</button>';
                        $("#itens-button").empty().append(toAppend);
                    });
                });

                $.get("{{route('getIconImage')}}", {
                    id: icon
                }, function(data){
                    if (!data)
                        $("#icon-img").empty();
                    else
                        $("#icon-img").empty().append('<img src="'+data+'" width="100px" height="100px"/>');
                })
            });
        });
    </script>
@endsection