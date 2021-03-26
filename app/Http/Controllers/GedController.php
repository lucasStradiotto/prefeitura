<?php

namespace App\Http\Controllers;

use App\Models\Ged;
use App\Models\GedObservacao;
use App\Models\PossivelObservacao;
use App\Models\secretaria;
use App\Models\UserSecretaria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class GedController extends Controller
{
    private $perPage = 10;
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Gerenciamento Eletrônico de Documentos";

        $select_nome_arquivo = Ged::select('nome_arquivo')->distinct()->get();
        $select_secretaria = Ged::select('secretaria')->distinct()->get();
        $select_usuario = Ged::select('nome_usuario')->distinct()->get();
        $select_obs = PossivelObservacao::select('nome_observacao')->distinct()->get();

        $nome_arquivo = request()->get('nome_arquivo');
        $secretaria = request()->get('secretaria');
        $data = request()->get('data');
        $nome_usuario = request()->get('nome_usuario');
        $nome_obs = request()->get('nome_obs');
        $valor_obs = request()->get('valor_obs');

        $documentos = Ged::select('*');

        if ($nome_arquivo)
            $documentos = $documentos->where('nome_arquivo', $nome_arquivo);

        if ($secretaria)
            $documentos = $documentos->where('secretaria', $secretaria);

        if ($data)
            $documentos = $documentos->whereRaw('DATE_FORMAT(data, "%Y-%m-%d") = ?', $data);

        if ($nome_usuario)
            $documentos = $documentos->where('nome_usuario', $nome_usuario);

        if ($nome_obs && $valor_obs)
        {
            $geds = GedObservacao::where('nome_observacao', $nome_obs)
                ->where('valor_observacao', $valor_obs)
                ->select('ged_id')
                ->get();

            $ids = [];
            foreach($geds as $ged)
                array_push($ids, $ged->ged_id);

            $documentos = $documentos->whereIn('id', $ids);
        }
        $documentos = $documentos->paginate($this->perPage);

        return view('ged.index', compact('title', 'documentos',
            'select_nome_arquivo', 'select_secretaria', 'select_usuario', 'select_obs'));
    }

    public function create()
    {
        $title = "Anexar Documento";

        $user_id = Auth::user()->id;
        $secretarias = UserSecretaria::where('user_id', $user_id)->get();

        return view('ged.create', compact('title', 'secretarias'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'arquivo' => 'required',
            'nome_arquivo' => 'required',
            'secretaria_id' => 'required'
        ], [
            'arquivo.required' => 'Selecione um arquivo!',
            'nome_arquivo.required' => 'Informe o nome do arquivo!',
            'secretaria_id.required' => 'Preencha a Secretaria'
        ]);
        $dataForm = request()->only(['nome_arquivo', 'obs', 'nome_obs', 'secretaria_id']);
        $dataForm['data'] = Carbon::now();
        $dataForm['nome_usuario'] = Auth::user()->name;
        $dataForm['secretaria'] = secretaria::find($dataForm['secretaria_id'])->nome;

        $doc = request()->file('arquivo');
        $docsPath = "docs/pdfs/ged";

        $fileName = $dataForm['data']->year .
            (($dataForm['data']->month < 10) ? "0" . $dataForm['data']->month : $dataForm['data']->month) .
            (($dataForm['data']->day  < 10) ? "0" . $dataForm['data']->day : $dataForm['data']->day) .
            (($dataForm['data']->hour < 10) ? "0" . $dataForm['data']->hour : $dataForm['data']->hour) .
            (($dataForm['data']->minute < 10) ? "0" . $dataForm['data']->minute : $dataForm['data']->minute) .
            (($dataForm['data']->second < 10) ? "0" . $dataForm['data']->second : $dataForm['data']->second) .
            ".".$doc->getClientOriginalExtension();

        $destinationPath = public_path($docsPath);
        $doc->move($destinationPath, $fileName);

        $dataForm['caminho_arquivo'] = $docsPath . "/" . $fileName;
        $insert = Ged::create($dataForm);
        for($i=0; $i<count($dataForm['obs']); $i++)
        {
            if ($dataForm['obs'][$i] != null)
            {
                $toAdd['nome_observacao'] = $dataForm['nome_obs'][$i];
                $toAdd['valor_observacao'] = $dataForm['obs'][$i];
                $toAdd['ged_id'] = $insert->id;
                GedObservacao::create($toAdd);
            }
        }
        if ($insert)
            return redirect()->route('indexGed');
        else
            return redirect()->back()->with('errors', 'Ocorreu um erro ao salvar o arquivo');
    }

    public function show($id)
    {
        $doc = Ged::find($id);
        $path = public_path() . "/" . $doc->caminho_arquivo;
        return response()->file($path);
    }

    public function edit($id)
    {
        $ged = Ged::find($id);
        $title = "Editar Documento";

        $user_id = Auth::user()->id;
        $secretarias = UserSecretaria::where('user_id', $user_id)->get();

        return view('ged.edit', compact('title', 'ged', 'secretarias'));
    }

    public function update($id)
    {
        $dataForm = request()->only(['nome_arquivo', 'obs', 'nome_obs']);
        $dataForm['data'] = Carbon::now();
        $dataForm['nome_usuario'] = Auth::user()->name;
//        $dataForm['secretaria'] = secretaria::where('id', Auth::user()->secretaria_id)->first()->nome;

        $ged = Ged::find($id);
        $update = $ged->update($dataForm);
        if ($update)
        {
            GedObservacao::where('ged_id', $id)->delete();
            for($i=0; $i<count($dataForm['obs']); $i++)
            {
                if ($dataForm['obs'][$i] != null)
                {
                    $toAdd['nome_observacao'] = $dataForm['nome_obs'][$i];
                    $toAdd['valor_observacao'] = $dataForm['obs'][$i];
                    $toAdd['ged_id'] = $id;
                    GedObservacao::create($toAdd);
                }
            }
            return redirect()->route('indexGed');
        }
        else
            return redirect()->back()->with('errors', 'Ocorreu um erro ao editar o arquivo');
    }

    public function delete($id)
    {
        $toDelete = Ged::find($id);
        $docPath = public_path() . "/" . $toDelete->caminho_arquivo;
        $deleted = unlink($docPath);
        if ($deleted)
        {
            $deleted = $toDelete->delete();
            if ($deleted)
            {
                GedObservacao::where('ged_id', $id)->delete();
                return ['message' => 'success'];
            }
            else
                return ['message' => 'error'];
        }
        else
            return ['message' => 'error'];
    }

    public function getObservacoes()
    {
        $secretaria_id = request()->get('secretaria_id');
        $observacoes = PossivelObservacao::where('secretaria_id', $secretaria_id)->get();

        return json_encode(
            $observacoes
        );
    }

    public function getObservacoesPreenchidas()
    {
        $ged_id = request()->get('ged_id');
        $observacoes = GedObservacao::where('ged_id', $ged_id)->get();

        return json_encode(
            $observacoes
        );
    }
}
