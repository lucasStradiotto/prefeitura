@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ route('indexParametrosFiscalizacao') }}">Parâmetros</a></li>
            <li class="active">{{ $title }}</li>
        </ul>

        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @elseif (session()->has('error'))
            <div id="message" class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif

        <a href="{{ route('createTopografiaTerreno') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
                @foreach ($topografias as $topografia)
                    <tr>
                        <td>{{$topografia->descricao}}</td>
                        <td>
                            <a href="{{ route('editTopografiaTerreno', $topografia->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <form action="{{route('deleteTopografiaTerreno', $topografia->id)}}" method="post" style="display:inline; margin:0; padding:0;">
                                {{method_field('delete')}}
                                {{csrf_field()}}
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $topografias->links() !!}
    </div>
@endsection