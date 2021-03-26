<?php

namespace App\Http\Controllers;

use App\Models\documentoAnexado;
use App\Models\protocolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class DocumentoAnexadoController extends Controller
{
    private $docAnex;
    private $protocolo;

    public function __construct(documentoAnexado $documentoAnexado, protocolo $protocolo)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->docAnex = $documentoAnexado;
        $this->protocolo = $protocolo;
    }

    public function index($protocoloId)
    {
        $title = "Anexar Documentos";
        $protocolo = $this->protocolo->find($protocoloId);

        $docAnex = $this->docAnex->where('protocolo_id', $protocoloId)->get();

        return view('documentoAnexado.index', compact('title', 'docAnex', 'protocoloId', 'protocolo'));
    }

    public function create($protocoloId)
    {
        $title = "Anexar Novo Documento";

        return view('documentoAnexado.create', compact('title', 'protocoloId'));
    }

    public function store(Request $request, $protocoloId)
    {
        $doc = $request->file('doc');

        if (($doc->getClientOriginalExtension() == "pdf") ||
            ($doc->getClientOriginalExtension() == "PDF") ||
            ($doc->getClientOriginalExtension() == "jpg") ||
            ($doc->getClientOriginalExtension() == "JPG")) {
            // MOVER O DOC PARA A PASTA DO PROJETO
            $input['docName'] = $doc->getClientOriginalName();

            $destinationPath = public_path("/docs/pdfs/{$protocoloId}");

            $doc->move($destinationPath, $input['docName']);

            // Adiciona ao banco
            $doc = new documentoAnexado;
            $doc->caminho = $input['docName'];
            $doc->protocolo_id = $protocoloId;
            $doc->save();

            return redirect()->route('indexAnexarDocumento', $protocoloId);
        } else {
            return redirect()->back()->with('errors', 'Formato de arquivo inválido');
        }
    }

    public function showPdf($id, $caminho)
    {
        $path = base_path() . "/public/docs/pdfs/{$id}/{$caminho}";

        return response()->file($path);
    }
}
