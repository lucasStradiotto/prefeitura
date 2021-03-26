@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexPossivelObservacao') }}">Observações</a></li>
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
        @if(isset($observacao))
            <form class="container" method="post" action="{{ route('updatePossivelObservacao', $observacao->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storePossivelObservacao') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome_observacao" value="{{$observacao->nome_observacao or old('nome_observacao')}}">
                        </div>

                        <div>
                            Secretaria
                        </div>
                        <div>
                            <select name="secretaria_id">
                                @foreach($secretarias as $secretaria)
                                    <option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection