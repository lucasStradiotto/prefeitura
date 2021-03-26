<?php

namespace App\Http\Controllers;

use App\Models\documentoGerado;
use App\Models\engenheiro;
use App\Models\estagiario;
use App\Models\numeroDocumento;
use App\Models\protocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class DocumentoController extends Controller
{
    private $protocolo;
    private $engenheiro;
    private $estagiario;
    private $numDoc;

    public function __construct(
        protocolo $protocolo,
        engenheiro $engenheiro,
        estagiario $estagiario,
        numeroDocumento $numeroDocumento
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->protocolo = $protocolo;
        $this->engenheiro = $engenheiro;
        $this->estagiario = $estagiario;
        $this->numDoc = $numeroDocumento;
    }

    public function index($idProtocolo)
    {
        $title = "Gerar Documentos";
        $engenheiros = $this->engenheiro->all();
        $estagiarios = $this->estagiario->all();

        return view('documentos.index', compact('title', 'idProtocolo', 'engenheiros', 'estagiarios'));
    }

    public function triagem(Request $request, $idProtocolo)
    {
        $this->validate($request, [
            'engenheiro' => 'required',
            'documento' => 'required'
        ], [
            'engenheiro.required' => 'Escolha um engenheiro!',
            'documento.required' => 'Escolha um Documento!'
        ]);
        $engenheiro = $this->engenheiro->where('nome', $request["engenheiro"])->first();
        $protocolo = $this->protocolo->find($idProtocolo);
        if ($request["documento"] != "alvDem")
            $numDoc = $this->numDoc->where('nome', '=', 'outros')->first()->numero_atual;
        else
            $numDoc = $this->numDoc->where('nome', $request["documento"])->first()->numero_atual;
        $tipo_construcao = $request['tipo-construcao'];
        $tipo_predio = $request['tipo-predio'];
        $comodos = $request['comodos'];
        $comodos_res = $request['comodos_res'];
        $comodos_com = $request['comodos_com'];
        $obs = $request['obs'];
        $tipo_cobertura = $request['tipo_cobertura'];
        //$metragem_com = 0;
        //$metragem_res = 0;
        if ($tipo_predio == 'Misto')
        {
            $metragem_res = $request['metragem_res'];
            $metragem_com = $request['metragem_com'];
        }
        else
        {
            $metragem_com = 0;
            $metragem_res = 0;
        }
        switch ($request["documento"]) {
            case "alvDem":
                $title = "Alvará de Demolição";
                return view('documentos.alvaraDemolicao',
                    compact('title', 'protocolo', 'engenheiro', 'numDoc',
                        'tipo_predio', 'metragem_com', 'metragem_res'));
                break;
            case "cerDem":
                $title = "Certidão de Demolição";
                return view('documentos.certidaoDemolicao',
                    compact('title', 'protocolo', 'engenheiro', 'numDoc',
                        'tipo_construcao','tipo_predio'));
                break;
            case "habite":
                $title = "Habite-se";
                return view('documentos.habitese', compact('title', 'protocolo',
                    'engenheiro', 'numDoc', 'tipo_construcao', 'tipo_predio', 'metragem_res', 'metragem_com'));
                break;
            case "cerCon":
                $title = "Certidão de Construção";
                $matricula = $request["matricula"];
                return view('documentos.certidaoConstrucao',
                    compact('title', 'protocolo', 'engenheiro',
                        'numDoc', 'matricula', 'tipo_predio', 'tipo_construcao', 'metragem_com', 'metragem_res',
                        'comodos', 'comodos_com', 'comodos_res', 'obs', 'tipo_cobertura'));
                break;
        }
        
    }

    public function validateDocument(Request $request)
    {
        $dataForm = $request->all();
        $insert = documentoGerado::create($dataForm);

        if ($insert)
        {
            if ($dataForm["tipo_documento"] != "Alvará de Demolição")
                $numDoc = "outros";
            else
                $numDoc = "alvDem";
            $numeroDocumento = $this->numDoc->where('nome', '=', $numDoc)->first();
            $numeroDocumento->numero_atual = $numeroDocumento->numero_atual + 1;
            $numeroDocumento->save();
            return redirect()->route('indexProtocolo');
        }
        else
            return redirect()->back();
    }

    public function listagem()
    {
        $title = "Listagem de Documentos";

        $documentos = documentoGerado::orderByDesc('created_at')->paginate(10);

        return view('documentos.listagemDocumentos', compact('title', 'documentos'));
    }

    public function emitirSegundaVia($id)
    {
        $documento = documentoGerado::find($id);

        return view('documentos.segundaVia', compact('documento'));
    }
}
