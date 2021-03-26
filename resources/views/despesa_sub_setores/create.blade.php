@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexDespesaSubSetores') }}">Sub Setores</a></li>
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
        @if(isset($subSetor))
            <form class="container" method="post" action="{{ route('updateDespesaSubSetores', $subSetor->id) }}">
            {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeDespesaSubSetores') }}">
                @endif
                {!! csrf_field() !!}
                <div>
                    Sub Setor
                </div>
                <div>
                    <input name="nome" value="{{$subSetor->nome or old('nome')}}">
                </div>
                <div>
                    Setor
                </div>
                <div>
                    <select name="despesa_setor_id" id="despesa_setor_id">
                        <option value="0"></option>
                        @foreach ($setores as $setor)
                            <option value="{{$setor->id}}" {{(isset($subSetor->despesa_setor_id) && $subSetor->despesa_setor_id == $setor->id) ? "selected" : ""}}>
                                {{$setor->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Enviar</button>

            </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#despesa_setor_id').select2();
        });
    </script>
@endsection