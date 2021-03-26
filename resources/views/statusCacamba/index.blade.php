@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createStatusCacamba') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
                @foreach ($status as $stat)
                <tr>
                    <td>{{$stat->descricao}}</td>
                    <td><a href="{{ route('editStatusCacamba', $stat->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $status->links() !!}
    </div>
@endsection