@extends('layouts.app')

@section('content')
    <title>Horas Trabalhadas</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">Horas Trabalhadas</li>
        </ul>
        <br>
        <form id="pesquisa">
        <div class="col-md-12">
            <div class="col-md-1">
                <p>Setor</p>
            </div>
            <div class="col-md-2">
                <select>
                    <option value="saude">Saude</option>
                    <option value="op1">Outra opção</option>
                    <option value=op2>Outra opção 2</option>
                </select>
            </div>
            <div class="col-md-1">
                <p>Período</p>
            </div>
            <div class="col-md-3">
                <input id="dateinicio" type="date">
            </div>
            <div class="col-md-1">
                <p>a</p>
            </div>
            <div class="col-md-3">
                <input id="datefim" type="date">
            </div>
            <div class="col-md-1">
                <button class="btn btn-success">Pesquisar</button>
            </div>
        </div>
        </form>
        <br><br><br>
        <div>
            <table class="table">
                <tr>
                    <th>Id Veiculo</th>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Setor</th>
                    <th>Horas Trabalhadas No Periodo</th>
                    <th>Horas Trabalhadas No Total</th>
                </tr>
                {{-- @if($ == null)
                     <tr>
                         <td>Aguarde, nenhuma informação !</td>
                     </tr>
                 @endif
                 @foreach ($motoristas as $motorista)
                     <tr>
                         <td>{{$motorista->nome}}</td>
                         <td>{{$motorista->nome_fantasia}}</td>
                         <td>{{$motorista->cnh_categoria}}</td>
                         <td>{{$motorista->cnh_numero}}</td>
                         <td>{{Carbon\Carbon::parse($motorista->cnh_validade)->format('d/m/y')}}</td>
                     </tr>
                 @endforeach--}}
            </table>
            <div class="col-md-12 text-center ">
                <button type="button" class="btn btn-success" data-dismiss="modal">Imprimir</button>
            </div>


        </div>
    </div>
@endsection