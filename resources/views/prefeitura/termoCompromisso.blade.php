@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <div>
        <form class="container" method="post" action="{{ route('termoCompromissoStore') }}">
            {!! csrf_field() !!}
            <div>Termo de Compromisso</div>
            <div>
                <textarea cols="100" rows="10" name="termo_compromisso">{{$prefeitura->termo_compromisso}}</textarea>
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
@endsection