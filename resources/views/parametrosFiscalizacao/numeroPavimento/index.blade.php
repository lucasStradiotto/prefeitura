@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('numeroPavimento.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Número de Pavimento</th>
                    <th>Ação</th>
                </tr>
                @foreach ($numeroPavimento as $numero)
                    <tr>
                        <td>{{$numero->tipo_pavimento}}</td>
                        <td>
                            <a href="{{ route('numeroPavimento.edit', array($numero->tipo_pavimento, $numero->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('numeroPavimento.delete', array($numero->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($numeroPavimento) > 9)
            {{ $numeroPavimento->links() }}
        @endif
    </div>
@endsection