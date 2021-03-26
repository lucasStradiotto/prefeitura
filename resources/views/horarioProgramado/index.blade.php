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
        <a href="{{ route('createHorarioProgramado') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Ação</th>
                </tr>
                @foreach ($horariosProgramados as $horario)
                    <tr>
                        <td>{{$horario->inicio}}</td>
                        <td>{{$horario->fim}}</td>
                        <td>
                            <a href="{{ route('editHorarioProgramado', $horario->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{route('deleteHorarioProgramado', $horario->id) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{route('detailsHorarioProgramado', $horario->id)}}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 6000);
            }
        })
    </script>
@endsection