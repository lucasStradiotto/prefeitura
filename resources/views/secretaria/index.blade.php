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
        <a href="{{ route('createSecretaria') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Secretaría</th>
                    <th>Ação</th>
                </tr>
                @foreach ($secretarias as $secretaria)
                    <tr>
                        <td>{{$secretaria->nome}}</td>
                        @foreach($horariosProgramados as $horario)
                            @if ($horario->id == $secretaria->horario_programado_id)
                                <td>{{$horario->inicio}} - {{$horario->fim}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{ route('editSecretaria', $secretaria->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('deleteSecretaria', $secretaria->id) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{ route('detailsSecretaria', $secretaria->id) }}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $secretarias->links() !!}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 4000);
            }
        })
    </script>
@endsection