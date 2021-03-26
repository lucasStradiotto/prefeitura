@extends('layouts.app')

@section('content')

    <title>Novo Material</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexMaterial') }}">Material</a></li>
            <li class="active">Editar</li>
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

    <a class="btn btn-warning" title="Voltar" href="{{ route('indexMaterial') }}" >Voltar</a>
        <form class="container" method="post" action="/material/update/{{$material->id}}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-md-2">Material</label>
                <div class="col-md-4">
                <input type="hidden" class="form-control" name="id" id="id">
                    <input type="text" class="form-control" name="material" id="material" value="{{$material->material}}" >
                </div>
                <label class="col-md-2">Marca</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="marca" id="marca"  value="{{$material->marca}}" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2">Modelo</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="modelo" id="modelo" value="{{$material->modelo}}">
                </div>
                <label class="col-md-2">Cod. Fabricante</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="codigo_fabricante" id="codigo_fabricante" value="{{$material->codigo_fabricante}}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2">Un. Compra</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="unidade_compra" id="unidade_compra" value="{{$material->unidade_compra}}">
                </div>
                <label class="col-md-2">Un. Movimento</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="unidade_movimento" id="unidade_movimento" value="{{$material->unidade_movimento}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Fator Conversão</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="fator_conversao" id="fator_conversao" value="{{$material->fator_conversao}}">
                </div>
               
            </div>
            
            <div class="col-md-12">
             <button class="btn btn-success" >Salvar <i class="glyphicon glyphicon-send"></i></button>
            
            </div>

        </form>
    </div>


@endsection