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
        <a href="{{ route('createMotorista') }}" class="btn btn-success"> Novo</a>
        <div class="search-box">
            <form action="{{route('indexMotorista')}}" method="get" id="form-filter">
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
                    <th></th>
                    <th>Nome</th>
                    <th>Jornada de Trabalho</th>
                    <th>Número CNH</th>
                    <th>Validade CNH</th>
                    <th>Ação</th>
                </tr>
                @foreach ($motoristas as $motorista)
                    <tr>
                        <td>{{$motorista->cont}}</td>
                        <td style="max-width: 400px;width: 400px;">{{$motorista->nome}}</td>
                        <td>{{$motorista->inicio}}-{{$motorista->fim}}</td>
                        <td>{{$motorista->cnh_numero}}</td>
                        <td>{{$motorista->validade ? Carbon\Carbon::parse($motorista->validade)->format('d/m/y') : ''}}</td>
                        <td>
                            <a href="{{ route('editMotorista', $motorista->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('deleteMotorista', $motorista->id) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                            <a href="{{ route('detailsMotorista', $motorista->id) }}" class="btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('deleteSenhaMotorista', $motorista->id) }}" class="btn btn-info" title="Resetar Senha"><i class="glyphicon glyphicon-retweet"></i></a>
                            <a data-toggle="modal" data-target="#passwordModal" data-motorista_id="{{$motorista->id}}" class="btn btn-info" title="Definir Senha"><i class="glyphicon glyphicon-lock"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $motoristas->appends(['filter' => Request::get('filter')])->render() !!}
    </div>

    <!-- Modal definir senha do motorista -->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="passwordModalBody"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save-changes">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#passwordModal').on('show.bs.modal', function (e) {
                let id = e.relatedTarget.dataset.motorista_id;
                $.getJSON("{{url('getMotoristaById')}}", {
                    motorista_id: id
                }, function(data){
                    $("#passwordModalLabel").text("Definir senha");
                    $("#passwordModalBody").text("Defina uma senha para "+data.nome+".");
                    let toAppend = '<input type="password" id="new-password" style="margin-left: 2vw;"/>';
                    toAppend += '<input type="hidden" id="motorista_id" value="'+id+'"/>';
                    $("#passwordModalBody").append(toAppend);
                });
            });

            $(document).on("click", "#btn-save-changes", function(){
                let newpass = $("#new-password").val();
                $.getJSON("{{url('defineSenhaMotorista')}}", {
                    pass: newpass,
                    motorista_id: $("#motorista_id").val()
                }, function(data){
                    if (data.message === "true")
                    {
                        swal({
                            type: 'success',
                            title: 'Senha definida com sucesso!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(()=>{
                            location.reload();
                        });
                    }
                    else
                    {
                        swal({
                            type: 'error',
                            title: 'Algo deu errado ao definir a senha!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(()=>{
                            location.reload();
                        });
                    }
                });
            });


            let $txtSearch = $("#txt-search");
            $txtSearch.select();

            $("#btn-search-clear").click(function(e){
                e.preventDefault();
                $txtSearch.val("");
                $("#form-filter").submit();
            });

            if($("#message").length>0){
                setTimeout(function(){ $("#message").remove() }, 4000);
            }
        });
    </script>
@endsection