@extends('layouts.app')

@section('content')

    <style>
        .search-box{
            margin-top: 10px;
            text-align: right;
        }
    </style>

    <title>Detalhes</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">Detalhes</li>
        </ul>
        
    <a class="btn btn-warning" title="Voltar" href="{{ route('indexMaterial') }}" >Voltar</a>    
    <a class="btn btn-primary" title="
    editar" href="{{ route('editMaterial', $material->id) }}" >Editar</a>
        <div>
            <div class="col-md-12">
                <label>Material: {{ $material->material}}</label>
            </div>
            <div class="col-md-12">
                <label>Marca: {{ $material->marca }}</label>
            </div>
            <div class="col-md-12">
                <label>Modelo: {{ $material->modelo }}</label>
            </div>
            <div class="col-md-12">
                <label>Cod. Fabricante: {{ $material->codigo_fabricante }}</label>
            </div>
            <div class="col-md-12">
                <label>Un. Compra: {{ $material->unidade_compra }}</label>
            </div>
            <div class="col-md-12">
                <label>Un. Movimento: {{ $material->unidade_movimento }}</label>
            </div>
            <div class="col-md-12">
                <label>Fator Conversão: {{ $material->fator_conversao }}</label>
            </div>
        </div>
    </div>


@endsection