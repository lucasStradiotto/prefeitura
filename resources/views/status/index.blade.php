@extends('layouts.app')

@section('content')
    <style>
        .search-box{
            margin-top: 10px;
            text-align: right;
        }
    </style>

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createStatus') }}" class="btn btn-success"> Novo</a>
        <div class="search-box">
            <form action="{{route('indexStatus')}}" method="get" id="form-filter">
                Filtrar:
                <input type="text" id="txt-search" name="filter" value="{{request('filter')}}"/>
                <button class="btn btn-success" id="btn-search">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                <a class="btn btn-danger" id="btn-search-clear" title="Remover Filtros">
                    <i class="glyphicon glyphicon-remove-circle"></i>
                </a>
            </form>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>Status</th>
                    <th>Cor</th>
                    <th>Ação</th>
                </tr>
                @foreach ($status as $stat)
                    <tr>
                        <td>{{$stat->nome}}</td>
                        <td>
                            <div style="width: 1vw; height: 1vw; background-color: {{$stat->cor ? $stat->cor : '#000'}}"></div>
                        </td>
                        <td><a href="{{ route('editStatus', $stat->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $status->appends(['filter' => Request::get('filter')])->render() !!}
    </div>

    <script>
        $(document).ready(function () {
            var $txtSearch = $("#txt-search");
            $txtSearch.select();

            $("#btn-search-clear").click(function(e){
                e.preventDefault();
                $txtSearch.val("");
                $("#form-filter").submit();
            });
        });
    </script>
@endsection