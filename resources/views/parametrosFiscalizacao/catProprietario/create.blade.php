@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('catProprietario.store') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Categoria de Proprietário
            </div>
            <div>
                <input name="tipo_categoria" id="tipo_categoria"  placeholder="Insira a nova categoria" style="width: 300px;">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Enviar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_categoria').val().length < 2) {
                window.alert("Você precisa informar a categoria.");
                return false;
            }
            return true;
        });
    </script>
@endsection