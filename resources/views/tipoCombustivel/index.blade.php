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
        <a href="{{ route('createTipoCombustivel') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Tipo de Combustível</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tiposCombustivel as $tipo)
                    <tr>
                        <td>{{$tipo->descricao}}</td>
                        <td>
                            <a href="{{ route('editTipoCombustivel', $tipo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{route('deleteTipoCombustivel', $tipo->id)}}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{route('detailsTipoCombustivel', $tipo->id)}}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $tiposCombustivel->links() !!}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 4000);
            }
        })
    </script>
@endsection