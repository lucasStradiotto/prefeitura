@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('pinturaInt.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Pintura Interna
            </div>
            <div>
                <input name="tipo_pintura" id="tipo_pintura"  placeholder="Insira a nova pintura interna" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
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