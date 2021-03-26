@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('indexCacamba') }}">Caçamba</a></li>
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
    <form class="container"
        @if(isset($cacamba))
            method="post" action="{{ route('updateCacamba', $cacamba->id) }}">
            {!! method_field('PUT') !!}
            <div> Número </div>
            <div>
                <input name="codigo" value="{{$cacamba->codigo or old('codigo')}}">
            </div>
        @else
            method="post" action="{{ route('storeCacamba') }}">
            <div> Quantidade </div>
            <div>
                <input name="qtd" value="{{old('codigo')}}">
            </div>
        @endif
            {!! csrf_field() !!}
            <div> Empresa </div>
            <div>
                <select name="empresa_id" class="col-md-6">
                    @foreach($empresas as $empresa)
                        <option value="{{$empresa->id}}"
                                @if (isset($cacamba) && $empresa->id == $cacamba->empresa_id)
                                selected
                                @endif
                        >{{$empresa->nome_fantasia}}</option>
                    @endforeach
                </select>
                <a href="{{ route('createEmpresa') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
        <div> Status </div>
        <div>
            <select name="status_cacamba_id" class="col-md-6">
                @foreach($status as $stat)
                    <option value="{{$stat->id}}"
                            @if (isset($cacamba) && $stat->id == $cacamba->status_cacamba_id)
                            selected
                            @endif
                    >{{$stat->descricao}}</option>
                @endforeach
            </select>
            <a href="{{ route('createStatusCacamba') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <button class="btn btn-success" id="btnEnviar">Enviar</button>
        </form>
    </div>

<script>
    $(document).ready(function() {
        $("select").select2();
    });
</script>
@endsection