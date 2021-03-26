@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('melhorias.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Melhoria</th>
                    <th>Ação</th>
                </tr>
                @foreach ($melhorias as $melhoria)
                    <tr>
                        <td>{{$melhoria->tipo_melhoria}}</td>
                        <td>
                            <a href="{{ route('melhorias.edit', array($melhoria->tipo_melhoria, $melhoria->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('melhorias.delete', array($melhoria->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($melhorias) > 9)
            {{ $melhorias->links() }}
        @endif
    </div>
@endsection