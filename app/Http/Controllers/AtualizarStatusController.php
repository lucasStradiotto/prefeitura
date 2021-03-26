<?php

namespace App\Http\Controllers;

use App\Models\documentoAnexado;
use App\Models\protocolo;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AtualizarStatusController extends Controller
{
    private $status;
    private $protocolo;
    private $anexos;
    private $qtdShow = 20;

    public function __construct(status $status, protocolo $protocolo, documentoAnexado $documentoAnexado)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->status = $status;
        $this->protocolo = $protocolo;
        $this->anexos = $documentoAnexado;
    }

    public function index(Request $request)
    {
        $title = 'Atualizar Status';

        $statusToSelect = $this->status->all();

        $status = $request->get('status');

        if ($status != null)
        {
            $protocolos = $this->protocolo->select('protocolos.*', 'status.cor')
                                            ->join('status', 'status.nome', '=', 'protocolos.status')
                                            ->where('status', $status)
                                            ->orderByDesc('created_at')->paginate($this->qtdShow);
        }
        else
        {
            $protocolos = $this->protocolo->select('protocolos.*', 'status.cor')
                                            ->join('status', 'status.nome', '=', 'protocolos.status')
                                            ->where('status', '<>', 'Aprovado')
                                            ->orWhereNull('status')
                                            ->orderByDesc('created_at')->paginate($this->qtdShow);
        }

        $anexos = $this->anexos->all();

        return view('atualizarStatus.index', compact('title', 'statusToSelect', 'protocolos', 'anexos'));
    }

    public function edit($idProtocolo)
    {
        $title = 'Atualizar Status';

        $protocolo = $this->protocolo->find($idProtocolo);
        $status = $this->status->all();

        return view('atualizarStatus.create', compact('title', 'protocolo', 'status'));
    }

    public function update(Request $request, $idProtocolo)
    {
        $protocolo = $this->protocolo->find($idProtocolo);
        $protocolo->status = $request["status"];
        $protocolo->observacaoStatus = $request["observacaoStatus"];

        $update = $protocolo->save();

        if ($update) {
            return redirect()->route('indexAtualizarStatus');
        } else {
            return redirect()->back()->with('errors', 'Falha ao alterar status');
        }
    }
}
