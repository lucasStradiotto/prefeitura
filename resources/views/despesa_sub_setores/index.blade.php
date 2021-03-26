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
        <a href="{{ route('createDespesaSubSetores') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Secretaria</th>
                    <th>Setor</th>
                    <th>Sub Setor</th>
                    <th>Ação</th>
                </tr>
                @foreach ($subSetores as $subSetor)
                    <tr>
                        <td>{{$subSetor->secretaria}}</td>
                        <td>{{$subSetor->setor}}</td>
                        <td>{{$subSetor->nome}}</td>
                        <td>
                            <a href="{{ route('editDespesaSubSetores', $subSetor->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{route('deleteDespesaSubSetores',$subSetor->id)}}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{route('detailsDespesaSubSetores', $subSetor->id)}}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $subSetores->links() !!}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 6000);
            }
        })
    </script>
@endsection