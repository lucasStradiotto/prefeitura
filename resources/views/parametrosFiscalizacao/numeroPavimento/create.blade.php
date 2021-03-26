@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('numeroPavimento.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Número de Pavimento
            </div>
            <div>
                <input name="tipo_pavimento" id="tipo_pavimento"  placeholder="Insira o novo pavimento" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_pavimento').val().length < 2) {
                window.alert("Você precisa informar o pavimento.");
                return false;
            }
            return true;
        });
    </script>
@endsection