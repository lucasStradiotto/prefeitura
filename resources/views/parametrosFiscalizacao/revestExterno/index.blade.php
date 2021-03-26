@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('revestexterno.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Revestimento</th>
                    <th>Ação</th>
                </tr>
                @foreach ($revestimentos as $revest)
                    <tr>
                        <td>{{$revest->tipo_revest}}</td>
                        <td>
                            <a href="{{ route('revestexterno.edit', array($revest->tipo_revest, $revest->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('revestexterno.delete', array($revest->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($revestimentos) > 9)
            {{ $revestimentos->links() }}
        @endif
    </div>
@endsection