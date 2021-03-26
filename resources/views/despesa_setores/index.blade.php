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
        <a href="{{ route('createDespesaSetores') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Secretaria</th>
                    <th>Setor</th>
                    <th>Ação</th>
                </tr>
                @foreach ($setores as $setor)
                    <tr>
                        <td>{{$setor->secretaria}}</td>
                        <td>{{$setor->nome}}</td>
                        <td>
                            <a href="{{ route('editDespesaSetores', $setor->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{route('deleteDespesaSetores', $setor->id)}}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>    
                        </td>
                        
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $setores->links() !!}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 6000);
            }
        })
    </script>
@endsection