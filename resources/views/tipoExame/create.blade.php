@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoExame') }}">Grupos de Exame</a></li>
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
    <div>
        @if(isset($tipoExame))
            <form class="container" method="post" action="{{ route('updateTipoExame', $tipoExame->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeTipoExame') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$tipoExame->nome or old('nome')}}">
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection