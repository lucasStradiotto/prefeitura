@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('pinturaInt.update') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Pintura Interna
            </div>
            <div>
                <input value="{{$tipo_pintura}}" name="tipo_pintura" id="tipo_pintura"  placeholder="Insira a nova pintura interna" style="width: 300px;">
                <input name="id" type="hidden" value="{{$id}}">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Editar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_pintura').val().length < 2) {
                window.alert("Você precisa informar a pintura interna.");
                return false;
            }
            return true;
        });
    </script>
@endsection