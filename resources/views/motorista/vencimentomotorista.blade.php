@extends('layouts.app')

@section('content')
    <title></title>

    <div class="container">
        <ul class="breadcrumb">
           <li><a href="{{ route('homeEntulho') }}">Parâmetros</a></li>
            <li class="active">Listas de Motoristas com a CNH Vencida</li>
        </ul>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Empresa</th>
                    <th>Categoria CNH</th>
                    <th>Número CNH</th>
                    <th>Validade CNH</th>
                </tr>
                @if($motoristas == null)
                    <tr>
                        <td>Todos os motoristas estão com a CNH em dia!</td>
                    </tr>
                @endif
                @foreach ($motoristas as $motorista)
                    <tr>
                      <td>{{$motorista->nome}}</td>
                        <td>{{$motorista->nome_fantasia}}</td>
                        <td>{{$motorista->cnh_categoria}}</td>
                        <td>{{$motorista->cnh_numero}}</td>
                        <td>{{Carbon\Carbon::parse($motorista->validade)->format('d/m/y')}}</td>
                    </tr>
                @endforeach
            </table>
            <!-- Modal -->
            <div class="container">
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <form>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection