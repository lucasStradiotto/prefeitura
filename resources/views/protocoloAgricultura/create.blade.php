@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexProtocolo') }}">Protocolos</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        @if(isset($protocolo))
            <form class="container" method="post" action="{{ route('updateProtocolo', $protocolo->id) }}">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <div>L</div>
                <div>
                    <input type="text" name="l" value="{{$protocolo->l or old('l')}}">
                </div>
                <div>Inicio</div>
                <div>
                    <input type="date" name="data_inicio" disabled value="{{isset($protocolo->data_inicio) ? str_replace('/', '-', $protocolo->data_inicio->format('Y/m/d')) : old('data_inicio')}}">
                </div>
                <div>Setor Protocolo</div>
                <div>
                    <select name="setor_protocolo" class="col-md-5">
                        <option value="">Selecione o Setor do Protocolo</option>
                        @foreach($setoresProtocolo as $setorProtocolo)
                            <option value="{{$setorProtocolo->id}}"
                            @if ($setorProtocolo->id == $protocolo->setor_protocolo)
                                selected
                            @endif
                            >
                                {{$setorProtocolo->nome}}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('createSetorProtocolo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>Assunto</div>
                <div>
                    <select name="assunto" id="assunto" class="col-md-5">
                        <option value="">Selecione o Assunto</option>
                        @for($i=0; $i<count($assuntos); $i++)
                            <option value="{{$assuntos[$i]->nome}}" data-grupo="{{$assuntos[$i]->tipo_assunto_id}}"
                            @if ($assuntos[$i]->nome == $protocolo->assunto)
                                selected
                            @endif
                            >
                                {{$assuntos[$i]->nome}}
                            </option>
                        @endfor
                    </select>
                    <a href="{{ route('createAssunto') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>Endereço</div>
                <div>
                    <select id="slcRuas" name="endereco">
                        <option value="">Selecione o Endereço</option>
                        @foreach($ruas as $rua)
                            <option value="{{$rua->nome}}" data-id="{{$rua->id}}"
                                    @if($rua->nome == $protocolo->endereco)
                                    selected
                                    @endif
                            >{{$rua->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div>Número</div>
                <div>
                    <input type="number" id="inp-numero" name="numero" value="{{$protocolo->numero or old('numero')}}">
                </div>
                <div>Proprietário</div>
                <div>
                    <input name="proprietario" value="{{$protocolo->proprietario or old('proprietario')}}">
                </div>
                <div>Email do Proprietário</div>
                <div>
                    <input name="proprietario_email" value="{{$protocolo->proprietario_email or old('proprietario_email')}}">
                </div>
                <div>Setor</div>
                <div>
                    <select id="slcSetores" name="setor">
                        <option value="">Selecione o Setor</option>
                        @foreach($setores as $setor)
                            <option value="{{$setor->nome}}" data-id="{{$setor->id}}"
                            @if ($protocolo->setor == $setor->nome)
                                selected
                            @endif
                            >
                                {{$setor->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>Quadra</div>
                <div>
                    <select id="slcQuadras" name="quadra">
                        <option value="">Selecione a Quadra</option>
                    </select>
                </div>
                <div>Lote</div>
                <div>
                    <select id="slcLotes" name="lote">
                        <option value="">Selecione o Lote</option>
                        @foreach($lotes as $lote)
                            <option value="{{$lote->nome}}" data-id="{{$lote->id}}"
                            @if($protocolo->lote == $lote->nome)
                                selected
                            @endif
                            >
                                {{$lote->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>M²</div>
                <div>
                    <input name="m2" value="{{$protocolo->m2 or old('m2')}}">
                </div>
                <div>Responsável</div>
                <div>
                    <select name="responsavel" id="slc-responsavel" class="col-md-5">
                        <option value="0">Selecione o Responsável</option>
                        @foreach($responsaveis as $responsavel)
                            <option data-mail="{{$responsavel->email}}"
                                    value="{{$responsavel->nome}}"
                            @if ($responsavel->nome == $protocolo->responsavel)
                                selected
                            @endif
                            >
                                {{$responsavel->nome}}
                            </option>
                        @endforeach
                    </select>
                    {{--<a href="{{ route('createResponsavel') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>--}}
                    <a data-toggle="modal" data-target="#exampleModal" data-type="responsavel" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>Email do Responsável</div>
                <div>
                    <input id="email-responsavel" name="responsavel_email" value="{{$protocolo->responsavel_email or old('responsavel_email')}}">
                </div>
                <div>D.T.</div>
                <div>
                    <input type="checkbox" name="dt" value="1"
                           @if(isset($protocolo) && $protocolo->dt == '1') checked @endif>
                </div>
                <div>Status</div>
                <div>
                    <select id="slc-status" name="status" class="col-md-5">
                        <option value="">Selecione o Status</option>
                        @foreach($status as $stat)
                            <option value="{{$stat->nome}}"
                            @if ($stat->nome == $protocolo->status)
                                selected
                            @endif
                            >{{$stat->nome}}</option>
                        @endforeach
                    </select>
                    {{--<a href="{{ route('createStatus') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>--}}
                    <a data-toggle="modal" data-target="#exampleModal" data-type="status" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <div>Data Status</div>
                <div>
                    <input type="date" name="dataStatus" value="{{isset($protocolo->dataStatus) ? str_replace('/', '-', $protocolo->dataStatus->format('Y/m/d')) : old('dataStatus')}}">
                </div>
                <div>Observação Status</div>
                <div>
                    <input name="observacaoStatus" value="{{$protocolo->observacaoStatus or old('observacaoStatus')}}">
                </div>
                <div>Fim</div>
                <div>
                    <input type="date" name="data_fim" value="{{isset($protocolo->data_fim) ? str_replace('/', '-', $protocolo->data_fim->format('Y/m/d')) : old('data_fim')}}">
                </div>
                <div>Livro</div>
                <div>
                    <input name="livro" value="{{$protocolo->livro or old('livro')}}">
                </div>
                <div>ProtF</div>
                <div>
                    <input name="protF" value="{{$protocolo->protF or old('protF')}}">
                </div>
                <div>Página</div>
                <div>
                    <input name="pagina" value="{{$protocolo->pagina or old('pagina')}}">
                </div>
                <div>Taxa</div>
                <div>
                    R$ <input name="taxa" value="{{$protocolo->taxa or old('taxa')}}">
                </div>
                <div>Data Retirada</div>
                <div>
                    <input type="date" name="data_retirada" value="{{isset($protocolo->data_retirada) ? str_replace('/', '-', $protocolo->data_retirada->format('Y/m/d')) : old('data_retirada')}}">
                </div>
                <div>Retirado por</div>
                <div>
                    <input name="retiradoPor" value="{{$protocolo->retiradoPor or old('retiradoPor')}}">
                </div>
                <div>
                    <input type="checkbox" name="enviar_email" value="1" /> Enviar e-mail
                </div>
                <button class="btn btn-success">Atualizar</button>

            </form>
        @else
            <form class="container" method="post" action="{{ route('storeProtocolo') }}">
                {!! csrf_field() !!}
                <div>Data Início</div>
                <div>
                    <input type="date" name="data_inicio" value="{{old('data_inicio')}}" id="data-inicio">
                </div>
                <div>L</div>
                <div>
                    <input name="l" value="{{old('l')}}">
                </div>
                <div>Setor Protocolo</div>
                <div>
                    <select name="setor_protocolo" class="col-md-5">
                        <option value="">Selecione o Setor do Protocolo</option>
                        @foreach($setoresProtocolo as $setorProtocolo)
                            <option value="{{$setorProtocolo->id}}">{{$setorProtocolo->nome}}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('createSetorProtocolo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                <button class="btn btn-success">Enviar</button>
            </form>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Nome</div>
                    <div><input id="txt-nome" type="text"/></div>
                    <div id="div-email">
                        <div>Email</div>
                        <div><input id="txt-email" type="text"/></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-type="" id="btn">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (e) {
            $("#inp-numero").blur(function(){
                $.get("{{route('getSetQuadLot')}}", {
                    rua_id: $("#slcRuas option:selected").data("id"),
                    numero: $("#inp-numero").val()
                }, function(){

                }).done(function(data){
                    if (data.length > 0)
                    {
                        let set_quad_lot = data[0].extract_string;
                        let set = set_quad_lot.split('-')[0];
                        let quad = set_quad_lot.split('-')[1];
                        let lot = set_quad_lot.split('-')[2];

                        $("#slcSetores").val(set);
                        $("#slcSetores").change();
                        $("#slcQuadras").val(quad);
                        $("#slcQuadras").change();
                        $("#slcLotes").val(lot);
                        $("#slcLotes").change();
                    }
                }).catch(function(error){
                    console.log(error);
                });
            });

            var $exampleModal = $("#exampleModal");
            var $txtNome = $("#txt-nome");
            $exampleModal.on('shown.bs.modal', function (event) {
                $txtNome.focus();
            });

            $exampleModal.on('show.bs.modal', function (event) {
                $txtNome.val("");
                let button = $(event.relatedTarget);
                let tipoModal = button.data('type');
                let modal = $(this);
                let titulo = "";
                switch (tipoModal)
                {
                    case 'status':
                        titulo = "Novo Status";
                        modal.find("#div-email").css("display", "none");
                        break;
                    case 'responsavel':
                        $("#txt-email").val("");
                        titulo = "Novo Responsável";
                        modal.find("#div-email").css("display", "block");
                        break;
                }
                modal.find(".modal-title").text(titulo);
                modal.find("#btn").removeData("type");
                modal.find("#btn").data("type", tipoModal);
            });

            $("#btn").click(function(event){
                let tipoModal = $(this).data('type');
                let nome = $txtNome.val();
                switch (tipoModal)
                {
                    case 'status':
                        $.post("{{route('insertStatusFromModal')}}", {
                            nome: nome
                        }, function(data, textStatus, jqXHR){
                            let ultimoId = data;
                            $exampleModal.modal('hide');
                            $("#slc-status").empty();
                            $.getJSON("{{route('getStatus')}}", {

                            }, function(data){
                                $.each(data, function(index, value){
                                    let toAppend = "<option value='"+value.nome+"'";
                                    toAppend += value.id == ultimoId ? " selected>"+value.nome+"</option" : " >"+value.nome+"</option>";
                                    $("#slc-status").append(toAppend);
                                });
                            });
                        });
                        break;
                    case 'responsavel':
                        $.post("{{route('insertResponsavelFromModal')}}", {
                            nome: nome,
                            email: $("#txt-email").val()
                        }, function(data, textStatus, jqXHR){
                            let ultimoId = data;
                            $exampleModal.modal('hide');
                            $("#slc-responsavel").empty();
                            $.getJSON("{{route('getResponsavel')}}", {

                            }, function(data){
                                $.each(data, function(index, value){
                                    let toAppend = "<option value='"+value.nome+"' data-mail='"+value.email+"'";
                                    toAppend += value.id == ultimoId ? " selected>"+value.nome+"</option" : " >"+value.nome+"</option>";
                                    $("#slc-responsavel").append(toAppend);
                                });
                                preencheEmail();
                            });
                        });
                        break;
                }
            });

            $("select").select2();

            fillSelectNumeroCasas();
            fillSelectQuadras();

            function fillSelectNumeroCasas(){
                let protocolo_numero = "{{isset($protocolo->numero) ? $protocolo->numero : ''}}";
                if ($("#slcRuas").val() !== '0') {
                    let $selectAlvo = $("#slcNumeros");

                    $selectAlvo.empty();
                    $selectAlvo.append($('<option>', { value: '0' }).text('Selecione o Número'));

                    $.getJSON("{{ route('getNumerosCasas') }}", {
                        endereco: $("#slcRuas option:selected").attr('data-id')
                    }, function (data, textStatus, jqXHR) {

                        $.each(data, function (indice, numero) {
                            if(numero.numero == protocolo_numero)
                            {
                                $selectAlvo.append($('<option selected>', {value: numero.numero}).text(numero.numero));
                                fillSelectQuadras();
                            }
                            else
                                $selectAlvo.append($('<option>', {value: numero.numero}).text(numero.numero));
                        })
                    });
                }
            }

            function fillSelectQuadras(){
                    let $selectAlvo = $("#slcQuadras");
                    $selectAlvo.empty();
                    $selectAlvo.append($('<option>', { value: '0' }).text('Selecione a Quadra'));

                    $.getJSON("{{ route('getQuadrasCasas') }}", {
                    }, function (data, textStatus, jqXHR) {
                        $.each(data, function (indice, quadra) {
                            let protocolo_quadra = "{{isset($protocolo->quadra) ? $protocolo->quadra : ''}}";
                            if(quadra.nome == protocolo_quadra)
                                $selectAlvo.append($('<option selected>', {value: quadra.nome}).text(quadra.nome));
                            else
                                $selectAlvo.append($('<option>', {value: quadra.nome}).text(quadra.nome));
                        })

                    });
            }

            $("#data-inicio").val(new Date().toISOString().split("T")[0]);
            $(document).on('change', '#slcRuas', function (e) {
                e.preventDefault();

                fillSelectNumeroCasas();
            });

            $("#slc-responsavel").change(function(){
                preencheEmail();
            });

            function preencheEmail(){
                let email = $("#slc-responsavel option:selected").data('mail');
                $("#email-responsavel").val(email);
            }
        });
    </script>
@endsection