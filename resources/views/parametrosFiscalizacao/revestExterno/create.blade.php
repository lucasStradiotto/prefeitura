@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('revestexterno.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Revestimento Externo
            </div>
            <div>
                <input name="tipo_revest" id="tipo_revest"  placeholder="Insira o novo revestimento externo" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_revest').val().length < 2) {
                window.alert("Você precisa informar o tipo do revestimento.");
                return false;
            }
            return true;
        });
    </script>
@endsection