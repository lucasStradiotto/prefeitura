@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createIconesCidadeFacil') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Ícone</th>
                    <th>Nome</th>
                    <th>Display Name</th>
                    <th>Ação</th>
                </tr>
                @foreach ($icones as $icone)
                <tr>
                    <td style="width: 50px; height: 50px;" class="imagem" id="{{$icone->id}}">
                    <td>{{$icone->nome}}</td>
                    <td>{{$icone->display_name}}</td>
                    <td><a href="{{ route('editIconesCidadeFacil', $icone->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $icones->links() !!}
    </div>

    <script>
        $(document).ready(function(){
            $(".imagem").each(function(){
                var $icone = $(this);
                // console.log($podador.id);
                $.get("/controleobras/downloadIcone?icone_id="+$icone[0].id, {}, function(data){

                }).done(function(data){
                    $icone.empty();
                    $icone.append("<img src='"+data+"' style='width: 50px; height: 50px;'/>");
                }).catch(function(err){
                    console.log(err);
                });
            });
        });
    </script>
@endsection