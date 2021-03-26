@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        <div class="col-md-6">
            <p class="col-md-4">Anomalias</p>
            <select class="col-md-8" id="slc-anomalia">
                <option value="0">Todas as Anomalias</option>
                @foreach($anomalias as $anomalia)
                    <option value="{{$anomalia->id}}">{{$anomalia->nome}}</option>
                @endforeach
            </select>
        </div>
        <table class="table">
            <thead>
                <th>Endereço</th>
                <th>Anomalia</th>
                <th>Solicitante</th>
                <th>Data Solicitação</th>
                <th>Status</th>
                <th class="text-center">Ações</th>
            </thead>
            <tbody></tbody>
        </table>

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

            getSolicitacoes();

            $("#slc-anomalia").change(function(){
                getSolicitacoes($(this).val());
            });

            function getSolicitacoes(filter = 0){
                $.getJSON("{{route('getSolicitacoes')}}", {
                    anomalia_id: filter
                },function(data){
                    $("tbody").empty();
                    $.each(data, function(index, element){
                        let _ms_per_day = 24 * 60 * 60 * 1000;
                        let today = new Date();
                        let target = new Date(element.data);
                        let diff = Math.floor((today-target)/_ms_per_day);

                        let color = '';
                        if (element.status_solicitacao == "EXECUTADO") color = "#bcffc7";
                        if (element.status_solicitacao == "PENDENTE") color = "#b5b6bc";
                        if (element.status_solicitacao == "CANCELADO") color = "#e5eb66";
                        if (diff > element.prazo_solicitacao) color = "#ffc9c4"
                        $("tbody").append(
                            '<tr style="background-color: '+color+'">'+
                            '<td>'+element.nome_rua+', '+element.numero_casa+'</td>'+
                            '<td>'+element.anomalia+'</td>'+
                            '<td>'+element.nome_solicitante+'</td>'+
                            '<td>'+formatDate(element.data)+'</td>'+
                            '<td>'+element.status_solicitacao+'</td>'+
                            '<td class="text-center">'+
                                '<a id="modal-finalizar" data-solicitacao="'+element.id+'" class="btn btn-success open-modal" title="Finalizar"><i class="glyphicon glyphicon-check"></i></a>'+
                                '<a id="call-print" data-solicitacao="'+element.id+'" class="btn btn-primary" title="Imprimir" href="relatoriomanutencaoeletrica/'+ element.id +'"><i class="glyphicon glyphicon-print"></i></a>'+
                                '<a id="modal-cancelar" data-solicitacao="'+element.id+'" class="btn btn-danger open-modal" title="Cancelar"><i class="glyphicon glyphicon-remove-circle"></i></a>'+
                            '</td>'+
                            '</tr>'
                        );
                    });
                });
            }

            $("#exampleModalLong").on("show.bs.modal", function(e){
                let solicitacao_id = e.relatedTarget.solicitacao_id;
                if(e.relatedTarget.id == "modal-finalizar")
                {
                    $("#exampleModalLongTitle").text("Finalizar Ordem de Serviço");
                    $("#exampleModalContent").text('Deseja Finalizar a Ordem de Serviço?');
                    $("#exampleCancelButton").text('Não');
                    $("#exampleConfirmButton").text('Sim');
                    $("#exampleConfirmButton").removeClass();
                    $("#exampleConfirmButton").addClass('btn btn-success');
                    $("#exampleConfirmButton").attr('data-solicitacao', solicitacao_id);
                }
                else if(e.relatedTarget.id == "modal-cancelar")
                {
                    $("#exampleModalLongTitle").text("Cancelar Ordem de Serviço");
                    $("#exampleModalContent").text('Deseja Cancelar a Ordem de Serviço?');
                    $("#exampleCancelButton").text('Não');
                    $("#exampleConfirmButton").text('Sim');
                    $("#exampleConfirmButton").removeClass();
                    $("#exampleConfirmButton").addClass('btn btn-danger');
                    $("#exampleConfirmButton").attr('data-solicitacao', solicitacao_id);
                }
            });

            $(document).on("click", "#exampleConfirmButton", function(e){
                if($(this)[0].classList.contains("btn-success"))
                {
                    let solicitacao_id = e.target.dataset.solicitacao;
                    $.get("finalizar-solicitacao-rede-eletrica", {
                        solicitacao_id: solicitacao_id
                    }, function(data){
                        if (data.message === 'Ok') {
                            $('#exampleModalLong').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Solicitação finalizada com sucesso!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            setTimeout(function(){
                                location.reload();
                            }, 2500);
                        } else if (data.message === 'Fail') {
                            $('#exampleModalLong').modal('hide');
                            swal({
                                type: 'error',
                                title: 'Falha ao finalizar solicitação!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    });
                }
                else if($(this)[0].classList.contains("btn-danger"))
                {
                    let solicitacao_id = e.target.dataset.solicitacao;
                    $.get("cancelar-solicitacao-rede-eletrica", {
                        solicitacao_id: solicitacao_id
                    }, function(data){
                        if (data.message === 'Ok') {
                            $('#exampleModalLong').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Solicitação cancelada com sucesso!',
                                showConfirmButton: false,
                                timer: 2500
                            });
                            setTimeout(function(){
                                location.reload();
                            }, 2500);
                        } else if (data.message === 'Fail') {
                            $('#exampleModalLong').modal('hide');
                            swal({
                                type: 'error',
                                title: 'Falha ao cancelar solicitação!',
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
                $('#exampleModalLong').modal('show', {id: targ.id, solicitacao_id: solicitacao_id});
            });

            function formatDate(date){
                let ret;
                date = new Date(date);
                ret = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
                ret += "/";
                ret += date.getMonth()+1 < 10 ? "0" + (date.getMonth()+1) : date.getMonth()+1;
                ret += "/";
                ret += date.getFullYear();
                return ret;
            }
        });
    </script>
@endsection