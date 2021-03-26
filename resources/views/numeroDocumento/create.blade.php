@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li><a href="{{ route('indexNumeroDocumento') }}">Últimos Números de Documentos</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
    <form method="post" action="{{route('updateNumeroDocumento')}}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <div>
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div>
            <h3>Tipo do Documento</h3>
            <select name="nome">
                <option value="alvDem">Alvará de Demolição</option>
                {{--<option value="cerDem">Certidão de Demolição</option>--}}
                {{--<option value="habite">Habite-se</option>--}}
                {{--<option value="cerCon">Certidão de Construção</option>--}}
                <option value="outros">
                    Certidão de Demolição, Habite-se e Certidão de Construção
                </option>
            </select>
        </div>
        <div>
            <h3>Número do Último Documento</h3>
            <input name="numero_atual">
        </div>
        <div>
            <button class="btn btn-success">Atribuir</button>
        </div>
    </form>
@endsection
