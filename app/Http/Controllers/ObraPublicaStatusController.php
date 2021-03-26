<?php

namespace App\Http\Controllers;

use App\Models\ObraPublicaStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ObraPublicaStatusController extends Controller
{
    public $perPage = 10;
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Status de Obras Públicas';
        $status = ObraPublicaStatus::paginate($this->perPage);

        return view('obraPublicaStatus.index', compact('title', 'status'));
    }

    public function create()
    {
        $title = "Cadastrar Status de Obras Públicas";

        return view("obraPublicaStatus.create", compact('title'));
    }

    public function edit($id)
    {
        $status = ObraPublicaStatus::find($id);

        $title = "Editar Status de Obras Públicas: {$status->nome}";

        return view('obraPublicaStatus.create', compact('title', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required'
        ],[
            'nome.required' => 'Preencha o nome do status'
        ]);
        $dataForm = $request->all();
        $insert = ObraPublicaStatus::create($dataForm);
        if ($insert) {
            return redirect()->route('indexObraPublicaStatus');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required'
        ],[
            'nome.required' => 'Preencha o nome do status'
        ]);
        $dataForm = $request->all();
        $status = ObraPublicaStatus::find($id);

        $update = $status->update($dataForm);

        if ($update) {
            return redirect()->route('indexObraPublicaStatus');
        } else {
            return redirect()->route('editObraPublicaStatus', $id)->with(['errors' => 'Falha ao editar']);
        }
    }
}
