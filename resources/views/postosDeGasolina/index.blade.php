@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <a href="{{ route('createPosto') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome Fantasia</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Editar</th>
                </tr>
                @foreach ($postos as $posto)
                    <tr>
                        <td>
                            {{$posto->nome_fantasia}}
                        </td>
                        <td>
                            {{$posto->endereco}} , {{$posto->numero}}
                        </td>
                        <td>
                            {{$posto->telefone}}
                        </td>
                        <td>
                            <a href="{{ route('editPosto', $posto->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('deletePosto', $posto->id) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{ route('detailsPosto', $posto->id) }}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
       {{-- {!! $assuntos->links() !!}--}}
    </div>
    <script>
        $(document).ready(function(){
            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 4000);
            }
        })
    </script>
@endsection