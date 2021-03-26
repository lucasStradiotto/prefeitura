@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <a href="{{ route('createTipoVeiculo') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th></th>
                    <th>Grupo de Veículos</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tipoVeiculos as $tipoVeiculo)
                    <tr>
                        <td>{{$tipoVeiculo->cont}}</td>
                        <td>{{$tipoVeiculo->nome}}</td>
                        <td>
                            @if($tipoVeiculo->icone == "caminhao")
                                <svg viewBox="0 -700 1000 1000" style="width: 80px; height: 80px; zoom: 0.5;" class="svg-black">
                            @else
                                <svg viewBox="0 0 1000 900" style="width:80px; height: 80px; zoom: 0.5;" class="svg-white">
                            @endif
                            @include($tipoVeiculo->svg)
                            </svg>
                            <a href="{{ route('editTipoVeiculo', $tipoVeiculo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('deleteTipoVeiculo', $tipoVeiculo->id) }}" class="btn btn-danger" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{ route('detailsTipoVeiculo', $tipoVeiculo->id) }}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $tipoVeiculos->links() !!}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 6000);
            }
        })
    </script>
@endsection