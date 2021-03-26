@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('pinturaExt.create') }}" class="btn btn-success">Nova</a>
        <div>
            <table class="table">
                <tr>
                    <th>Pintura</th>
                    <th>Ação</th>
                </tr>
                @foreach ($pinturas as $pintura)
                    <tr>
                        <td>{{$pintura->tipo_pintura}}</td>
                        <td>
                            <a href="{{ route('pinturaExt.edit', array($pintura->tipo_pintura, $pintura->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('pinturaExt.delete', array($pintura->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($pinturas) > 9)
            {{ $pinturas->links() }}
        @endif
    </div>
@endsection