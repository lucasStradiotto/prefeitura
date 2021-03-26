@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createItemCidadeFacil') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Display Name</th>
                    <th>Description</th>
                </tr>
                @foreach ($itens as $item)
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->display_name}}</td>
                    <td>{{$item->description}}</td>
                    <td><a href="{{ route('editItemCidadeFacil', $item->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $itens->links() !!}
    </div>
@endsection