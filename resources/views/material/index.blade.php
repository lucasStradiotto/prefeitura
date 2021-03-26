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
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        @if (session()->has('message'))
            <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <a href="{{ route('createMaterial') }}" class="btn btn-success"> Novo</a>
     
        
        <div>
            <table class="table">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ação</th>
                </tr>
                @foreach ($materiais as $material)
                    <tr>
                        <td>{{$material->id}}</td>
                        <td>{{$material->material}}</td>
                        <td>{{$material->marca}}</td>
                        <td>{{$material->modelo}}</td>
                        <td>
                            <a title="Editar" href="{{ route('editMaterial', $material->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <!--  -->
                            <a data-toggle="modal" data-target="#deleteModal" data-id="{{$material->id}}" data-material="{{$material->material}}"  title="Deletar" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a title="Detalhes" href="{{ route('detailsMaterial', $material->id) }}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                         
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="deleteModalBody"></div>
                </div>
                <div class="modal-footer">
                    <form id="formId" action="" method="POST">
                        {!! method_field('DELETE') !!}
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btn-save-changes">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
            $('#deleteModal').on('show.bs.modal', function (e) {
                let id = e.relatedTarget.dataset.id;
                let name = e.relatedTarget.dataset.material;
                $("#deleteModalLabel").text("Deletar Material");
                $("#deleteModalBody").append(`
                                    <label>Tem certeza que deseja deletar o material => ${name}</label>`);
                $("#formId").attr("action", "/material/delete/" + id);       
                    
            });
            
        });
    </script>
@endsection