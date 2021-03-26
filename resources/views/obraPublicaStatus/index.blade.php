@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createObraPublicaStatus') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                @foreach ($status as $stat)
                <tr>
                    <td>{{$stat->nome}}</td>
                    <td><a href="{{ route('editObraPublicaStatus', $stat->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $status->links() !!}
    </div>
@endsection