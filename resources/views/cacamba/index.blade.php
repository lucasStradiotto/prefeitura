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
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createCacamba') }}" class="btn btn-success"> Novo</a>
        <div>
            <div class="search-box">
                <form action="{{route('indexCacamba')}}" method="get" id="form-filter">
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
            <table class="table">
                <tr>
                    <th>Número</th>
                    <th>Empresa</th>
                    <th>Status</th>
                    <th>Endereço</th>
                    <th>Tempo</th>
                    <th>Ação</th>
                </tr>
                @foreach ($cacambas as $cacamba)
                    <tr>
                        <td>#{{$cacamba->codigo}}</td>
                        <td>{{$cacamba->Empresa->nome_fantasia}}</td>
                        <td>{{$cacamba->Status->descricao}}</td>
                        <td>
                            @if($cacamba->nome_bairro)
                                {{$cacamba->nome_bairro}} - {{$cacamba->nome_rua}}, {{$cacamba->numero_casa}}
                            @endif
                        </td>
                        <td>
                            @php
                                $entrega = $cacamba->data_entrega;
                                $hoje = \Carbon\Carbon::now();
                                $diff = \Carbon\Carbon::parse($entrega)->diffInDays($hoje);
                            @endphp
                            @if ($diff > 0)
                                {{$diff}} dia(s)
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('editCacamba', $cacamba->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-cacamba-id="{{$cacamba->id}}" class="btn btn-info open-modal">
                                <span class="glyphicon glyphicon-stats"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $cacambas->appends(['filter' => Request::get('filter')])->render() !!}
    </div>

    {{--Início Modal--}}
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alterar Status da Caçamba</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="status">Status</label>
                        <select id="status">
                            @foreach ($status as $stat)
                                <option value="{{$stat->id}}">{{$stat->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="exampleCancelButton" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="exampleConfirmButton" data-cacamba="0">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
    {{--Fim Modal--}}

    <script>
        $(document).ready(function () {
            let $txtSearch = $("#txt-search");
            $txtSearch.select();

            $("#btn-search-clear").click(function(e){
                e.preventDefault();
                $txtSearch.val("");
                $("#form-filter").submit();
            });

            let $modal = $("#exampleModalLong");
            $(document).on("click", ".open-modal", function(e){
                let targ = e.target;
                if (e.target.classList.contains("glyphicon")) {
                    targ = e.target.parentElement;
                }
                let cacamba_id = $(targ)[0].dataset.cacambaId;
                $("#exampleConfirmButton").attr('data-cacamba', cacamba_id);
                $modal.modal('show', {cacamba_id: cacamba_id});
            });

            $(document).on("click", "#exampleConfirmButton", function(e) {
                let cacamba_id = e.target.dataset.cacamba;
                let status_id = $("#status").val();

                $.getJSON("{{ route('alterarStatus') }}", {
                    cacamba_id: cacamba_id,
                    status_id: status_id
                }, function (data, textStatus, jqXHR) {
                    if (data.ok) {
                        swal({
                            type: 'success',
                            title: 'Status alterado com sucesso!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: 'Houve algum erro ao alterar status!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                    window.location.reload();
                });
            });
        });
    </script>
@endsection