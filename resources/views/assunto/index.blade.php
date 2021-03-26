@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createAssunto') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Assunto</th>
                    <th>Grupo</th>
                    <th>Ação</th>
                </tr>
                @foreach ($assuntos as $assunto)
                    <tr>
                        <td>
                            {{$assunto->nome}}
                        </td>
                        <td>
                            @foreach($tipoAssuntos as $tipoAssunto)
                                @if($tipoAssunto->id == $assunto->tipo_assunto_id)
                                    {{$tipoAssunto->grupo}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('editAssunto', $assunto->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $assuntos->links() !!}
    </div>
@endsection