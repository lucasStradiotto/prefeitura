@extends('layouts.app')

@section('content')

    <title>Cadastrar Tipo Alerta</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('tiposAlerta.index') }}">Tipos de Alerta</a></li>
            <li class="active">Cadastrar Tipo Alerta</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        <form class="container" method="post" action="{{ route('tiposAlerta.store') }}">
            {!! csrf_field() !!}
            <div>
                <label for="tipo">Tipo de Alerta</label>
            </div>
            <div>
                <input type="text" id="tipo" name="tipo" value="" />
            </div>
            <div>
                <label for="push">Enviar notificação push</label>
            </div>
            <div>
                <input type="checkbox" id="push" name="push" />
            </div>
            <button class="btn btn-success">Enviar</button>

        </form>
    </div>
@endsection