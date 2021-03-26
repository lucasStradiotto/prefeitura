@extends('layouts.app')

@section('content')

<title>{{$title}}</title>

<div class="container">
    <ul class="breadcrumb">
        {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    @if (session()->has('message'))
    <div id="message" class="alert alert-success">{{ session()->get('message') }}</div>
    @endif

    @if(isset($errors) && count($errors) > 0)
    <div id="message" class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif

    <a href="{{ route('createVeiculo') }}" class="btn btn-success"> Novo</a>
    <div class="form-group">
        <form class="form" action="{{route('indexVeiculo')}}" method="get">
            <label>Tipo Veículo</label>
            <select name="tipoVeiculo" id="tipoVeiculo">
                <option value="0">Selecione um tipo veículo</option>
                @if(isset($tipos))
                @foreach($tipos as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                @endforeach
                @endif
            </select>
            <label>Modelo</label>
            <input type="text" name="modelo" id="modelo" />
            <label>Placa</label>
            <input type="text" name="placa" id="placa" style="text-transform: uppercase" />
            <button type="submit" class="btn btn-success" id="btnPesquisar">Pesquisar</button>
            <button type="button" class="btn btn-danger" id="btnLimpar">Limpar</button>
        </form>
    </div>
    <div class="display">
        <table id="veiculo" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prefixo</th>
                    <th>Tipo do Veículo</th>
                    <th>Proprietário</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Rastreador</th>
                    <th>Venc. IPVA</th>
                    <th>Venc. DPVAT</th>
                    <th>Venc. Licenciamento</th>
                    <th>Venc. Extintor</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veiculos as $veiculo)
                <tr>
                    <td>{{$veiculo->cont}}</td>
                    <td>{{$veiculo->prefixo}}</td>
                    @foreach ($tipos as $tipo)
                    @if ($tipo->id == $veiculo->id_tipo_veiculo)
                    <td>{{$tipo->nome}}</td>
                    @endif
                    @endforeach
                    @foreach ($empresas as $empresa)
                    @if ($empresa->id == $veiculo->empresa_id)
                    <td>{{$empresa->nome_fantasia}}</td>
                    @endif
                    @endforeach
                    <td>{{$veiculo->modelo}}</td>
                    <td>{{$veiculo->placa}}</td>
                    <td>{{$veiculo->n_serie_rastreador}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="{{ route('editVeiculo', $veiculo->id) }}" class="no-sort btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td><a href="{{ route('deleteVeiculo', $veiculo->id) }}" class="no-sort btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a></td>
                    <td><a href="{{ route('detailsVeiculo', $veiculo->id) }}" class="no-sort btn btn-primary" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                    <td><a href=" " class="no-sort btn btn-default" title="Vincular Extintor"><i class="glyphicon glyphicon-fire"></i></a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Prefixo</th>
                    <th>Tipo do Veículo</th>
                    <th>Proprietário</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Rastreador</th>
                    <th>Venc. IPVA</th>
                    <th>Venc. DPVAT</th>
                    <th>Venc. Licenciamento</th>
                    <th>Venc. Extintor</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </tr>
            </tfoot>
        </table>
    </div>
    {{ $veiculos->appends(
            ['tipoVeiculo' => isset($pesquisaTipoVeiculo) ? $pesquisaTipoVeiculo : ''],
            ['modelo' => isset($pesquisaModelo) ? $pesquisaModelo: ''],
            ['placa' => isset($pesquisaPlaca) ? $pesquisaPlaca : ''])->links() }}
</div>
<script>
    $(document).ready(function() {

        var table = $('#veiculo').DataTable({
            "searching": false, //Exclui o campo de Search da Tabela, porque no nosso sistema já existe isso.
            "columnDefs": [{ targets: 'no-sort', orderable: false }]
        });

        if ($("#message").length > 0) {
            setTimeout(function() {
                $("#message").remove()
            }, 4000);
        }
    });

    // function ordenarTabela() {
    //     $('#veiculo').DataTable();
    // }

    function limparCampos() {
        return new Promise(function(resolve, reject) {
            $("#placa").val("");
            $("#modelo").val("");
            $("#tipoVeiculo").val("0");
            resolve(true);
        });
    }

    $("#btnLimpar").click(function() {
        limparCampos().then(function() {
            $("#btnPesquisar").click();
        });
    });
</script>
@endsection