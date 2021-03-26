<?php

namespace App\Http\Controllers;

use App\Models\numeroDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class NumeroDocumentoController extends Controller
{
    private $numeroDocumento;

    public function __construct(numeroDocumento $numeroDocumento)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->numeroDocumento = $numeroDocumento;
    }

    public function index()
    {
        $title = 'Últimos Números de Documentos';
        $numeros = [
            'alvDem' => $this->numeroDocumento->where('nome', 'alvDem')->first(),
            'outros' => $this->numeroDocumento->where('nome', 'outros')->first(),
//            'cerDem' => $this->numeroDocumento->where('nome', 'cerDem')->first(),
//            'habite' => $this->numeroDocumento->where('nome', 'habite')->first(),
//            'cerCon' => $this->numeroDocumento->where('nome', 'cerCon')->first()
        ];

        return view('numeroDocumento.index', compact('title', 'numeros'));
    }

    public function create()
    {
        $title = 'Atribuir Número de Documento';

        return view('numeroDocumento.create', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'numero_atual' => 'required'
        ], [
            'numero_atual.required' => 'Insira o número do documento!'
        ]);

        $dataForm = $request->all();
        $insert = $this->numeroDocumento->create($dataForm);
        if ($insert) {
            return redirect()->route('indexNumeroDocumento');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $nd = $this->numeroDocumento->all();
        $existe = false;
        $request["numero_atual"] = $request["numero_atual"]+1;
        foreach ($nd as $numero) {
            if ($numero->nome == $request["nome"]) {
                $existe = true;
            }
        }
        if (!$existe) {
            if ($this->store($request)) {
                return redirect()->route('indexNumeroDocumento');
            } else {
                return redirect()->back();
            }
        } else {
            $this->validate($request, [
                'numero_atual' => 'required'
            ], [
                'numero_atual.required' => 'Insira o número do documento!'
            ]);

            $dataForm = $request->all();
            $numeroDocumento = $this->numeroDocumento->where('nome', $dataForm["nome"])->first();

            $update = $numeroDocumento->update($dataForm);
            if ($update) {
                return redirect()->route('indexNumeroDocumento');
            } else {
                return redirect()->route('createNumeroDocumento')->with(['errors' => 'Falha ao editar']);
            }
        }
    }
}
