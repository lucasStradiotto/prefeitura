@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>

        <form id="form" class="container" method="post" action="{{ route('melhorias.update') }}">
            {{ csrf_field() }}
            <div style="margin-bottom: 10px;">
                Melhoria
            </div>
            <div>
                <input value="{{$tipo_melhoria}}" name="tipo_melhoria" id="tipo_melhoria"  placeholder="Insira a nova melhoria" style="width: 300px;">
                <input name="id" type="hidden" value="{{$id}}">
            </div>

            <button style="margin-top: 15px;" class="btn btn-success" id="btn_submit">Editar</button>
        </form>
    </div>

    <script>
        $('#form').submit(function() {
            if($('#tipo_melhoria').val().length < 2) {
                window.alert("Você precisa informar a melhoria.");
                return false;
            }
            return true;
        });
    </script>
@endsection