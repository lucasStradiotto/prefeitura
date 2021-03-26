@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('servicoRedeEletrica.update') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Serviço de Rede Elétrica
            </div>
            <div>
                <input value="{{$tipo_rede_eletrica}}" name="tipo_rede_eletrica" id="tipo_rede_eletrica"  placeholder="Insira o tipo do serviço" style="width: 300px;">
                <input name="id" type="hidden" value="{{$id}}">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Editar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_rede_eletrica').val().length < 2) {
                window.alert("Você precisa informar o tipo serviço.");
                return false;
            }
            return true;
        });
    </script>
@endsection