@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('pisoInterno.update') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Piso Interno
            </div>
            <div>
                <input value="{{$tipo_piso}}" name="tipo_piso" id="tipo_piso"  placeholder="Insira o novo piso interno" style="width: 300px;">
                <input name="id" type="hidden" value="{{$id}}">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Editar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_piso').val().length < 2) {
                window.alert("Você precisa informar o tipo do piso.");
                return false;
            }
            return true;
        });
    </script>
@endsection