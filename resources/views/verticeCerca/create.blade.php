@extends('layouts.app')

@section('content')
<style>
    .borda{
        border:solid 2px black;
    }
    .text-center{
        text-align: center
    }
    .width50{
        width: 50%
    }
</style>
    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            {{--<li><a href="{{ route('indexVerticeCerca') }}">Vértices das Cercas</a></li>--}}
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
        @if(isset($cerca))
            <form class="container" method="post" action="{{ route('updateVerticeCerca', $cerca->id) }}">
                {!! method_field('PUT') !!}
        @else
            <form class="container" id="formCerca" method="post" action="{{ route('storeVerticeCerca') }}">
        @endif
            {!! csrf_field() !!}
            <div>
                Cerca
            </div>
            <div>
                <select name="cerca_id" id="cerca">
                    <option value="">Selecione a Cerca</option>
                    @foreach ($cercas as $cerca)
                        <option value="{{$cerca->id}}">{{$cerca->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                Vértices
            </div>
            <table class="borda width50 text-center" id="tabelaVertices">
                <tr class="borda">
                    <th class="text-center">Latitude</th>
                    <th class="text-center">Longitude</th>
                    <th>&nbsp;</th>
                </tr>
                <tr class="borda" id="tr0">
                    <td><input name="latitude[]" class="latitude"/></td>
                    <td><input name="longitude[]" class="longitude"/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="borda" id="tr1">
                    <td><input name="latitude[]" class="latitude"/></td>
                    <td><input name="longitude[]" class="longitude"/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr class="borda" id="tr2">
                    <td><input name="latitude[]" class="latitude"/></td>
                    <td><input name="longitude[]" class="longitude"/></td>
                    <td><span id="btnAddVertice" class="glyphicon glyphicon-plus" style="color: green;"></span></td>
                </tr>
            </table>
            <button class="btn btn-success" id="btnEnviar">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            var indexTr = 3;
           $("#btnEnviar").click(function(e){
               e.preventDefault();
               var latitudes = document.getElementsByClassName("latitude");
               var longitudes = document.getElementsByClassName("longitude");
               var nulo = false;
               for (var i=0; i < 3; i++)
               {
                   if (!latitudes[i].value || !longitudes[i].value)
                   {
                       nulo = true;
                   }
               }

               if (!nulo)
                   if($("#cerca").val())
                       $("#formCerca").submit();
                   else
                       alert("Escolha uma Cerca!");
               else
                   alert("Preencha pelo menos as 3 primeiras vértices!");
           });

            $("#btnAddVertice").click(function(){
                $("#tabelaVertices").append(
                    "<tr class='borda' id='tr"+indexTr+"'>" +
                    "<td>" +
                    "<input name='latitude[]' class='latitude'>" +
                    "</td>" +
                    "<td>" +
                    "<input name='longitude[]' class='longitude'>" +
                    "</td>" +
                    "<td>" +
                    "<span class='btn btn-danger btnRmVertice' id='"+indexTr+"' style='width: 100%;'>-</span>" +
                    "</td>" +
                    "</tr>");
                indexTr++;
            });

            $(document).on("click", ".btnRmVertice", function(){
                var linha = $(this)[0].id;
                $("#tr"+linha).remove();
            });
        });
    </script>
@endsection