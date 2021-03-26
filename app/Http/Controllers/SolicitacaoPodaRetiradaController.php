<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoPodaRetirada;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SolicitacaoPodaRetiradaController extends Controller
{
    private $perPage = 15;
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $solicitacoes = SolicitacaoPodaRetirada::join('autorizacao_poda_retirada',
            'solicitacao_id', '=', 'solicitacao_poda_retirada.id')
            ->orderBy('solicitacao_poda_retirada.created_at')
            ->select('solicitacao_poda_retirada.*')
            ->paginate($this->perPage);
        $data = [
            'title' => 'Lista de solicitações de poda e supressão',
            'solicitacoes' => $solicitacoes
        ];

        return view('solicitacaoPodaRetirada.index', $data);
    }

    public function details($id)
    {
        $solicitacao = SolicitacaoPodaRetirada::find($id);
        $data = [
            'title' => 'Detalhes',
            'solicitacao' => $solicitacao
        ];

        return view('solicitacaoPodaRetirada.details', $data);
    }
}
