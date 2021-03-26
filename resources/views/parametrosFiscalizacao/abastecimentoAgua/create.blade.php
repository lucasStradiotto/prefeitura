@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('abastecimentoAgua.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Abastecimento de Água
            </div>
            <div>
                <input name="tipo_abastecimento" id="tipo_abastecimento"  placeholder="Insira o novo abastecimento" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
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