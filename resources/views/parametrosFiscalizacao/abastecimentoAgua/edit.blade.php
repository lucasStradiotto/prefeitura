@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('abastecimentoAgua.update') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Abastecimento de Água
            </div>
            <div>
                <input value="{{$tipo_abastecimento}}" name="tipo_abastecimento" id="tipo_abastecimento"  placeholder="Insira o novo tipo de abastecimento" style="width: 300px;">
                <input name="id" type="hidden" value="{{$id}}">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Editar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_abastecimento').val().length < 2) {
                window.alert("Você precisa informar o tipo do abastecimento.");
                return false;
            }
            return true;
        });
    </script>
@endsection