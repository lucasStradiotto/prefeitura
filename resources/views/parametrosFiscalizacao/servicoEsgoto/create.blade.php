@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('servicoEsgoto.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Serviço de Esgoto
            </div>
            <div>
                <input name="tipo_esgoto" id="tipo_esgoto"  placeholder="Insira o novo tipo do serviço" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_esgoto').val().length < 2) {
                window.alert("Você precisa informar o tipo do serviço.");
                return false;
            }
            return true;
        });
    </script>
@endsection