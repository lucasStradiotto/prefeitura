@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexProtocolo') }}">Protocolos</a></li>
            <li><a href="{{ route('indexAnexarDocumento', $protocoloId) }}">Anexar Documentos</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) and count($errors)>0)
        <div class="alert alert-danger">
            <p>{{$errors}}</p>
        </div>
    @endif
    <div>
        <form class="container" method="post" enctype="multipart/form-data" action="{{ route('storeAnexarDocumento', $protocoloId) }}">
            {!! csrf_field() !!}
            <div>
                <h2>Escolha o Documento</h2>
                <input type="file" name="doc" value="" accept=".pdf, .jpg">
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection