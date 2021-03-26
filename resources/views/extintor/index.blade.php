@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Extintores</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <a href="{{ route('createExtintor') }}" class="btn btn-success"> Cadastrar Extintor</a>
        <a href="{{ route('vincularExtintor') }}" class="btn btn-success"> Vincular Extintor ao Veículo</a><hr>
        <div class="display">
            <table id="extintor" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Inscrição</th>
                        <th>Validade</th>
                        <th>Tipo</th>
                        <th>Vencimento</th>
                        <th>Veículo</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($extintor as $extintores)           
                        <tr>
                            <td>{{$extintores->id}}</td>
                            <td>{{$extintores->inscricao}}</td>
                            <td>{{$extintores->validade}}</td>
                            <td>{{$extintores->tipo}}</td>
                            <td></td>
                            <td></td>
                            <td style="width:10px"><a href="{{ route('editExtintor', $extintores->id) }}" class="no-sort btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>  
                            <td style="width:10px"><a href="{{ route('deleteExtintor', $extintores->id) }}" class="no-sort btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a></td>     
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Inscrição</th>
                        <th>Validade</th>
                        <th>Tipo</th>
                        <th>Vencimento</th>
                        <th>Veículo</th>
                        <th class="no-sort"></th>
                        <th class="no-sort"></th>
                    </tr>
                </tfoot>
            </table>
        </div>       
    </div>
    
<script>
    $(document).ready(function(){
        if($("#message").length>0){
            setTimeout(function(){ $("#message").remove() }, 6000);
        }

        var table = $('#extintor').DataTable({
            "columnDefs": [{ targets: 'no-sort', orderable: false }]
        });
    })
</script>
@endsection