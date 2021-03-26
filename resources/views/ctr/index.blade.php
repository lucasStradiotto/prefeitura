@extends('layouts.app')

<style>
    .aceita {
        background-color: #bcffc7;
    }

    .recusada {
        background-color: #ffc9c4;
    }

    .pendente {
        background-color: #b5b6bc;
    }
</style>
@section('content')
    <title>{{$title}}</title>
<div class="conteiner">
    <ul class="breadcrumb">
        <li class="active">{{ $title }}</li>
    </ul>
    <div style="overflow-x: scroll">
        <div>
            <table class="table">
                <tr>
                    <th>Solicitante</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Data da solicitação</th>
                    <th>Ações</th>
                </tr>
                @foreach($solicitacoes as $solicitacao)
                    @if ($solicitacao->aceito === 1) <tr class="aceita">
                    @elseif ($solicitacao->aceito === 0) <tr class="recusada">
                    @elseif ($solicitacao->aceito === null) <tr class="pendente"> @endif
                    <td>{{$solicitacao->nome_solicitante}}</td>
                    <td>{{$solicitacao->nome_rua}} , {{$solicitacao->numero}}</td>
                    <td>{{$solicitacao->telefone}}</td>
                    <td>{{$solicitacao->data_solicitacao}}</td>
                    <td>
                        @if ($solicitacao->aceito === null)
                        <a id="modal-aceitar" data-solicitacao="{{$solicitacao->id}}" class="btn btn-success open-modal">
                            <span class="glyphicon glyphicon-check"></span>
                        </a>
                        @endif
                        @if ($solicitacao->aceito === 1)
                        <a id="enviar" href="{{ route('ctr.formulario',$solicitacao->id) }}" class="btn btn-info">
                            <span class="glyphicon glyphicon-file"></span>
                        </a>
                        @endif
                        @if ($solicitacao->aceito === null)
                        <a id="modal-recusar" data-solicitacao="{{$solicitacao->id}}" class="btn btn-danger open-modal">
                            <span class="glyphicon glyphicon-remove-circle"></span>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{--Início Modal--}}
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="exampleModalContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="exampleCancelButton" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="exampleConfirmButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--Fim Modal--}}
</div>
<script>
    $(document).ready(function(){
        let $modal = $("#exampleModalLong");
        $modal.on("show.bs.modal", function(e){
            let $modalTitle = $("#exampleModalLongTitle");
            let $modalContent = $("#exampleModalContent");
            let $cancelButton = $("#exampleCancelButton");
            let $confirmButton = $("#exampleConfirmButton");
            let solicitacao_id = e.relatedTarget.solicitacao_id;
            if(e.relatedTarget.id == "modal-aceitar")
            {
                $modalTitle.text("Aceitar solicitação de caçamba");
                $modalContent.text('Deseja aceitar a solicitação de caçamba?');
                $modalContent.after('<p>Valor do serviço</p> R$:&nbsp;<input type="text" id="txt-valor" placeholder="0,00"/>');
                $cancelButton.text('Não');
                $confirmButton.text('Sim');
                $confirmButton.removeClass();
                $confirmButton.addClass('btn btn-success');
                $confirmButton.attr('data-solicitacao', solicitacao_id);
            }
            else if(e.relatedTarget.id == "modal-recusar")
            {
                $modalTitle.text("Recusar solicitação de caçamba");
                $modalContent.text('Deseja recusar solicitação de caçamba?');
                $cancelButton.text('Não');
                $confirmButton.text('Sim');
                $confirmButton.removeClass();
                $confirmButton.addClass('btn btn-danger');
                $confirmButton.attr('data-solicitacao', solicitacao_id);
            }
        });

        $(document).on("click", "#exampleConfirmButton", function(e){
            if($(this)[0].classList.contains("btn-success"))
            {
                let solicitacao_id = e.target.dataset.solicitacao;
                let valor = $("#txt-valor").val();
                $.get("aceitar-solicitacao-cacamba", {
                    solicitacao_id: solicitacao_id,
                    valor: valor
                }, function(data){
                    if (data.message === 'Ok') {
                        $modal.modal('hide');
                        swal({
                            type: 'success',
                            title: 'Solicitação aceita com sucesso!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 2500);
                    } else if (data.message === 'Fail') {
                        $modal.modal('hide');
                        swal({
                            type: 'error',
                            title: 'Falha ao aceitar solicitação!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                });
            }
            else if($(this)[0].classList.contains("btn-danger"))
            {
                let solicitacao_id = e.target.dataset.solicitacao;
                $.get("recusar-solicitacao-cacamba", {
                    solicitacao_id: solicitacao_id
                }, function(data){
                    if (data.message === 'Ok') {
                        $modal.modal('hide');
                        swal({
                            type: 'success',
                            title: 'Solicitação recusada com sucesso!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 2500);
                    } else if (data.message === 'Fail') {
                        $modal.modal('hide');
                        swal({
                            type: 'error',
                            title: 'Falha ao recusar solicitação!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                });
            }
        });

        $(document).on("click", ".open-modal", function(e){
            let targ = e.target;
            if (e.target.classList.contains("glyphicon"))
                targ = e.target.parentElement;
            let solicitacao_id = $(targ)[0].dataset.solicitacao;
            $modal.modal('show', {id: targ.id, solicitacao_id: solicitacao_id});
        });
    });
</script>

@endsection