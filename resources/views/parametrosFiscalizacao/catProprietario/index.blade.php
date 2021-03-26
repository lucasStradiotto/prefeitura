@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('catProprietario.create') }}" class="btn btn-success">Nova</a>
        <div>
            <table class="table">
                <tr>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->tipo_categoria}}</td>
                        <td>
                            <a href="{{ route('catProprietario.edit', array($categoria->tipo_categoria, $categoria->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('catProprietario.delete', array($categoria->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($categorias) > 9)
            {{ $categorias->links() }}
        @endif
    </div>
@endsection