<?php

namespace App\Http\Controllers;

use App\Http\Requests\empresaFormRequest;
use App\Models\empresa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EmpresaController extends Controller
{
    private $empresa;
    private $qtdShow = 10;

    public function __construct(empresa $empresa)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->empresa = $empresa;
    }

    public function index()
    {
        $title = 'Listagem de Proprietários';
        $empresas = $this->empresa->orderBy('nome_fantasia')->paginate($this->qtdShow);

        return view('empresa.index', compact('empresas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Proprietário";

        return view("empresa.create", compact('title'));
    }

    public function edit($idEmpresa)
    {
        $empresa = $this->empresa->find($idEmpresa);

        $title = "Editar Proprietário: {$empresa->nome_fantasia}";

        return view('empresa.create', compact('title', 'empresa'));
    }

    public function store(empresaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->empresa->create($dataForm);
        if ($insert) {
            return redirect()->route('indexEmpresa');
        } else {
            return redirect()->back();
        }
    }

    public function update(empresaFormRequest $request, $idEmpresa)
    {
        $dataForm = $request->all();
        $empresa = $this->empresa->find($idEmpresa);

        $update = $empresa->update($dataForm);

        if ($update) {
            return redirect()->route('indexEmpresa');
        } else {
            return redirect()->route('editEmpresa', $idEmpresa)->with(['errors' => 'Falha ao editar']);
        }
    }
}
